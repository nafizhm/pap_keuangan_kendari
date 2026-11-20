<?php

// Read-only checks against the configured database.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
config(['session.driver' => 'array', 'cache.default' => 'array']);
Illuminate\Support\Facades\Auth::login(App\Models\User::where('username', 'keuangan')->firstOrFail());
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

foreach (['pemasukan', 'pengeluaran'] as $type) {
    $fetch = function (array $parameters) use ($kernel, $type) {
        // Each request normally has a fresh container in PHP-FPM.
        app()->forgetInstance('datatables.request');
        Illuminate\Support\Facades\DB::flushQueryLog();
        Illuminate\Support\Facades\DB::enableQueryLog();
        $started = microtime(true);
        $request = Illuminate\Http\Request::create('/admin/keuangan/'.$type, 'GET',
            array_replace_recursive(['draw' => 1, 'start' => 0, 'length' => 10], $parameters), [], [],
            ['HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest', 'HTTP_ACCEPT' => 'application/json']);
        $response = $kernel->handle($request);
        $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        if ($response->getStatusCode() !== 200 || isset($data['error'])) {
            throw new RuntimeException('Table failed: '.$response->getContent());
        }
        $queries = Illuminate\Support\Facades\DB::getQueryLog();
        if (count($queries) > 12) { throw new RuntimeException('Too many queries: '.count($queries)); }
        $limited = array_filter($queries, fn ($query) => str_contains(strtolower($query['query']), 'limit'));
        if (!$limited && count($data['data'])) { throw new RuntimeException('Missing database pagination'); }
        echo $type.' start='.$parameters['start'].' rows='.count($data['data']).' queries='.count($queries)
            .' time_ms='.round((microtime(true) - $started) * 1000).PHP_EOL;
        return $data;
    };
    $first = $fetch(['start' => 0]);
    $second = $fetch(['start' => 10]);
    if (count($first['data']) !== 10 || count($second['data']) !== 10) { throw new RuntimeException('Expected 10 rows'); }
    if (array_intersect(array_column($first['data'], 'id'), array_column($second['data'], 'id'))) {
        throw new RuntimeException('Pages overlap');
    }
    $filtered = $fetch(['start' => 0, 'search' => ['value' => 'Keterangan kosong di Excel']]);
    if (!$filtered['recordsFiltered'] || $filtered['recordsFiltered'] >= $first['recordsTotal']) {
        throw new RuntimeException('Search failed');
    }
    $date = Illuminate\Support\Facades\DB::table($type)->max('tanggal');
    $dated = $fetch(['start' => 0, 'filter_tanggal' => $date]);
    if ($dated['recordsTotal'] !== Illuminate\Support\Facades\DB::table($type)->where('tanggal', $date)->count()) {
        throw new RuntimeException('Date filter failed');
    }
}
echo "Pagination, bounded queries, search, and date filters passed.\n";

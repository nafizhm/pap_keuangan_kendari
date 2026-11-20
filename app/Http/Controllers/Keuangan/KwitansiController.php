<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\PengaturanProfil;
use Carbon\Carbon;
use TCPDF;

class KwitansiController extends Controller
{
    public function pemasukan($id)
    {
        return $this->render(Pemasukan::with(['customer', 'kategori', 'bank'])->findOrFail($id), 'pemasukan');
    }

    public function pengeluaran($id)
    {
        return $this->render(Pengeluaran::with(['kategori', 'bank'])->findOrFail($id), 'pengeluaran');
    }

    private function render($transaction, string $type)
    {
        $background = public_path('assets/img/kwitansi-pembayaran.jpg');
        abort_unless(is_file($background), 500, 'Template kwitansi tidak ditemukan.');
        [$imageWidth, $imageHeight] = getimagesize($background);
        $width = 210;
        $height = $width * $imageHeight / $imageWidth;
        $number = ($type === 'pemasukan' ? $transaction->no_kwitansi : $transaction->no_tanda_terima)
            ?: strtoupper($type).'-'.$transaction->id;
        $payer = $type === 'pemasukan'
            ? ($transaction->customer?->nama_lengkap ?: '-')
            : ($transaction->diterima_dari ?: (PengaturanProfil::first()?->nama_perusahaan ?: '-'));
        $description = trim(explode('[Sumber:', $transaction->keterangan ?? '')[0]);
        $category = $transaction->kategori;
        $account = $transaction->bank?->nama ?? '-';
        $amount = number_format((float) $transaction->nominal, 2, '.', '');
        [$whole, $cents] = explode('.', $amount);
        $words = ucfirst($this->terbilang((int) $whole)).' rupiah';
        if ((int) $cents) { $words .= ' '. $this->terbilang((int) $cents).' sen'; }

        $pdf = new TCPDF('L', 'mm', [$width, $height], true, 'UTF-8', false);
        $pdf->SetTitle('Kwitansi '.ucfirst($type).' - '.$number);
        $pdf->SetAuthor('Putra Anugerah Propertindo');
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage('L', [$width, $height]);
        $pdf->Image($background, 0, 0, $width, $height, 'JPG');
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->SetFont('times', 'B', 11);
        $pdf->MultiCell(140, 6, $number, 0, 'L', false, 1, 55, 6, true, 0, false, true, 7, 'M', true);
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(115, 7, $payer, 0, 'L', false, 1, 82, 12.5, true, 0, false, true, 7, 'M', true);
        $pdf->SetFont('times', 'I', 11);
        $pdf->MultiCell(115, 8, $words, 0, 'L', false, 1, 82, 21.5, true, 0, false, true, 8, 'M', true);
        $pdf->SetFont('times', '', 10);
        $pdf->MultiCell(115, 8, $description ?: ($category?->kategori ?? '-'), 0, 'L', false, 1, 82, 31.5, true, 0, false, true, 8, 'M', true);
        $detail = ucfirst($type).' | '.($category ? $category->kode.' - '.$category->kategori : '-').' | '.$account;
        $pdf->MultiCell(144, 7, $detail, 0, 'L', false, 1, 53, 39.5, true, 0, false, true, 7, 'M', true);
        $pdf->SetFont('times', 'B', 13);
        $pdf->MultiCell(43, 7, number_format((float) $amount, 2, ',', '.'), 0, 'C', false, 1, 62, 59, true, 0, false, true, 7, 'M', true);
        $pdf->SetFont('times', '', 10);
        $date = Carbon::parse($transaction->tanggal)->locale('id')->translatedFormat('d F Y');
        $pdf->SetXY(147, 54);
        $pdf->Cell(50, 5, 'Kendari, '.$date, 0, 0, 'C');
        if ($type === 'pengeluaran') {
            $pdf->MultiCell(50, 5, 'Penerima: '.($transaction->nama_penerima ?: '-'), 0, 'C', false, 1, 147, 64, true, 0, false, true, 5, 'M', true);
        }
        $filename = 'Kwitansi-'.$type.'-'.$transaction->id.'.pdf';
        return response($pdf->Output($filename, 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
        ]);
    }

    private function terbilang(int $number): string
    {
        $digits = ['nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
        if ($number < 12) { return $digits[$number]; }
        if ($number < 20) { return $this->terbilang($number - 10).' belas'; }
        if ($number < 100) { $unit = 10; $name = 'puluh'; }
        elseif ($number < 200) { return 'seratus'.($number > 100 ? ' '.$this->terbilang($number - 100) : ''); }
        elseif ($number < 1000) { $unit = 100; $name = 'ratus'; }
        elseif ($number < 2000) { return 'seribu'.($number > 1000 ? ' '.$this->terbilang($number - 1000) : ''); }
        elseif ($number < 1000000) { $unit = 1000; $name = 'ribu'; }
        elseif ($number < 1000000000) { $unit = 1000000; $name = 'juta'; }
        elseif ($number < 1000000000000) { $unit = 1000000000; $name = 'miliar'; }
        else { $unit = 1000000000000; $name = 'triliun'; }
        return $this->terbilang(intdiv($number, $unit)).' '.$name.($number % $unit ? ' '.$this->terbilang($number % $unit) : '');
    }
}

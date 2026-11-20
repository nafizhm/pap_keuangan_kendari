<?php
return [
    'banks' => ['PC' => 'PATTY CASH', 'IB' => 'REKENING GIRO BRI', 'GR' => 'REKENING GIRO BANK SYARIAH NASIONAL', 'GM' => 'REKENING GIRO BANK MANDIRI', 'BS' => 'REKENING PRIBADI', 'BTNK' => 'REKENING GIRO BANK BTN'],
    'display_banks' => ['PATTY CASH', 'REKENING GIRO BRI', 'REKENING GIRO BANK SYARIAH NASIONAL', 'REKENING GIRO BANK MANDIRI', 'REKENING PRIBADI', 'REKENING GIRO BANK BTN'],
    'coa' => [
        'pemasukan' => [
            ['3100', 'Saldo Awal', '/^SALDO\b/'],
            ['1191', 'Transfer Masuk Antar Rekening', '/PEMINDAHAN DANA|PINDAH BUKU|PEMINDAHBUKUAN|PATT?Y CASH|PETTY CASH/'],
            ['4100', 'Penerimaan Air dan Sampah', '/PEM[B]*AYARAN AIR|PEMBAYARAN.*SAMPAH|IURAN.*AIR/'],
            ['4200', 'Penerimaan Rumah dan KPR', '/RUMAH CASH|PENCAIRAN.*KPR|CICILAN|UANG MUKA|BOOKING|PEMBAYARAN.*RUMAH/'],
            ['4300', 'Penerimaan Administrasi Pelanggan', '/MATERAI|BIAYA AKAD|BIAYA KANTOR|BIAYA TAMBAHAN/'],
            ['4400', 'Penerimaan Bunga dan Bagi Hasil', '/BUNGA|BAGI HASIL/'],
            ['4999', 'Penerimaan Lainnya - Perlu Review', '//'],
        ],
        'pengeluaran' => [
            ['1192', 'Transfer Keluar Antar Rekening', '/PEMINDAHAN DANA|PINDAH BUKU|PEMINDAHBUKUAN|PATT?Y CASH|PETTY CASH/'],
            ['6100', 'Biaya Administrasi Bank', '/BIAYA.*(TRANSFER|TRASNFER|ADMIN)|CHARGE ADMIN|PAJAK.*BUNGA|TAX BAGI HASIL/'],
            ['6200', 'Biaya Gaji dan Upah', '/\bGAJI\b|\bUPAH\b/'],
            ['6300', 'Biaya Konsumsi', '/KONSUMSI|KONNSUMSI|BERAS|GALON|MAKAN|MINUM/'],
            ['6400', 'Biaya Kendaraan dan BBM', '/BENSIN|SOLAR|PERTALITE|PERTAMAX|CUCI MOBIL|ALAT MOBIL|SERVICE MOBIL|SERVIS MOBIL/'],
            ['6500', 'Biaya Komunikasi dan Utilitas', '/PULSA|INTERNET|TOKEN LISTRIK|TAGIHAN LISTRIK/'],
            ['5100', 'Pembelian Material Proyek', '/SEMEN|BATU MERAH|PASIR|BESI|PAVING|BROCO|SILICONE|KERAMIK|BAJA|PIPA|KUNCIN SLEDING/'],
            ['6600', 'Biaya Sosial dan Donasi', '/CERAMAH|DONASI|SUMBANGAN/'],
            ['5999', 'Pengeluaran Lainnya - Perlu Review', '//'],
        ],
    ],
];

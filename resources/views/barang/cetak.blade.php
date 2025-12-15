<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Pinjam Pakai - {{ $barang->nama_barang }}</title>
    <style>
        /* Reset untuk print */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            color: #000;
            line-height: 1.5;
        }

        @media print {
            body {
                margin: 15mm 15mm 15mm 15mm;
            }

            @page {
                margin: 15mm;
            }

            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-after: always;
            }

            /* Menghilangkan header dan footer browser saat print */
            @page {
                size: A4;
                margin: 15mm;

                /* Menghilangkan header default browser */
                marks: none;

                /* Menghilangkan tanggal dan judul halaman */
                @top-left {
                    content: '';
                }

                @top-center {
                    content: '';
                }

                @top-right {
                    content: '';
                }

                @bottom-left {
                    content: '';
                }

                @bottom-center {
                    content: '';
                }

                @bottom-right {
                    content: '';
                }
            }

            /* Memastikan semua konten bisa terbaca saat print */
            * {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Kop Surat dengan logo di kiri */
        .kop-surat {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }

        .logo-container {
            flex: 0 0 auto;
            margin-right: 20px;
        }

        .logo {
            height: 100px;
            width: auto;
        }

        .kop-text {
            flex: 1;
            text-align: center;
        }

        .kop-text h1 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-text h2 {
            font-size: 12pt;
            font-weight: bold;
            margin: 3px 0;
            padding: 0;
            text-transform: uppercase;
        }

        .kop-text p {
            font-size: 11pt;
            margin: 2px 0;
            padding: 0;
        }

        /* Judul Surat */
        .judul-surat {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            text-decoration: underline;
            margin: 20px 0 5px 0;
            text-transform: uppercase;
        }

        .nomor-surat {
            text-align: center;
            margin-bottom: 30px;
            font-size: 11pt;
        }

        /* Konten */
        .content {
            text-align: justify;
            margin-bottom: 20px;
        }

        .content p {
            margin-bottom: 12px;
            text-indent: 30px;
        }

        /* Tabel Detail Barang */
        table.detail-barang {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        table.detail-barang td {
            padding: 5px 8px;
            vertical-align: top;
            font-size: 11pt;
        }

        table.detail-barang tr td:first-child {
            width: 30%;
            font-weight: bold;
        }

        /* Tanda Tangan */
        .ttd-section {
            margin-top: 80px;
            width: 100%;
        }

        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ttd-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .ttd-space {
            height: 70px;
        }

        .penandatangan {
            font-weight: bold;
            margin-top: 5px;
        }

        .nip {
            font-size: 10pt;
            margin-top: 3px;
        }

        /* Footer */
        .footer-note {
            font-size: 10pt;
            text-align: center;
            margin-top: 40px;
            font-style: italic;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        /* Utilities */
        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .text-center {
            text-align: center;
        }

        /* Untuk preview di browser */
        @media screen {
            body {
                background: #f5f5f5;
                padding: 20px;
                margin: 0;
            }

            .print-container {
                background: white;
                max-width: 800px;
                margin: 0 auto;
                padding: 30px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .action-buttons {
                text-align: center;
                margin-top: 20px;
                padding: 20px;
                background: #f8f9fa;
                border-radius: 8px;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                margin: 0 5px;
                background: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                border: none;
                cursor: pointer;
                font-size: 14px;
            }

            .btn:hover {
                background: #0056b3;
            }

            .btn-print {
                background: #28a745;
            }

            .btn-print:hover {
                background: #1e7e34;
            }

            .btn-back {
                background: #6c757d;
            }

            .btn-back:hover {
                background: #545b62;
            }
        }
    </style>
</head>

<body>
    <div class="print-container">
        <!-- Kop Surat dengan logo di kiri -->
        <div class="kop-surat">
            <div class="logo-container">
                @if (file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Kabupaten Probolinggo" class="logo">
                @else
                    <!-- Fallback jika logo tidak ada -->
                    <div
                        style="width: 100px; height: 100px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-size: 10pt; text-align: center;">
                        LOGO<br>KABUPATEN<br>PROBOLINGGO
                    </div>
                @endif
            </div>
            <div class="kop-text">
                <h1>PEMERINTAH KABUPATEN PROBOLINGGO</h1>
                <h2>SATUAN POLISI PAMONG PRAJA</h2>
                <p>Jl. Rengganis No. 04 Telp: (0335) 845492</p>
                <p class="bold">KRAKSAAN</p>
            </div>
        </div>

        <!-- Judul Surat -->
        <div class="judul-surat">
            BERITA ACARA PINJAM PAKAI BARANG MILIK DAERAH
        </div>

        <!-- Nomor Surat -->
        <div class="nomor-surat">
            Nomor : ........................ / ................. / 426.120 / {{ date('Y') }}
        </div>

        <!-- Isi Surat -->
        <div class="content">
            <p>
                Pada hari ini <span class="bold">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>,
                kami yang bertanda tangan di bawah ini:
            </p>

            <table class="detail-barang">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td class="bold">SUGENG WIYANTO, S.Sos. MM</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>Kepala Satuan Polisi Pamong Praja Kabupaten Probolinggo</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jl. Rengganis No. 04 Kraksaan</td>
                </tr>
            </table>

            <p>
                Dalam hal ini bertindak untuk dan atas nama Kepala Satuan Polisi Pamong Praja
                Pemerintah Kabupaten Probolinggo selaku Pengguna Barang / Kuasa Pengguna Barang,
                yang selanjutnya disebut <span class="bold underline">PIHAK KESATU</span>.
            </p>

            <p>
                Bahwa <span class="bold underline">PIHAK KESATU</span> telah menyerahkan barang kepada
                <span class="bold underline">PIHAK KEDUA</span> berupa:
            </p>

            <!-- Detail Barang -->
            <table class="detail-barang">
                <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td class="bold">{{ $barang->nama_barang }}</td>
                </tr>
                <tr>
                    <td>Kode Aset / NIBAR</td>
                    <td>:</td>
                    <td>{{ $kodeAset }} / {{ $barang->nibar ?? '-' }}</td>
                </tr>
                @if ($merkTipe != '-')
                    <tr>
                        <td>Merk / Tipe</td>
                        <td>:</td>
                        <td>{{ $merkTipe }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Jumlah</td>
                    <td>:</td>
                    <td>{{ $barang->jumlah ?? 0 }} {{ $barang->satuan ?? 'Unit' }}</td>
                </tr>
                @if ($barang->nopol)
                    <tr>
                        <td>Nomor Polisi</td>
                        <td>:</td>
                        <td>{{ $barang->nopol }}</td>
                    </tr>
                @endif
                @if ($barang->nomor_rangka || $barang->nomor_bpkb)
                    <tr>
                        <td>Nomor Rangka / BPKB</td>
                        <td>:</td>
                        <td>{{ $barang->nomor_rangka ?? '-' }} / {{ $barang->nomor_bpkb ?? '-' }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Kondisi</td>
                    <td>:</td>
                    <td>{{ $barang->kondisi ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Lokasi Barang</td>
                    <td>:</td>
                    <td>{{ $barang->lokasi ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Nilai Perolehan</td>
                    <td>:</td>
                    <td>Rp {{ number_format($nilaiPerolehan, 0, ',', '.') }}</td>
                </tr>
                @if ($tanggalPerolehan != '-')
                    <tr>
                        <td>Tanggal Perolehan</td>
                        <td>:</td>
                        <td>{{ $tanggalPerolehan }}</td>
                    </tr>
                @endif
            </table>

            <p>
                Penyerahan barang tersebut dipergunakan untuk kepentingan dinas
                di lingkungan Pemerintah Kabupaten Probolinggo.
            </p>

            <p>
                Dengan ditandatanganinya Berita Acara ini maka tanggung jawab
                penggunaan, pemeliharaan, dan pengamanan barang menjadi tanggung jawab
                <span class="bold underline">PIHAK KEDUA</span>.
            </p>

            <p>
                Demikian Berita Acara ini dibuat untuk dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <!-- Tanda Tangan -->
        <div class="ttd-section">
            <table class="ttd-table">
                <tr>
                    <td>
                        PIHAK KEDUA<br>
                        YANG MENERIMA BARANG<br>
                        <div class="ttd-space"></div>
                        (........................................)<br>
                        <div class="nip">NIP. </div>
                    </td>
                    <td>
                        PIHAK KESATU<br>
                        YANG MENYERAHKAN BARANG<br>
                        <div class="ttd-space"></div>
                        <div class="penandatangan">SUGENG WIYANTO, S.Sos. MM</div>
                        <div class="nip">Pembina Utama Muda</div>
                        <div class="nip">NIP. 19690322 199703 1 002</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Catatan Kaki -->
        <div class="footer-note">
            Tembusan:<br>
            1. Arsip Satuan Polisi Pamong Praja<br>
            2. Bagian Keuangan Setda Kab. Probolinggo<br>
            3. Yang Bersangkutan
        </div>
    </div>

    <!-- Tombol Aksi untuk Preview di Browser -->
    <div class="action-buttons no-print">
        <button onclick="window.print()" class="btn btn-print">🖨️ Cetak Dokumen</button>
        <button onclick="window.history.back()" class="btn btn-back">← Kembali</button>
        <a href="{{ route('barang.show', $barang->id) }}" class="btn">📋 Detail Barang</a>
    </div>

    <script>
        // Auto print jika parameter print=1 ada di URL atau dari controller
        @if (isset($autoPrint) && $autoPrint)
            window.onload = function() {
                setTimeout(function() {
                    window.print();
                }, 1000);
            };
        @endif

        // Auto print jika ada parameter print di URL
        if (window.location.search.includes('print=true') || window.location.search.includes('print=1')) {
            window.onload = function() {
                setTimeout(function() {
                    window.print();
                }, 1000);
            };
        }

        // Menghilangkan header dan footer browser saat print
        window.onbeforeprint = function() {
            // Kosongkan judul halaman untuk menghilangkan header browser
            document.title = " ";
        };

        window.onafterprint = function() {
            // Kembalikan judul asli setelah print
            document.title = "Berita Acara Pinjam Pakai - {{ $barang->nama_barang }}";
        };
    </script>
</body>

</html>

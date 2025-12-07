@extends('layout.app')

@section('content')
    <!-- Dashboard Home -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

    <div class="p-6 md:p-10 space-y-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div data-aos="fade-right">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Dashboard Inventaris</h1>
                <p class="text-gray-500 mt-1">Ringkasan barang & perawatan — tampilan modern dengan animasi</p>
            </div>

            <div class="flex items-center gap-3" data-aos="fade-left">
                <button id="refreshBtn"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white border border-gray-200 hover:shadow">
                    <svg class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 20v-6h-6" />
                    </svg>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Top stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="zoom-in">
                <p class="text-sm text-gray-500">Total Barang</p>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-blue-600" id="countTotal">{{ $totalBarang ?? 0 }}</h3>
                        <p class="text-xs text-gray-400 mt-1">Semua item di inventaris</p>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <svg class="w-7 h-7 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="zoom-in"
                data-aos-delay="100">
                <p class="text-sm text-gray-500">Kondisi Baik</p>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-green-600" id="countBaik">{{ $barangBaik ?? 0 }}</h3>
                        <p class="text-xs text-gray-400 mt-1">Barang dalam kondisi baik</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <svg class="w-7 h-7 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="zoom-in"
                data-aos-delay="200">
                <p class="text-sm text-gray-500">Rusak Berat</p>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-red-600" id="countRusak">{{ $barangRusak ?? 0 }}</h3>
                        <p class="text-xs text-gray-400 mt-1">Barang perlu perhatian</p>
                    </div>
                    <div class="bg-red-50 p-3 rounded-lg">
                        <svg class="w-7 h-7 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition" data-aos="zoom-in"
                data-aos-delay="300">
                <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-purple-600" id="countDipinjam">{{ $barangDipinjam ?? 0 }}</h3>
                        <p class="text-xs text-gray-400 mt-1">Jumlah yang dipinjam</p>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <svg class="w-7 h-7 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & recent -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Perawatan chart (big) -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm" data-aos="fade-up">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Grafik Perawatan (per bulan)</h3>
                    <p class="text-sm text-gray-500">Data: tahun berjalan</p>
                </div>

                <div class="mt-4">
                    <canvas id="perawatanChart" height="150"></canvas>
                </div>

                <div class="mt-5 flex gap-3">
                    <div class="flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        <span class="text-sm text-gray-600">Perawatan</span>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                        <span class="text-sm text-gray-600">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- Right side small stats + donut -->
            <div class="bg-white rounded-2xl p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-lg font-semibold text-gray-800">Status Perawatan</h3>

                <div class="mt-4 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Perawatan</p>
                            <p class="font-semibold text-xl">{{ $statPerawatan['total'] ?? 0 }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Selesai</p>
                            <p class="font-semibold text-xl text-green-600">{{ $statPerawatan['selesai'] ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Dalam Proses</p>
                            <p class="font-semibold text-lg text-amber-500">{{ $statPerawatan['dalam_proses'] ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Terjadwal</p>
                            <p class="font-semibold text-lg text-indigo-600">{{ $statPerawatan['terjadwal'] ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <canvas id="donutStatus" height="200"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent perawatan table (simple) -->
        <div class="bg-white rounded-2xl p-6 shadow-sm" data-aos="fade-up">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Perawatan Terakhir</h3>
                <a href="{{ route('perawatan.index') }}" class="text-sm text-blue-600 hover:underline">Lihat semua</a>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase">
                        <tr>
                            <th class="px-3 py-2">Tanggal</th>
                            <th class="px-3 py-2">Barang</th>
                            <th class="px-3 py-2">Jenis</th>
                            <th class="px-3 py-2">Teknisi</th>
                            <th class="px-3 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // ambil 6 perawatan terbaru, optimalkan query di controller kalau perlu
                            $recentPerawatan = \App\Models\Perawatan::with('barang')->latest()->limit(6)->get();
                        @endphp

                        @forelse($recentPerawatan as $p)
                            <tr class="border-t">
                                <td class="px-3 py-3 whitespace-nowrap">
                                    {{ $p->tanggal_perawatan ? $p->tanggal_perawatan->format('d M Y') : '-' }}</td>
                                <td class="px-3 py-3 whitespace-nowrap">{{ $p->barang->nama_barang ?? '—' }}</td>
                                <td class="px-3 py-3 whitespace-nowrap">{{ $p->jenis_perawatan }}</td>
                                <td class="px-3 py-3 whitespace-nowrap">{{ $p->teknisi ?? '-' }}</td>
                                <td class="px-3 py-3 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium
                  {{ $p->status == 'Selesai' ? 'bg-green-100 text-green-800' : ($p->status == 'Dalam proses' ? 'bg-amber-100 text-amber-800' : 'bg-indigo-100 text-indigo-800') }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4" colspan="5">Belum ada data perawatan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
        <!-- libs -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.8/countUp.umd.js"></script>

        <script>
            // init AOS
            AOS.init({
                duration: 900,
                once: true
            });

            // COUNTERS (CountUp)
            document.addEventListener('DOMContentLoaded', function() {
                const opts = {
                    duration: 1.6,
                    separator: '.'
                };

                const total = new countUp.CountUp('countTotal', {{ $totalBarang ?? 0 }}, opts);
                const baik = new countUp.CountUp('countBaik', {{ $barangBaik ?? 0 }}, opts);
                const rusak = new countUp.CountUp('countRusak', {{ $barangRusak ?? 0 }}, opts);
                const dipinjam = new countUp.CountUp('countDipinjam', {{ $barangDipinjam ?? 0 }}, opts);

                if (!total.error) total.start();
                if (!baik.error) baik.start();
                if (!rusak.error) rusak.start();
                if (!dipinjam.error) dipinjam.start();

                document.getElementById('refreshBtn')?.addEventListener('click', () => location.reload());
            });

            // DATA untuk chart (dari controller)
            const perawatanLabels = {!! json_encode(array_keys($perawatanBulanan ?? [])) !!}; // bulan key => angka (1..12) atau label
            const perawatanData = {!! json_encode(array_values($perawatanBulanan ?? [])) !!};

            // Ubah label angka bulan ke nama bulan (jika angka)
            const labelsFriendly = perawatanLabels.map(m => {
                if (!m) return '';
                const n = parseInt(m);
                if (isNaN(n)) return m;
                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                return monthNames[n - 1] ?? String(n);
            });

            // Line chart perawatan
            (function() {
                const ctx = document.getElementById('perawatanChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labelsFriendly,
                        datasets: [{
                            label: 'Jumlah Perawatan',
                            data: perawatanData,
                            borderColor: 'rgba(59,130,246,1)',
                            backgroundColor: 'rgba(59,130,246,0.12)',
                            tension: 0.35,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1200,
                            easing: 'easeOutQuart'
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            })();

            // Donut chart for perawatan status (built from statPerawatan)
            (function() {
                const ctx2 = document.getElementById('donutStatus').getContext('2d');

                const selesai = {{ $statPerawatan['selesai'] ?? 0 }};
                const dalam = {{ $statPerawatan['dalam_proses'] ?? 0 }};
                const terjadwal = {{ $statPerawatan['terjadwal'] ?? 0 }};

                const donut = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: ['Selesai', 'Dalam proses', 'Terjadwal'],
                        datasets: [{
                            data: [selesai, dalam, terjadwal],
                            backgroundColor: ['#10B981', '#F59E0B', '#6366F1'],
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: ctx => `${ctx.label}: ${ctx.parsed}`
                                }
                            }
                        }
                    }
                });
            })();
        </script>
    @endpush
@endsection

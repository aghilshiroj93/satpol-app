@extends('layout.app')

@section('content')
    <!-- Dashboard Home -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
        /* Custom animations */
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }
        
        .slide-in-left {
            animation: slideInLeft 0.8s ease-out forwards;
            opacity: 0;
            transform: translateX(-30px);
        }
        
        .slide-in-right {
            animation: slideInRight 0.8s ease-out forwards;
            opacity: 0;
            transform: translateX(30px);
        }
        
        .slide-in-up {
            animation: slideInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }
        
        .scale-in {
            animation: scaleIn 0.8s ease-out forwards;
            opacity: 0;
            transform: scale(0.9);
        }
        
        .rotate-in {
            animation: rotateIn 1s ease-out forwards;
            opacity: 0;
            transform: rotate(-10deg) scale(0.8);
        }
        
        .stagger-delay-1 { animation-delay: 0.1s; }
        .stagger-delay-2 { animation-delay: 0.2s; }
        .stagger-delay-3 { animation-delay: 0.3s; }
        .stagger-delay-4 { animation-delay: 0.4s; }
        .stagger-delay-5 { animation-delay: 0.5s; }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .stat-card-icon {
            transition: all 0.5s ease;
        }
        
        .stat-card:hover .stat-card-icon {
            transform: scale(1.2) rotate(10deg);
        }
        
        .refresh-spin {
            transition: transform 0.5s ease;
        }
        
        .refresh-spin:hover {
            transform: rotate(180deg);
        }
        
        .table-row-animate {
            animation: fadeInRow 0.5s ease-out forwards;
            opacity: 0;
        }
        
        .chart-container {
            opacity: 0;
            animation: fadeIn 1s ease-out 0.3s forwards;
        }
        
        /* Keyframes */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 10px rgba(59, 130, 246, 0.5); }
            100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.8); }
        }
        
        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes rotateIn {
            to {
                opacity: 1;
                transform: rotate(0) scale(1);
            }
        }
        
        @keyframes fadeInRow {
            to {
                opacity: 1;
            }
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        
        .shimmer-text {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 2s infinite linear;
        }
    </style>

    <div class="p-6 md:p-10 space-y-8">

        <!-- Header dengan animasi masuk -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 overflow-hidden">
            <div class="slide-in-left">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Dashboard Inventaris
                    <span class="text-blue-500 float-animation inline-block">✨</span>
                </h1>
                <p class="text-gray-500 mt-1 flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    Ringkasan barang & perawatan — dengan animasi yang memukau
                </p>
            </div>

            <div class="slide-in-right">
                <button id="refreshBtn"
                    class="refresh-spin inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 hover:shadow-lg hover:shadow-blue-100 transition-all duration-300 group">
                    <svg class="w-5 h-5 text-blue-600 group-hover:rotate-180 transition-transform duration-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span class="font-medium">Refresh Data</span>
                </button>
            </div>
        </div>

        <!-- Top stats dengan animasi cascade -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $stats = [
                    ['value' => $totalBarang ?? 0, 'label' => 'Total Barang', 'color' => 'blue', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['value' => $barangBaik ?? 0, 'label' => 'Kondisi Baik', 'color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['value' => $barangRusak ?? 0, 'label' => 'Rusak Berat', 'color' => 'red', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.882 16.5c-.77.833.192 2.5 1.732 2.5z'],
                    ['value' => $barangDipinjam ?? 0, 'label' => 'Sedang Dipinjam', 'color' => 'purple', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ];
            @endphp

            @foreach($stats as $index => $stat)
            <div class="stat-card bg-white rounded-2xl p-6 shadow-sm hover-lift scale-in stagger-delay-{{ $index + 1 }} overflow-hidden relative group">
                <!-- Background effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-{{ $stat['color'] }}-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="relative">
                    <p class="text-sm text-gray-500 mb-1">{{ $stat['label'] }}</p>
                    <div class="mt-2 flex items-center justify-between">
                        <div>
                            <h3 id="count{{ ucfirst($stat['color']) }}" 
                                class="text-3xl font-bold text-{{ $stat['color'] }}-600">{{ $stat['value'] }}</h3>
                            <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-{{ $stat['color'] }}-400 rounded-full animate-pulse"></span>
                                Semua item di inventaris
                            </p>
                        </div>
                        <div class="stat-card-icon bg-{{ $stat['color'] }}-50 p-4 rounded-xl">
                            <svg class="w-8 h-8 text-{{ $stat['color'] }}-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" />
                            </svg>
                        </div>
                    </div>
                    <!-- Progress bar subtle -->
                    <div class="mt-4 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-{{ $stat['color'] }}-500 rounded-full transition-all duration-1000" 
                             style="width: {{ min(100, ($stat['value'] / max(1, $totalBarang)) * 100) }}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Charts & recent dengan animasi bertahap -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Perawatan chart (big) -->
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm hover-lift rotate-in overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Grafik Perawatan</h3>
                        <p class="text-sm text-gray-500 mt-1">Data per bulan tahun berjalan</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium animate-pulse">
                            Live
                        </span>
                    </div>
                </div>

                <div class="mt-4 chart-container">
                    <canvas id="perawatanChart" height="150"></canvas>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
                        <span class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium text-gray-700">Total Perawatan</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-green-50 rounded-xl hover:bg-green-100 transition-colors">
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                        <span class="text-sm font-medium text-gray-700">Selesai</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                        <span class="w-3 h-3 bg-amber-500 rounded-full"></span>
                        <span class="text-sm font-medium text-gray-700">Dalam Proses</span>
                    </div>
                </div>
            </div>

            <!-- Right side small stats + donut -->
            <div class="bg-white rounded-2xl p-6 shadow-sm hover-lift slide-in-up overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Status Perawatan</h3>
                    <div class="relative">
                        <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full animate-ping"></div>
                        <div class="relative w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                            <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Stats Cards Mini -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 p-4 rounded-xl border border-blue-100">
                            <p class="text-xs text-blue-600 font-medium">Total</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $statPerawatan['total'] ?? 0 }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100/50 p-4 rounded-xl border border-green-100">
                            <p class="text-xs text-green-600 font-medium">Selesai</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $statPerawatan['selesai'] ?? 0 }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 p-4 rounded-xl border border-amber-100">
                            <p class="text-xs text-amber-600 font-medium">Proses</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $statPerawatan['dalam_proses'] ?? 0 }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100/50 p-4 rounded-xl border border-indigo-100">
                            <p class="text-xs text-indigo-600 font-medium">Terjadwal</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $statPerawatan['terjadwal'] ?? 0 }}</p>
                        </div>
                    </div>

                    <!-- Donut Chart -->
                    <div class="mt-6 chart-container">
                        <canvas id="donutStatus" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent perawatan table dengan animasi baris -->
        <div class="bg-white rounded-2xl p-6 shadow-sm hover-lift slide-in-up overflow-hidden">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Perawatan Terakhir</h3>
                    <p class="text-sm text-gray-500 mt-1">6 aktivitas perawatan terkini</p>
                </div>
                <a href="{{ route('perawatan.index') }}" 
                   class="group inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-all duration-300">
                    <span class="font-medium">Lihat Semua</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-100">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Teknisi</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $recentPerawatan = \App\Models\Perawatan::with('barang')->latest()->limit(6)->get();
                        @endphp

                        @forelse($recentPerawatan as $index => $p)
                        <tr class="table-row-animate hover:bg-gray-50 transition-colors duration-200" style="animation-delay: {{ $index * 0.1 }}s">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $p->tanggal_perawatan ? $p->tanggal_perawatan->format('d M Y') : '-' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $p->tanggal_perawatan ? $p->tanggal_perawatan->format('H:i') : '' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $p->barang->nama_barang ?? '—' }}</div>
                                        <div class="text-xs text-gray-500">Kode: {{ $p->barang->kode_barang ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                                    {{ $p->jenis_perawatan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-600">
                                            {{ substr($p->teknisi ?? 'T', 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="font-medium">{{ $p->teknisi ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="relative inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-semibold
                                    {{ $p->status == 'Selesai' ? 'bg-green-100 text-green-800' : 
                                       ($p->status == 'Dalam proses' ? 'bg-amber-100 text-amber-800' : 'bg-indigo-100 text-indigo-800') }}">
                                    @if($p->status == 'Selesai')
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                    @elseif($p->status == 'Dalam proses')
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                    @else
                                        <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                                    @endif
                                    {{ $p->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-6 py-8 text-center text-gray-500" colspan="5">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-gray-500">Belum ada data perawatan.</p>
                                </div>
                            </td>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.8.0/countUp.umd.min.js"></script>

        <script>
            // Enhanced AOS initialization
            AOS.init({
                duration: 1200,
                once: true,
                mirror: false,
                easing: 'ease-out-cubic'
            });

            // Smooth counter animation with CountUp.js
            document.addEventListener('DOMContentLoaded', function() {
                const counterOptions = {
                    duration: 2.5,
                    useEasing: true,
                    useGrouping: true,
                    separator: '.',
                    decimal: ',',
                    prefix: '',
                    suffix: ''
                };

                // Initialize counters
                const counters = [
                    { id: 'countBlue', value: {{ $totalBarang ?? 0 }} },
                    { id: 'countGreen', value: {{ $barangBaik ?? 0 }} },
                    { id: 'countRed', value: {{ $barangRusak ?? 0 }} },
                    { id: 'countPurple', value: {{ $barangDipinjam ?? 0 }} }
                ];

                const counterInstances = [];
                counters.forEach(counter => {
                    const countUp = new countUp.CountUp(counter.id, counter.value, counterOptions);
                    if (!countUp.error) {
                        counterInstances.push(countUp);
                    }
                });

                // Start counters with delay
                setTimeout(() => {
                    counterInstances.forEach((instance, index) => {
                        setTimeout(() => {
                            instance.start();
                        }, index * 200);
                    });
                }, 500);

                // Refresh button animation
                const refreshBtn = document.getElementById('refreshBtn');
                if (refreshBtn) {
                    refreshBtn.addEventListener('click', function() {
                        this.classList.add('animate-spin');
                        setTimeout(() => {
                            this.classList.remove('animate-spin');
                            location.reload();
                        }, 800);
                    });
                }

                // Add hover effects to cards
                document.querySelectorAll('.stat-card').forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        card.style.transform = 'translateY(-8px) scale(1.02)';
                    });
                    
                    card.addEventListener('mouseleave', () => {
                        card.style.transform = 'translateY(0) scale(1)';
                    });
                });
            });

            // Data untuk chart
            const perawatanLabels = {!! json_encode(array_keys($perawatanBulanan ?? [])) !!};
            const perawatanData = {!! json_encode(array_values($perawatanBulanan ?? [])) !!};

            // Convert month numbers to names
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            const labelsFriendly = perawatanLabels.map(m => {
                if (!m) return '';
                const n = parseInt(m);
                return isNaN(n) ? m : (monthNames[n - 1] || String(n));
            });

            // Enhanced Line Chart
            (function() {
                const ctx = document.getElementById('perawatanChart').getContext('2d');
                
                // Gradient for chart area
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
                gradient.addColorStop(1, 'rgba(59, 130, 246, 0.05)');
                
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labelsFriendly,
                        datasets: [{
                            label: 'Jumlah Perawatan',
                            data: perawatanData,
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: gradient,
                            tension: 0.4,
                            pointRadius: 6,
                            pointHoverRadius: 10,
                            pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            fill: true,
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1500,
                            easing: 'easeOutQuart'
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    precision: 0,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleFont: {
                                    size: 12
                                },
                                bodyFont: {
                                    size: 13
                                },
                                padding: 12,
                                cornerRadius: 8
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });
            })();

            // Enhanced Donut Chart
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
                            backgroundColor: [
                                'rgba(16, 185, 129, 0.9)',
                                'rgba(245, 158, 11, 0.9)',
                                'rgba(99, 102, 241, 0.9)'
                            ],
                            borderColor: [
                                'rgba(16, 185, 129, 1)',
                                'rgba(245, 158, 11, 1)',
                                'rgba(99, 102, 241, 1)'
                            ],
                            borderWidth: 2,
                            hoverBackgroundColor: [
                                'rgba(16, 185, 129, 1)',
                                'rgba(245, 158, 11, 1)',
                                'rgba(99, 102, 241, 1)'
                            ],
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        animation: {
                            animateScale: true,
                            animateRotate: true,
                            duration: 2000
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            })();

            // Table row animation on scroll
            function animateTableRows() {
                const rows = document.querySelectorAll('.table-row-animate');
                rows.forEach((row, index) => {
                    const rect = row.getBoundingClientRect();
                    if (rect.top < window.innerHeight * 0.9) {
                        setTimeout(() => {
                            row.style.opacity = '1';
                            row.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }

            window.addEventListener('scroll', animateTableRows);
            animateTableRows(); // Initial check
        </script>
    @endpush
@endsection
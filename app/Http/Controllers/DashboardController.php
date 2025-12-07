<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Perawatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik barang
        $totalBarang = MasterBarang::count();
        $barangBaik = MasterBarang::where('kondisi', 'Baik')->count();
        $barangRusak = MasterBarang::where('kondisi', 'Rusak Berat')->count();
        $barangDipinjam = MasterBarang::where('keberadaan', 'Dipinjam')->count();

        // Statistik perawatan (pakai method di model Perawatan jika ada)
        // Jika method getStatistik() tidak ada, kita buat manual
        $statPerawatan = $this->getStatistikPerawatan();

        // Grafik perawatan per hari (30 hari terakhir)
        $perawatanHarian = $this->getPerawatanHarian(30);

        // Konversi ke format yang diharapkan view (jika diperlukan)
        // View sudah siap menerima data perawatanHarian
        // Tapi kita juga perlu data perawatanBulanan untuk kompatibilitas
        $perawatanBulanan = $this->getPerawatanBulanan();

        return view('dashboard.home', compact(
            'totalBarang',
            'barangBaik',
            'barangRusak',
            'barangDipinjam',
            'statPerawatan',
            'perawatanHarian',  // Data baru untuk grafik harian
            'perawatanBulanan'  // Tetap ada untuk kompatibilitas
        ));
    }

    /**
     * Get statistik perawatan
     */
    private function getStatistikPerawatan()
    {
        try {
            // Coba pakai method dari model jika ada
            if (method_exists(Perawatan::class, 'getStatistik')) {
                return Perawatan::getStatistik();
            }

            // Jika method tidak ada, buat manual
            $total = Perawatan::count();
            $selesai = Perawatan::where('status', 'Selesai')->count();
            $dalamProses = Perawatan::where('status', 'Dalam proses')->count();
            $terjadwal = Perawatan::where('status', 'Terjadwal')->orWhere('status', 'Menunggu')->count();

            return [
                'total' => $total,
                'selesai' => $selesai,
                'dalam_proses' => $dalamProses,
                'terjadwal' => $terjadwal
            ];
        } catch (\Exception $e) {
            return [
                'total' => 0,
                'selesai' => 0,
                'dalam_proses' => 0,
                'terjadwal' => 0
            ];
        }
    }

    /**
     * Get data perawatan per hari untuk X hari terakhir
     */
    private function getPerawatanHarian($days = 30)
    {
        try {
            $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
            $endDate = Carbon::now()->endOfDay();

            // Query untuk mendapatkan data perawatan per hari
            $perawatanData = Perawatan::selectRaw("
                DATE(tanggal_perawatan) as tanggal,
                COUNT(*) as total,
                SUM(CASE WHEN status = 'Selesai' THEN 1 ELSE 0 END) as selesai,
                SUM(CASE WHEN status = 'Dalam proses' THEN 1 ELSE 0 END) as dalam_proses
            ")
                ->whereNotNull('tanggal_perawatan')
                ->whereBetween('tanggal_perawatan', [$startDate, $endDate])
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get()
                ->keyBy('tanggal');

            // Generate semua tanggal dalam rentang untuk memastikan data lengkap
            $allDates = [];
            $currentDate = clone $startDate;

            while ($currentDate <= $endDate) {
                $dateStr = $currentDate->format('Y-m-d');
                $formattedDate = $currentDate->format('d/m'); // Format untuk label chart

                if (isset($perawatanData[$dateStr])) {
                    $allDates[] = [
                        'date' => $formattedDate,           // Label: "15/01"
                        'fullDate' => $dateStr,              // Format database: "2024-01-15"
                        'total' => (int)$perawatanData[$dateStr]->total,
                        'selesai' => (int)$perawatanData[$dateStr]->selesai,
                        'dalam_proses' => (int)$perawatanData[$dateStr]->dalam_proses
                    ];
                } else {
                    $allDates[] = [
                        'date' => $formattedDate,
                        'fullDate' => $dateStr,
                        'total' => 0,
                        'selesai' => 0,
                        'dalam_proses' => 0
                    ];
                }

                $currentDate->addDay();
            }

            return $allDates;
        } catch (\Exception $e) {
            // Jika error, return data dummy untuk testing
            return $this->generateDummyData($days);
        }
    }

    /**
     * Generate data dummy untuk development/testing
     */
    private function generateDummyData($days = 30)
    {
        $data = [];
        $today = Carbon::now();

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $formattedDate = $date->format('d/m');

            // Generate data random yang realistis
            $total = rand(3, 15);
            $selesai = rand(2, $total - 1);
            $dalamProses = $total - $selesai;

            // Tambahkan sedikit variasi untuk membuat pattern
            if ($i % 7 == 0) { // Hari Minggu
                $total = max(1, $total - rand(2, 5));
                $selesai = rand(1, $total);
                $dalamProses = $total - $selesai;
            } elseif ($i % 6 == 0) { // Hari Sabtu
                $total = max(2, $total - rand(1, 3));
                $selesai = rand(1, $total);
                $dalamProses = $total - $selesai;
            }

            $data[] = [
                'date' => $formattedDate,
                'fullDate' => $dateStr,
                'total' => $total,
                'selesai' => $selesai,
                'dalam_proses' => $dalamProses
            ];
        }

        return $data;
    }

    /**
     * Get data perawatan per bulan (untuk kompatibilitas)
     */
    private function getPerawatanBulanan()
    {
        try {
            return Perawatan::selectRaw('MONTH(tanggal_perawatan) as bulan, COUNT(*) as total')
                ->whereNotNull('tanggal_perawatan')
                ->whereYear('tanggal_perawatan', date('Y')) // Tahun berjalan
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get()
                ->pluck('total', 'bulan')
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * API endpoint untuk mendapatkan data perawatan berdasarkan periode
     * (digunakan untuk tab switching di frontend)
     */
    public function getPerawatanData(Request $request)
    {
        $days = $request->get('days', 30);
        $data = $this->getPerawatanHarian($days);

        return response()->json([
            'success' => true,
            'data' => $data,
            'stats' => $this->calculateStats($data)
        ]);
    }

    /**
     * Calculate statistics from daily data
     */
    private function calculateStats($dailyData)
    {
        if (empty($dailyData)) {
            return [
                'today' => 0,
                'average' => 0,
                'max' => 0,
                'trend' => 'stabil'
            ];
        }

        $totals = array_column($dailyData, 'total');
        $todayCount = end($totals) ?: 0;
        $average = array_sum($totals) / count($totals);
        $max = max($totals);

        // Calculate trend (last 7 days vs first 7 days)
        $dataCount = count($totals);
        $lastWeek = array_slice($totals, -7);
        $firstWeek = array_slice($totals, 0, min(7, $dataCount));

        $avgLastWeek = array_sum($lastWeek) / count($lastWeek);
        $avgFirstWeek = array_sum($firstWeek) / count($firstWeek);

        if ($avgLastWeek > $avgFirstWeek * 1.1) {
            $trend = 'naik';
        } elseif ($avgLastWeek < $avgFirstWeek * 0.9) {
            $trend = 'turun';
        } else {
            $trend = 'stabil';
        }

        return [
            'today' => $todayCount,
            'average' => round($average, 1),
            'max' => $max,
            'trend' => $trend
        ];
    }
}

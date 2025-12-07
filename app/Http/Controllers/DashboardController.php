<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Perawatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $statPerawatan = Perawatan::getStatistik();

        // Grafik perawatan per bulan (pastikan ada data tanggal_perawatan)
        // Hasil array keyed by bulan (1..12) — kalau kosong akan jadi []
        $perawatanBulananQuery = Perawatan::selectRaw('MONTH(tanggal_perawatan) as bulan, COUNT(*) as total')
            ->whereNotNull('tanggal_perawatan')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->pluck('total', 'bulan')
            ->toArray();

        // Pastikan labels berurut (bulan 1..12) tapi gunakan hanya bulan yg ada
        // Kita kirim array as-is, blade akan json_encode
        $perawatanBulanan = $perawatanBulananQuery;

        return view('dashboard.home', compact(
            'totalBarang',
            'barangBaik',
            'barangRusak',
            'barangDipinjam',
            'statPerawatan',
            'perawatanBulanan'
        ));
    }
}

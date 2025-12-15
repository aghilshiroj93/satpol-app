<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BarangController extends Controller
{
    /**
     * Daftar barang dengan pencarian sederhana dan pagination
     */
    public function index(Request $request)
    {
        $q = $request->get('q');

        $query = MasterBarang::orderBy('nama_barang');

        if ($q) {
            $query = $query->search($q);
        }

        // pakai pagination supaya aman untuk dataset besar
        $barang = $query->paginate(15)->withQueryString();

        return view('barang.index', compact('barang', 'q'));
    }

    /**
     * Tampilkan form tambah
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Simpan barang baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // kode / pengelompokan
            'kd_aset1' => 'nullable|string|max:10',
            'kd_aset2' => 'nullable|string|max:10',
            'kd_aset3' => 'nullable|string|max:10',
            'kd_aset4' => 'nullable|string|max:10',
            'kd_aset5' => 'nullable|string|max:10',
            'kode_barang' => 'nullable|string|max:100',
            'nibar' => 'nullable|string|max:50',
            'reg' => 'nullable|string|max:50',

            // identitas & spesifikasi
            'nama_barang' => 'required|string|max:150',
            'spesifikasi_nama' => 'nullable|string|max:150',
            'spesifikasi_lain' => 'nullable|string',

            // merk / tipe / kendaraan
            'merk' => 'nullable|string|max:100',
            'tipe' => 'nullable|string|max:100',
            'nopol' => 'nullable|string|max:50',
            'nomor_rangka' => 'nullable|string|max:100',
            'nomor_bpkb' => 'nullable|string|max:100',

            // lokasi & pemegang
            'lokasi' => 'nullable|string|max:200',
            'pemegang' => 'nullable|string|max:100',

            // kuantitas & satuan
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string|max:30',

            // perolehan & harga
            'tanggal_perolehan' => 'nullable|date|before_or_equal:today',
            'cara_perolehan' => 'nullable|string|max:100',
            'harga_satuan' => 'nullable|numeric|min:0',
            'nilai_perolehan' => 'nullable|numeric|min:0',

            // kondisi / status
            'kondisi' => 'nullable|string|max:50',
            'keberadaan' => 'nullable|string|max:50',
            'status_penguasaan' => 'nullable|string|max:50',
            'status_penggunaan' => 'nullable|string|max:100',

            // tambahan
            'keterangan' => 'nullable|string'
        ]);

        // hitung nilai_perolehan bila kosong: jumlah * harga_satuan
        if (empty($validated['nilai_perolehan'])) {
            $harga = isset($validated['harga_satuan']) ? (float)$validated['harga_satuan'] : null;
            $jumlah = isset($validated['jumlah']) ? (int)$validated['jumlah'] : null;

            if ($harga !== null && $jumlah !== null) {
                $validated['nilai_perolehan'] = (int) round($harga * $jumlah);
            }
        }

        // konversi tanggal ke format Carbon (opsional - model sudah cast)
        if (!empty($validated['tanggal_perolehan'])) {
            $validated['tanggal_perolehan'] = Carbon::parse($validated['tanggal_perolehan'])->toDateString();
        }

        MasterBarang::create($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        $barang = MasterBarang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update data barang
     */
    public function update(Request $request, $id)
    {
        $barang = MasterBarang::findOrFail($id);

        $validated = $request->validate([
            // sama seperti store
            'kd_aset1' => 'nullable|string|max:10',
            'kd_aset2' => 'nullable|string|max:10',
            'kd_aset3' => 'nullable|string|max:10',
            'kd_aset4' => 'nullable|string|max:10',
            'kd_aset5' => 'nullable|string|max:10',
            'kode_barang' => 'nullable|string|max:100',
            'nibar' => 'nullable|string|max:50',
            'reg' => 'nullable|string|max:50',

            'nama_barang' => 'required|string|max:150',
            'spesifikasi_nama' => 'nullable|string|max:150',
            'spesifikasi_lain' => 'nullable|string',

            'merk' => 'nullable|string|max:100',
            'tipe' => 'nullable|string|max:100',
            'nopol' => 'nullable|string|max:50',
            'nomor_rangka' => 'nullable|string|max:100',
            'nomor_bpkb' => 'nullable|string|max:100',

            'lokasi' => 'nullable|string|max:200',
            'pemegang' => 'nullable|string|max:100',

            'jumlah' => 'required|integer|min:1',
            'satuan' => 'nullable|string|max:30',

            'tanggal_perolehan' => 'nullable|date|before_or_equal:today',
            'cara_perolehan' => 'nullable|string|max:100',
            'harga_satuan' => 'nullable|numeric|min:0',
            'nilai_perolehan' => 'nullable|numeric|min:0',

            'kondisi' => 'nullable|string|max:50',
            'keberadaan' => 'nullable|string|max:50',
            'status_penguasaan' => 'nullable|string|max:50',
            'status_penggunaan' => 'nullable|string|max:100',

            'keterangan' => 'nullable|string'
        ]);

        // Jika nilai_perolehan tidak diisi, hitung ulang
        if (empty($validated['nilai_perolehan'])) {
            $harga = $validated['harga_satuan'] ?? $barang->harga_satuan ?? null;
            $jumlah = $validated['jumlah'] ?? $barang->jumlah ?? null;

            if ($harga !== null && $jumlah !== null) {
                $validated['nilai_perolehan'] = (int) round($harga * $jumlah);
            }
        }

        if (!empty($validated['tanggal_perolehan'])) {
            $validated['tanggal_perolehan'] = Carbon::parse($validated['tanggal_perolehan'])->toDateString();
        }

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
    }

    /**
     * Hapus (soft delete)
     */
    public function destroy($id)
    {
        $barang = MasterBarang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    /**
     * Tampilkan detail barang
     */
    public function show($id)
    {
        $barang = MasterBarang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }
    public function cetak($id)
    {
        $barang = MasterBarang::findOrFail($id);

        // Format data untuk cetak
        $kodeAset = $barang->kode_barang ??
            $barang->kd_aset1 . '.' .
            $barang->kd_aset2 . '.' .
            $barang->kd_aset3 . '.' .
            $barang->kd_aset4 . '.' .
            $barang->kd_aset5;

        $merkTipe = trim(($barang->merk ?? '') . ' ' . ($barang->tipe ?? ''));
        $merkTipe = $merkTipe ?: '-';

        $tanggalPerolehan = $barang->tanggal_perolehan
            ? Carbon::parse($barang->tanggal_perolehan)->format('d/m/Y')
            : ($barang->tahun_perolehan
                ? Carbon::parse($barang->tahun_perolehan)->format('d/m/Y')
                : '-');

        $nilaiPerolehan = $barang->nilai_perolehan ??
            ($barang->harga_satuan ?? 0) * ($barang->jumlah ?? 1);

        return view('barang.cetak', compact(
            'barang',
            'kodeAset',
            'merkTipe',
            'tanggalPerolehan',
            'nilaiPerolehan'
        ));
    }

    /**
     * Print langsung berita acara (tanpa preview)
     */
    public function print($id)
    {
        $barang = MasterBarang::findOrFail($id);

        // Format data untuk cetak
        $kodeAset = $barang->kode_barang ??
            $barang->kd_aset1 . '.' .
            $barang->kd_aset2 . '.' .
            $barang->kd_aset3 . '.' .
            $barang->kd_aset4 . '.' .
            $barang->kd_aset5;

        $merkTipe = trim(($barang->merk ?? '') . ' ' . ($barang->tipe ?? ''));
        $merkTipe = $merkTipe ?: '-';

        $tanggalPerolehan = $barang->tanggal_perolehan
            ? Carbon::parse($barang->tanggal_perolehan)->format('d/m/Y')
            : ($barang->tahun_perolehan
                ? Carbon::parse($barang->tahun_perolehan)->format('d/m/Y')
                : '-');

        $nilaiPerolehan = $barang->nilai_perolehan ??
            ($barang->harga_satuan ?? 0) * ($barang->jumlah ?? 1);

        return view('barang.cetak', compact(
            'barang',
            'kodeAset',
            'merkTipe',
            'tanggalPerolehan',
            'nilaiPerolehan'
        ))->with('autoPrint', true);
    }
}

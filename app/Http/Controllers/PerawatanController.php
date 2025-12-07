<?php

namespace App\Http\Controllers;

use App\Models\Perawatan;
use App\Models\MasterBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerawatanController extends Controller
{
    public function index(Request $request)
    {
        $perawatan = Perawatan::with('barang')
            ->filterStatus($request->status)
            ->filterBarang($request->barang_id)
            ->filterTanggal($request->dari, $request->sampai)
            ->filterJenis($request->jenis)
            ->latest()
            ->paginate(10);
        
        $barang = MasterBarang::getBarangUntukPerawatan();
        $statistik = Perawatan::getStatistik();
        
        return view('perawatan.index', compact('perawatan', 'barang', 'statistik'));
    }
    
    public function create()
    {
        $barang = MasterBarang::getBarangUntukPerawatan();
        return view('perawatan.create', compact('barang'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:master_barang,id',
            'jenis_perawatan' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'tanggal_perawatan' => 'required|date',
            'jadwal_perawatan_berikutnya' => 'nullable|date',
            'teknisi' => 'nullable|string|max:100',
            'vendor' => 'nullable|string|max:100',
            'biaya' => 'nullable|numeric|min:0',
            'status' => 'required|in:Selesai,Dalam proses,Terjadwal',
            'foto_sebelum' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_sesudah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catatan' => 'nullable|string',
        ]);
        
        // Handle file uploads
        if ($request->hasFile('foto_sebelum')) {
            $validated['foto_sebelum'] = $request->file('foto_sebelum')->store('perawatan', 'public');
        }
        
        if ($request->hasFile('foto_sesudah')) {
            $validated['foto_sesudah'] = $request->file('foto_sesudah')->store('perawatan', 'public');
        }
        
        Perawatan::create($validated);
        
        return redirect()->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil ditambahkan');
    }
    
    public function show(Perawatan $perawatan)
    {
        $perawatan->load('barang');
        return view('perawatan.show', compact('perawatan'));
    }
    
    public function edit(Perawatan $perawatan)
    {
        $barang = MasterBarang::getBarangUntukPerawatan();
        return view('perawatan.edit', compact('perawatan', 'barang'));
    }
    
    public function update(Request $request, Perawatan $perawatan)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:master_barang,id',
            'jenis_perawatan' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'tanggal_perawatan' => 'required|date',
            'jadwal_perawatan_berikutnya' => 'nullable|date',
            'teknisi' => 'nullable|string|max:100',
            'vendor' => 'nullable|string|max:100',
            'biaya' => 'nullable|numeric|min:0',
            'status' => 'required|in:Selesai,Dalam proses,Terjadwal',
            'foto_sebelum' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_sesudah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catatan' => 'nullable|string',
        ]);
        
        // Handle file uploads
        if ($request->hasFile('foto_sebelum')) {
            // Delete old file if exists
            if ($perawatan->foto_sebelum) {
                Storage::disk('public')->delete($perawatan->foto_sebelum);
            }
            $validated['foto_sebelum'] = $request->file('foto_sebelum')->store('perawatan', 'public');
        }
        
        if ($request->hasFile('foto_sesudah')) {
            // Delete old file if exists
            if ($perawatan->foto_sesudah) {
                Storage::disk('public')->delete($perawatan->foto_sesudah);
            }
            $validated['foto_sesudah'] = $request->file('foto_sesudah')->store('perawatan', 'public');
        }
        
        $perawatan->update($validated);
        
        return redirect()->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil diperbarui');
    }
    
    public function destroy(Perawatan $perawatan)
    {
        // Delete files if exist
        if ($perawatan->foto_sebelum) {
            Storage::disk('public')->delete($perawatan->foto_sebelum);
        }
        if ($perawatan->foto_sesudah) {
            Storage::disk('public')->delete($perawatan->foto_sesudah);
        }
        
        $perawatan->delete();
        
        return redirect()->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil dihapus');
    }
}
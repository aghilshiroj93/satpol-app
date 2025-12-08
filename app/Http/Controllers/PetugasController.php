<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PetugasController extends Controller
{
    /**
     * Optionally tambahkan middleware di konstruktor (mis. auth).
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|\Illuminate\Http\JsonResponse
    {
        // Pagination sederhana, 15 per halaman.
        $petugas = Petugas::orderBy('created_at', 'desc')->paginate(15);

        if ($request->expectsJson()) {
            return response()->json($petugas);
        }

        // Ubah 'petugas.index' sesuai view kamu (resources/views/petugas/index.blade.php)
        return view('petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View|\Illuminate\Http\JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Use form view to create petugas.']);
        }

        return view('petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username'     => ['required', 'string', 'max:100', 'unique:petugas,username'],
            'password'     => ['required', 'string', 'min:6', 'confirmed'], // expects password_confirmation if HTML form
        ]);

        $data['password'] = Hash::make($data['password']);

        $petugas = Petugas::create($data); // HasUuids di model akan generate UUID

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $petugas,
            ], 201);
        }

        // Ganti route name jika kamu pakai prefix (mis. admin.petugas.index)
        return redirect()->route('petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Petugas $petugas): View|\Illuminate\Http\JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json($petugas);
        }

        return view('petugas.show', compact('petugas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Petugas $petugas): View|\Illuminate\Http\JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json($petugas);
        }

        return view('petugas.edit', compact('petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Petugas $petugas): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username'     => [
                'required',
                'string',
                'max:100',
                Rule::unique('petugas', 'username')->ignore($petugas->id),
            ],
            // password optional on update. If provided, must be confirmed.
            'password'     => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // jangan timpa password bila kosong
            unset($data['password']);
        }

        $petugas->update($data);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $petugas->fresh(),
            ]);
        }

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Petugas $petugas): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $petugas->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas berhasil dihapus.');
    }
}

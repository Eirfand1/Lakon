<?php

namespace App\Http\Controllers;

use App\Models\Ppkom;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\Database\QueryException;

class PpkomController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.ppkom.ppkom', [
            "title" => "ppkom",
        ]);

    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => 'required|unique:ppkom|max:255',
            'nama' => 'required|max:255',
            'pangkat' => 'nullable|max:255',
            'jabatan' => 'nullable|max:255',
            'alamat' => 'nullable',
            'no_telp' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        Ppkom::create($validated);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, Ppkom $ppkom): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => 'required|unique:ppkom,nip,' . $ppkom->ppkom_id . ',ppkom_id|max:255',
            'nama' => 'required|max:255',
            'pangkat' => 'nullable|max:255',
            'jabatan' => 'nullable|max:255',
            'alamat' => 'nullable',
            'no_telp' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $ppkom->update($validated);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Ppkom $ppkom): RedirectResponse
    {
        $ppkom->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');

    }
}

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
        try {
            $ppkom = Ppkom::all();
            return view('pages.admin.ppkom', [
                "title" => "ppkom",
                'ppkom' => $ppkom,
            ]);
        } catch (\Exception $e) {
            return view('pages.admin.ppkom', [
                "title" => "ppkom",
                'ppkom' => [],
            ])->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
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
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan yang tidak terduga.');
        }
    }

    public function update(Request $request, Ppkom $ppkom): RedirectResponse
    {
        try {
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
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan yang tidak terduga.');
        }
    }

    public function destroy(Ppkom $ppkom): RedirectResponse
    {
        try {
            $ppkom->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan yang tidak terduga.');
        }
    }
}

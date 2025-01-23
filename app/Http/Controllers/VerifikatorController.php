<?php

namespace App\Http\Controllers;

use App\Models\Verifikator;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;

class VerifikatorController extends Controller
{
    public function index(): View
    {
        try {
            $verifikator = Verifikator::all();
            return view('pages.admin.verifikator', [
                "title" => "verifikator",
                "verifikator" => $verifikator,
            ]);
        } catch (\Exception $e) {
            return view('pages.admin.verifikator', [
                "title" => "verifikator",
                "verifikator" => [],
            ])->with('error', 'Terjadi kesalahan saat mengambil data');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'nip' => 'required|unique:verifikator,nip|numeric',
                'nama_verifikator' => 'required'
            ]);

            Verifikator::create($validate);
            return redirect()->back()->with('success', 'data berhasil nambah');
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with("error", "terjadi kesalahan saat menyimpnan data");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with("error", "terjadi kesalahan tak terduga");
        }
    }

    public function update(Request $request, Verifikator $verifikator): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'nip' => 'required|numeric|unique:verifikator,nip,' . $verifikator->verifikator_id . ',verifikator_id',
                'nama_verifikator' => 'required'
            ]);

            $verifikator->update($validate);
            return redirect()->back()->with('success', 'Data berhasil di perbarui!');
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan tak terduga');
        }
    }
    public function destroy(Verifikator $verifikator): RedirectResponse
    {
        try {
            $verifikator->delete();
            return redirect()->back()->with('success', 'Data berhasil di hapus');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan tak terduga saat menghapus data');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\User;
use App\Models\Verifikator;
use Hash;
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
            return view('pages.admin.verifikator.verifikator', [
                "title" => "verifikator",
                "verifikator" => $verifikator,
            ]);
        } catch (\Exception $e) {
            return view('pages.admin.verifikator.verifikator', [
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

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $request->name,
                'role' => 'verifikator',
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Verifikator::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama_verifikator' => $request->nama_verifikator,
            ]);

            return redirect()->back()->with('success', 'data berhasil nambah');

        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with("error", $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, Verifikator $verifikator): RedirectResponse
    {
        try {
            $validate = $request->validate([
                'edit_nip' => 'required|numeric|unique:verifikator,nip,' . $verifikator->verifikator_id . ',verifikator_id',
                'edit_nama_verifikator' => 'required'
            ]);

            $user = User::where('id', $verifikator->user_id)->update([
                'name' => $request->edit_name,
                'email' => $request->edit_email,
            ]);

            if ($request->password) {
                User::where('id', $verifikator->user_id)->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            Verifikator::where('verifikator_id', $verifikator->verifikator_id)->update([
                'nip' => $request->nip,
                'nama_verifikator' => $request->nama_verifikator,
            ]);

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
            $user = $verifikator->user;
            $verifikator->delete();

            if ($user) {
                $user->delete();
            }

            return redirect()->back()->with('success', 'Data berhasil di hapus');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan tak terduga saat menghapus data');
        }
    }


    public function kontrakSaya()
    {

        $verifikator = auth()->user();

        if ($verifikator->role != 'verifikator') {
            abort(403, 'Anda bukan verifikator');
        }

        $kontrak = Kontrak::where('verifikator_id', $verifikator->id)->get();

        return view('pages.verifikator.riwayat.riwayat', compact('kontrak'));
    }

    public function dashboard()
    {
        return view('pages.verifikator.dashboard.dashboard');
    }

    public function detailPermohonan()
    {
        return view('pages.verifikator.permohonan.detail-permohonan');
    }
}

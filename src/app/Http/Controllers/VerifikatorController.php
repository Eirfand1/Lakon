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
    }

    public function update(Request $request, Verifikator $verifikator): RedirectResponse
    {
        $validate = $request->validate([
            'edit_nip' => 'required|numeric|unique:verifikator,nip,' . $verifikator->verifikator_id . ',verifikator_id',
            'edit_nama_verifikator' => 'required',
            'edit_password' => 'required|string|min:8'
        ]);

        $user = User::where('id', $verifikator->user_id)->update([
            'name' => $request->edit_name,
            'email' => $request->edit_email,
            'password' => $request->edit_password
        ]);

        if ($request->password) {
            User::where('id', $verifikator->user_id)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        Verifikator::where('verifikator_id', $verifikator->verifikator_id)->update([
            'nip' => $request->edit_nip,
            'nama_verifikator' => $request->edit_nama_verifikator,
        ]);
        return redirect()->back()->with('success', 'Data berhasil di perbarui!');
    }
    public function destroy(Verifikator $verifikator): RedirectResponse
    {
        $user = $verifikator->user;
        $verifikator->delete();

        if ($user) {
            $user->delete();
        }

        return redirect()->back()->with('success', 'Data berhasil di hapus');

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

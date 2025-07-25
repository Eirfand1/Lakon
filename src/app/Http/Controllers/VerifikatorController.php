<?php

namespace App\Http\Controllers;

use App\Models\BiayaPersonel;
use App\Models\DaftarKeluaranDanHarga;
use App\Models\DaftarPekerjaanSubKontrak;
use App\Models\Kontrak;
use App\Models\User;
use App\Models\Verifikator;
use App\Models\Penerima;
use App\Models\DokumenKontrak;
use App\Models\KeteranganKontrak;
use App\Models\Tim;
use App\Models\JadwalKegiatan;
use App\Models\RincianBelanja;
use App\Models\Peralatan;
use App\Models\RuangLingkup;
use App\Models\DetailKontrak;
use App\Models\EPurchasing;
use App\Models\PaketPekerjaan;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class VerifikatorController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.verifikator.verifikator', [
            "title" => "verifikator",
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'nip' => 'required|unique:verifikator,nip|string',
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
            'edit_nip' => 'required|string|unique:verifikator,nip,' . $verifikator->verifikator_id . ',verifikator_id',
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

    public function dataDasar($kontrak_id, Kontrak $kontrak, Request $request)
    {
        $validatedData = $request->validate([
            // tender
            'nomor_sppbj' => 'nullable|string|max:255',
            'tgl_sppbj' => 'nullable|date',
            'nomor_penetapan_pemenang' => 'nullable|string|max:255',
            'tgl_penetapan_pemenang' => 'nullable|date',

            // non tender
            'nomor_dppl' => 'nullable|string|max:255',
            'tgl_dppl' => 'nullable|date',
            'nomor_bahpl' => 'nullable|string|max:255',
            'tgl_bahpl' => 'nullable|date',
        ]);

        $kontrak->where('kontrak_id', $kontrak_id)->update([
            'nomor_sppbj' => $request->nomor_sppbj,
            'tgl_sppbj' => $request->tgl_sppbj,
            'nomor_penetapan_pemenang' => $request->nomor_penetapan_pemenang,
            'tgl_penetapan_pemenang' => $request->tgl_penetapan_pemenang,

            'nomor_dppl' => $request->nomor_dppl,
            'tgl_dppl' => $request->tgl_dppl,
            'nomor_bahpl' => $request->nomor_bahpl,
            'tgl_bahpl' => $request->tgl_bahpl,
            'data_dasar_done' => true
        ]);
        return redirect()->back()->with('success', 'Data dasar berhasil di simpan');
    }


    public function spk($kontrak_id, Kontrak $kontrak, Request $request)
    {
        $validate = $request->validate([
            'jenis_kontrak' => 'required|string|max:255',
            'nomor_spk' => 'required|string|max:255',
            'nilai_kontrak' => 'required|numeric',
            'terbilang_nilai_kontrak' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'waktu_penyelesaian' => 'required|string|max:255',
            'cara_pembayaran' => 'required|string|max:255',
            'uang_muka' => 'required|string|max:255',
        ]);

        $kontrak->where('kontrak_id', $kontrak_id)->update([
            'jenis_kontrak' => $request->jenis_kontrak,
            'nomor_spk' => $request->nomor_spk,
            'nilai_kontrak' => $request->nilai_kontrak,
            'terbilang_nilai_kontrak' => $request->terbilang_nilai_kontrak,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'waktu_penyelesaian' => $request->waktu_penyelesaian,
            'cara_pembayaran' => $request->cara_pembayaran,
            'uang_muka' => $request->uang_muka,
            'spk_done' => true
        ]);


        DetailKontrak::where('kontrak_id', $kontrak_id)->delete();

        if ($request->detail) {
            foreach ($request->detail as $key => $detail) {
                DetailKontrak::create([
                    'kontrak_id' => $kontrak_id,
                    'detail' => $detail,
                    'nilai' => $request->nilai_raw[$key]
                ]);
            }
        } else {
            $kontrak = Kontrak::where('kontrak_id', $kontrak_id)->with(['paketPekerjaan', 'paketPekerjaan.sekolah'])->first();
            DetailKontrak::create([
                'kontrak_id' => $kontrak_id,
                'detail' => $kontrak->paketPekerjaan->nama_pekerjaan . " " . ($kontrak->paketPekerjaan->sekolah->nama_sekolah ?? ""),
                'nilai' => $request->nilai_kontrak
            ]);
        }

        return redirect()->back()->with('success', 'SPK berhasil di simpan');
    }


    public function lampiran($kontrak_id, Kontrak $kontrak)
    {
        $kontrak->where('kontrak_id', $kontrak_id)->update([
            'lampiran_done' => true
        ]);
        return redirect()->back()->with('success', 'Lampiran berhasil di simpan');
    }

    public function spp($kontrak_id, Kontrak $kontrak)
    {
        $kontrak->where('kontrak_id', $kontrak_id)->update([
            'spp_done' => true
        ]);
        return redirect()->back()->with('success', 'SPP berhasil di simpan');
    }

    public function sskk($kontrak_id, Kontrak $kontrak)
    {
        $kontrak->where('kontrak_id', $kontrak_id)->update([
            'sskk_done' => true
        ]);
        return redirect()->back()->with('success', 'SSKK berhasil di simpan');
    }

    public function sp($kontrak_id, Kontrak $kontrak, Request $request)
    {
        if (empty($request->nomor_sp) && empty($request->tgl_sp)) {
            $kontrak->where('kontrak_id', $kontrak_id)->update([
                'sp_done' => true
            ]);
            return redirect()->back()->with('success', 'SP berhasil di simpan');
        }
        $validate = $request->validate([
            'nomor_sp' => 'required|string|max:255',
            'tgl_sp' => 'required|date',
            'id_paket' => 'required|array',
        ]);
        $kontrak->where('kontrak_id', $kontrak_id)->update([
            'nomor_sp' => $request->nomor_sp,
            'tgl_sp' => $request->tgl_sp,
            'sp_done' => true
        ]);

        EPurchasing::where('kontrak_id', $kontrak_id)->delete();

        if ($request->id_paket[0] == null) {
            return redirect()->back()->with('success', 'SP berhasil di simpan');
        }
        foreach ($request->id_paket as $key => $id_paket) {
            EPurchasing::create([
                'kontrak_id' => $kontrak_id,
                'id_paket' => $id_paket,
            ]);
        }
        return redirect()->back()->with('success', 'SP berhasil di simpan');
    }

    public function tolak($kontrak_id, Kontrak $kontrak)
    {
        $kontrak->where('kontrak_id', $kontrak_id)->delete();
        return redirect()->back()->with('success', 'Permohonan berhasil ditolak');
    }

    public function terima($kontrak_id, Kontrak $kontrak)
    {
        $kontrak->where('kontrak_id', $kontrak_id)->update([
            'tgl_kontrak' => now()->toDateString(),
            'is_verificated' => true,
            'verifikator_id' => Auth::user()->verifikator->verifikator_id,
        ]);
        return redirect('/verifikator/dashboard')->with('success', 'Permohonan berhasil diterima');
    }

    public function detail($kontrak_id, Kontrak $kontrak)
    {
        $kontrak = Kontrak::where('kontrak_id', $kontrak_id)->first();
        $rincianBelanja = RincianBelanja::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get();
        $biayaPersonel =  BiayaPersonel::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get();
        $totalBiayaPersonel = $biayaPersonel->sum('jumlah');
        $nilai_hps = PaketPekerjaan::with('kontrak')->where('paket_id', $kontrak->paket_id)->first()->nilai_hps;
        $nomor_kontrak = PaketPekerjaan::with('kontrak')->where('paket_id', $kontrak->paket_id)->first()->nomor_kontrak;
        $noSpmk = preg_replace('/\/(\d+)\//', '/$1.a/', $nomor_kontrak);
        $totalBiaya = $rincianBelanja->sum('total_harga');

        return view('pages.verifikator.permohonan.detail-permohonan', [
            'kontrak' => $kontrak,
            'nilai_hps' => $nilai_hps,
            'noSpmk' => $noSpmk,
            'penerima' => Penerima::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'dokumen_penagihan' => DokumenKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->where('jenis', 'penagihan')->get(),
            'dokumen_pekerjaan' => DokumenKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->where('jenis', 'pekerjaan')->get(),
            'dokumen_tambahan' => DokumenKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->where('jenis', 'tambahan')->get(),
            'keterangan_hak_dan_kewajiban' => KeteranganKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->where('jenis', 'hak dan kewajiban')->get(),
            'keterangan_tindakan' => KeteranganKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->where('jenis', 'tindakan')->get(),
            'keterangan_fasilitas' => KeteranganKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->where('jenis', 'fasilitas')->get(),
            'tim' => Tim::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'jadwalKegiatan' => JadwalKegiatan::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'rincianBelanja' => $rincianBelanja,
            'totalBiaya' => $totalBiaya,
            'peralatan' => Peralatan::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'ruangLingkup' => RuangLingkup::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'detail' => DetailKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'id_paket' => EPurchasing::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'daftarPekerjaanSubKontrak' => DaftarPekerjaanSubKontrak::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'daftarKeluaranDanHarga' => DaftarKeluaranDanHarga::with('kontrak')->where('kontrak_id', $kontrak->kontrak_id)->get(),
            'biayaPersonel' => $biayaPersonel,
            'totalBiayaPersonel' => $totalBiayaPersonel
        ]);
    }
}

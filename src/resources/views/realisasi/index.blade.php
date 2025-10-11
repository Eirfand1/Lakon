@extends('layouts.app')

@section('content')
<div class="p-4 max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Realisasi — Upload PDF (Konstruksi / Pengadaan)</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded shadow p-4 mb-6">
        <form action="{{ route('realisasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium">Jenis <span class="text-red-500">*</span></label>
                    <select name="jenis" class="mt-1 block w-full border rounded p-2" required>
                        <option value="">Pilih jenis</option>
                        <option value="konstruksi" {{ old('jenis')=='konstruksi' ? 'selected':'' }}>Pekerjaan Konstruksi</option>
                        <option value="pengadaan" {{ old('jenis')=='pengadaan' ? 'selected':'' }}>Pengadaan Barang</option>
                    </select>
                    @error('jenis') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Kategori Dokumen <span class="text-red-500">*</span></label>
                    <select name="kategori" class="mt-1 block w-full border rounded p-2" required>
                        <option value="">Pilih kategori</option>
                        <option value="Laporan Harian">Laporan Harian / Mingguan</option>
                        <option value="Surat Keterangan Prestasi Pekerjaan">Surat Keterangan Prestasi</option>
                        <option value="Berita Acara">Berita Acara / Mutual-Check</option>
                        <option value="Hasil Uji Laboratorium">Hasil Uji Laboratorium</option>
                        <option value="Dokumentasi Pelaksanaan">Dokumentasi Pelaksanaan Pekerjaan</option>
                        <option value="RMPK">Rencana Mutu Pekerjaan Konstruksi (RMPK)</option>
                        <option value="As Built Drawing">As Built Drawing</option>
                        <option value="Dokumen Kontrak">Dokumen Kontrak</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('kategori') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="mt-1 block w-full border rounded p-2">
                    @error('tanggal') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Persentase Realisasi (%)</label>
                    <input type="number" name="persentase" min="0" max="100" value="{{ old('persentase') }}" class="mt-1 block w-full border rounded p-2" placeholder="0-100">
                    @error('persentase') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="mt-1 block w-full border rounded p-2" placeholder="Catatan / ringkasan singkat">
                    @error('keterangan') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">File PDF <span class="text-red-500">*</span></label>
                    <input type="file" name="file" accept="application/pdf" id="fileInput" class="mt-1 block w-full" required>
                    <div id="filePreview" class="text-sm text-gray-600 mt-2"></div>
                    @error('file') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="font-semibold">Daftar Dokumen (sesuai Formulir I)</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-2 text-sm">
                    <label><input type="checkbox" disabled> Laporan Harian / Mingguan</label>
                    <label><input type="checkbox" disabled> Surat Keterangan Prestasi Pekerjaan</label>
                    <label><input type="checkbox" disabled> Surat Permohonan Pemeriksaan Prestasi</label>
                    <label><input type="checkbox" disabled> Hasil Uji Laboratorium (Jika Ada)</label>
                    <label><input type="checkbox" disabled> Berita Acara Penilaian Hasil Pekerjaan</label>
                    <label><input type="checkbox" disabled> Lampiran Berita Acara</label>
                    <label><input type="checkbox" disabled> Daftar Kemajuan Fisik</label>
                    <label><input type="checkbox" disabled> Dokumentasi Pelaksanaan Pekerjaan</label>
                    <label><input type="checkbox" disabled> As Built Drawing</label>
                    <label><input type="checkbox" disabled> Dokumen Perubahan Kontrak (Addendum)</label>
                    <label><input type="checkbox" disabled> Rencana Mutu Pekerjaan Konstruksi (RMPK)</label>
                    <label><input type="checkbox" disabled> Rencana Keselamatan Konstruksi (RKK)</label>
                </div>
                <div class="text-xs text-gray-600 mt-2">Checklist di atas hanya referensi — unggah file PDF sesuai kategori yang dipilih.</div>
            </div>

            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Upload PDF</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded shadow p-4">
        <h2 class="font-semibold mb-3">Daftar File Re alisasi</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="text-left text-sm text-gray-600">
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">Jenis</th>
                        <th class="px-3 py-2">Kategori</th>
                        <th class="px-3 py-2">Persentase</th>
                        <th class="px-3 py-2">Tanggal</th>
                        <th class="px-3 py-2">File</th>
                        <th class="px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($files as $file)
                        <tr class="text-sm">
                            <td class="px-3 py-2 align-top">{{ $loop->iteration + ($files->currentPage()-1)*$files->perPage() }}</td>
                            <td class="px-3 py-2 align-top">{{ ucfirst($file->jenis) }}</td>
                            <td class="px-3 py-2 align-top">{{ $file->kategori }}</td>
                            <td class="px-3 py-2 align-top">{{ $file->persentase ?? '-' }}%</td>
                            <td class="px-3 py-2 align-top">{{ $file->tanggal ? $file->tanggal->format('Y-m-d') : '-' }}</td>
                            <td class="px-3 py-2 align-top">
                                <a href="#" class="text-blue-600 underline view-file" data-url="{{ $file->url }}" data-name="{{ $file->file_name }}" data-id="{{ $file->id }}">{{ $file->file_name }}</a>
                            </td>
                            <td class="px-3 py-2 align-top">
                                <a href="{{ route('realisasi.download', $file) }}" class="text-sm px-2 py-1 border rounded">Download</a>

                                <form action="{{ route('realisasi.destroy', $file) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus file ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm px-2 py-1 border rounded ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="px-3 py-4" colspan="7">Belum ada file realisasi yang diunggah.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $files->links() }}
        </div>
    </div>
</div>

<div id="pdfModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70">
    <div class="bg-white w-[90%] h-[90%] rounded overflow-hidden">
        <div class="flex justify-between p-2 border-b">
            <div id="modalTitle" class="font-semibold"></div>
            <button id="closeModal" class="px-3 py-1 bg-gray-200 rounded">Tutup ✕</button>
        </div>
        <iframe id="pdfFrame" src="" class="w-full h-full border-0"></iframe>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');
    fileInput?.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            filePreview.textContent = this.files[0].name + ' (' + Math.round(this.files[0].size/1024) + ' KB)';
        } else {
            filePreview.textContent = '';
        }
    });

    const modal = document.getElementById('pdfModal');
    const pdfFrame = document.getElementById('pdfFrame');
    const modalTitle = document.getElementById('modalTitle');
    const closeModal = document.getElementById('closeModal');

    function openModal(url, name) {
        pdfFrame.src = url;
        modalTitle.textContent = name;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    document.querySelectorAll('.view-file').forEach(el => {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            let url = this.dataset.url;
            const name = this.dataset.name || '';
            if (url && url.indexOf('http') !== 0 && url.indexOf('/') === 0) {
                url = url;
            }
            openModal(url, name);
        });
    });

    closeModal?.addEventListener('click', function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        pdfFrame.src = '';
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            pdfFrame.src = '';
        }
    });
});
</script>
@endsection

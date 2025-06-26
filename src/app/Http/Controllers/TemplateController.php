<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class TemplateController extends Controller
{
    public function index()
    {
        return view('pages.admin.template.template');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'file_path' => 'required|mimes:docx',
            ]);

            $file = $request->file('file_path');
            $fileName = $file->getClientOriginalName();

            // Simpan file ke storage/app/templates/kontrak
            $filePath = $file->storeAs('templates/kontrak', $fileName);

            $template = new Template();
            $template->name = $request->name;
            $template->file_path = $filePath;
            $template->save();

            return back()->with('success', 'Template berhasil diunggah!');
        } catch (Throwable $e) {
            return back()->with('error', 'Gagal mengunggah file. : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $template = Template::findOrFail($id);
        return response()->json($template);
    }

    public function update(Request $request, $id)
    {
        try {
            $template = Template::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'file_path' => 'nullable|mimes:docx|max:2048',
            ]);

            $template->name = $request->name;

            // Jika ada file baru yang diupload
            if ($request->hasFile('file_path')) {
                // Hapus file lama jika ada
                if (Storage::exists($template->file_path)) {
                    Storage::delete($template->file_path);
                }

                // Upload file baru
                $file = $request->file('file_path');
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('templates/kontrak', $fileName);

                $template->file_path = $filePath;
            }

            $template->save();

            return back()->with('success', 'Template berhasil diupdate!');
        } catch (Throwable $e) {
            return back()->with('error', 'Gagal mengupdate template: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        try {
            $template = Template::findOrFail($id);

            // Pastikan file ada di storage
            if (!Storage::exists($template->file_path)) {
                return back()->with('error', 'File template tidak ditemukan!');
            }

            // Get file name dari path
            $fileName = basename($template->file_path);

            // Download file
            return Storage::download($template->file_path, $fileName);
        } catch (Throwable $e) {
            return back()->with('error', 'Gagal mendownload template: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $template = Template::findOrFail($id);

            // Hapus file dari storage
            if (Storage::exists($template->file_path)) {
                Storage::delete($template->file_path);
            }

            // Hapus data dari database
            $template->delete();

            return back()->with('success', 'Template berhasil dihapus!');
        } catch (Throwable $e) {
            return back()->with('error', 'Gagal menghapus template: ' . $e->getMessage());
        }
    }
}

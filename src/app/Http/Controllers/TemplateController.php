<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class TemplateController extends Controller
{
    //

    public function index()
    {
        return view('pages.admin.template.template');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'file_path' => 'required|mimes:docx|max:2048', // Pastikan hanya file .docx dengan ukuran max 2MB
            ]);

            $file = $request->file('file_path');
            $fileName = $file->getClientOriginalName();

            // Simpan file ke storage/app/templates/kontrak
            $filePath = $file->storeAs('templates/kontrak', $fileName);

            // Simpan informasi ke database
            $template = new Template();
            $template->name = $fileName;
            $template->file_path = $filePath;
            $template->save();

            return back()->with('success', 'Template berhasil diunggah!');
        } catch (Throwable $e) {
            return back()->with('error', 'Gagal mengunggah file. : ' . $e->getMessage());
        }
    }




    public function destroy($id)
    {
        $template = Template::findOrFail($id);

        // Hapus file dari storage
        if (Storage::exists($template->file_path)) {
            Storage::delete($template->file_path);
        }

        // Hapus data dari database
        $template->delete();

        return back()->with('success', 'Template berhasil dihapus!');
    }

}

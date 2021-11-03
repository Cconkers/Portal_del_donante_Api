<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Comunicado;
use Illuminate\Http\Request;
use App\Mail\ComunicadosMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FilesController extends Controller
{
    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:pdf'
        ]);

        $fileModel = new Comunicado();

        if ($req->file()) {
            $fileName = time() . '_' . $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            $emails = User::select('email')->get();

            Mail::send(new ComunicadosMail($emails));

            return response()->json([
                'message' => 'El archivo ha sido subido correctamente',
                'file', $fileName
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;


class FilesController extends Controller
{
  public function fileUpload(Request $req){
        $req->validate([
        'file' => 'required|mimes:pdf'
        ]);

        $fileModel = new Comunicado();

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            return response()->json([
                'message' => 'El archivo ha sido subido correctamente',
                'file', $fileName
            ]);
        }
   }


  public function fileDownload(Request $req){
    
        return response()->file('..\storage\app\public\uploads\1635160731_RubenCvDevelop.pdf');
  }



}

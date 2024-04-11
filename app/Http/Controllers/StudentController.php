<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use App\Models\Books;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
   public function index()
   {
        $docs = Books::all();
        return view('pages.student.home', compact('docs'));
   }

   public function view($id)
    {
        $docs = Books::find($id);

        if (!$docs) {
            return response()->json(['error' => 'Document not found.'], 404);
        }

        $pdfContent = Storage::disk('public')->get($docs->file);

        return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="docus.pdf"');
    }
}

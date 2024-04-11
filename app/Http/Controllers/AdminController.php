<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index()
    {
        $data = Books::all();
        $totalLoggedInUsers = Auth::user()->count();
        return view('pages.admin.home', compact('data', 'totalLoggedInUsers'));
    }

    public function publish()
    {
        return view('pages.admin.publish');
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

    public function save(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $pdfContent = file_get_contents($file->getRealPath());
            if (!$this->isPdf($pdfContent)) {
                return redirect()->back()->with('error', 'Invalid PDF file. Please upload a valid PDF file.');
            }

            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploadedDocs', $fileName, 'public');

            $book = new Books();
            $book->title = $validatedData['title'];
            $book->author = $validatedData['author'];
            $book->category = $validatedData['category'];
            $book->file = $filePath;
            $book->save();

            return redirect()->back()->with('success', 'Document saved successfully!');
        }

        return redirect()->back()->with('error', 'Failed to save document. Please try again.');
    }

    private function isPdf($content)
    {
        return preg_match('/%PDF-1\.\d/', $content) === 1;
    }

    public function delete($id)
    {
        $docs = Books::findOrFail($id);

        $docs->delete();

        return redirect()->back()->with('success', 'Document deleted successfully.');
    }

}

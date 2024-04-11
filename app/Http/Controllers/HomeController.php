<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use App\Models\Books;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $data = Books::all();
        $allBooks = Books::select('id')->count(); //Total Documents
        $totalLoggedInUsers = Auth::user()->count(); //Total Signed In Users
        return view('pages.admin.home', compact('data', 'allBooks', 'totalLoggedInUsers'));
    }

    public function delete($id)
    {
        $docus = Books::find($id);

        $docus->delete();

        return redirect()->back()->with('success', 'Document deleted successfully.');
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

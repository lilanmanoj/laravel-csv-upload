<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploads = Upload::all()->sortByDesc('created_at');

        return view('uploads.index', compact('uploads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maxFileSize = config('csvimport.max_file_size');

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:' . $maxFileSize,
        ]);

        // Upload file to storage
        $path = $request->file('file')->store('uploads', 'local');

        // Create a new upload record
        $upload = Upload::create([
            'path' => $path,
            'disk' => 'local',
            'status' => Upload::STATUS_PENDING,
        ]);

        return redirect()->route('uploads')->with('success', 'File uploaded successfully and is being processed.');
    }

    /**
     * Display the specified resource.
     */
    public function show(uploaded_users $uploaded_users)
    {
        //
    }
}

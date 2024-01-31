<?php

namespace App\Http\Controllers;

use App\Models\Birdy;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'birdies_id' => ['required','exists:birdies,id'],
            'body' => ['required'],
        ]);

        Comments::create([
            'user_id' => auth()->id(),
            'birdies_id' => $request->birdies_id,
            'body' => $request->input('body'),
        ]);

        session()->flash('success', 'Berhasil berkomentar');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {   
        // $this->authorize('delete', $comments);

       if ($comments->user_id == auth()->id()) {
        $comments->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
       } else {
        return abort(403, 'Belum diatur');
       }
    }
}

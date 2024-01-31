<?php

namespace App\Http\Controllers;

use App\Models\Birdy;
use App\Models\Comments;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BirdyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function dashboard(): View
     {
         return view('dashboard', [
             'birds' => Birdy::with('user')->latest()->get(),
         ]);
     }
    
    public function index(): View
    {   
        //cara pemanggilan yg benar

        $data=Birdy::with('user','comments')->latest()->get();
        
        return view('birds.index', [
            'birds' => $data,
        ]);
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
        $this->validate($request, [
            'content' => ['required'],
        ]);

        Birdy::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        session()->flash('success', 'Berhasil birds');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bird = Birdy::with('user')->find($id);
        $comments = Comments::where('birdies_id', $bird->id)->with('user')->get();

        if (!$bird) {
            // Optionally, you can redirect or show an error message
            abort(404, 'Birdy not found');
        }

        // dd($comments);

        return view('birds.show', compact('bird', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('birds.edit', [
            'birds' => Birdy::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        //ganti menggunakan laravel request
        $this->validate($request, [
            'content' => ['required'],
        ]);

        $bird= Birdy::find($id);

        $bird->update([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        session()->flash('success', 'Berhasil memperbarui birds');

        return to_route('birdy.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bird= Birdy::find($id);

        $bird->delete();

        session()->flash('error', 'Berhasil menghapus birds');

        return back();
        // return to_route('dashboard');
    }
}

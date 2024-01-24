<?php

namespace App\Http\Controllers;

use App\Models\Birdy;
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
        return view('birds.index', [
            'birds' => Birdy::with('user')->latest()->get(),
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

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Birdy $birdy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('birds.edit', [
            'bird' => Birdy::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => ['required'],
        ]);

        $bird= Birdy::find($id);

        $bird->update([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        session()->flash('success', 'Berhasil memperbarui birds');

        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bird= Birdy::find($id);

        $bird->delete();

        session()->flash('error', 'Berhasil menghapus birds');

        return to_route('dashboard');
    }
}

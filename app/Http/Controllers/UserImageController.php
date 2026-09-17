<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // user holen
        $users = User::get();
        return view('users.index', compact('users'));
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
       //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        //validieren
       $request->validate([
            'user'  => ['required'],
            'imageAlt' => ['required', 'string','max:150'],
            'image' => ['required','image','max:2048'], // max 2 mb
        ]);
        // bild speichern von temp in ordner, sonst weg
        // erst den weg in path speichern, und wird in den ordner storage, app,public 
        $path = $request->file('image')->store('images','public');
        // schreiben in die datenbank
        $sammeln=[
           'imageAlt' => $request->imageAlt,
           'imagePath' => $path,

        ];
        
        //aktualisierter  eintrag
        $user->update($sammeln);
    
       return view('users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

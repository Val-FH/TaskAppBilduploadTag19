<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\TestStatus\Success;

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
    public function create(User $user) // user wird via action übergeben
    { 
       // deswegen können wir hier mit compact den user mit rüberwerfen
        return view('users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //validieren
       $request->validate([
            'user'  => ['required','exists:users,id'],
            'imageAlt' => ['required', 'string','max:150'],
            'image' => ['required','image','max:2048'], // max 2 mb
        ]);
        // bild speichern von temp in ordner, sonst weg
        // erst den weg in path speichern, und wird in den ordner storage, app,public 
        $path = $request->file('image')->store('images','public');
        //User finden via die id die wir übergeben
        $user = User::find($request->user);
        // daten in datenbank schreiben
        $user->imageAlt = $request->imageAlt;
        $user->imagePath = $path;
       // speichern
       $user->save(); // laravel ändert das in update im hintergrund

     return view('users.show', compact('user'))->with('success', 'Foto erfolgreich angelegt');
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
        //weiterleitung an formular und übergabe der userdaten
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
        // altendatensatz holen
       // $oldFile = User::find($user->imagePath);
        // $old lösche die datei
       // Storage::disk('public')->allFiles(); alle anzeigen
        Storage::disk('public')->delete($user->filePath); 
        // datensatz löschen
        // schreiben in die datenbank
        $sammeln=[
           'imageAlt' => $request->imageAlt,
           'imagePath' => $path,
        ];
        
        //aktualisierter  eintrag
        $user->update($sammeln);
    
       return view('users.show', compact('user'))->with('success', 'Foto erfolgreich angelegt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //nur die bestimmten zeilen löschen und bild entfernen

      //  $user->delete();

      //  return redirect()->route('dashboard')->with('success', 'Aufgabe gelöscht');
    }
}

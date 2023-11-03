<?php

namespace App\Http\Controllers;
use App\Models\Comite;
use Illuminate\Http\Request;
class ComiteController extends Controller
{
public function create()
{
    return view('comites.create');
}

public function store(Request $request)
{
    $request->validate([
        'Nombre_comite' => 'required|unique:comites|max:255',
    ]);

    Comite::create($request->all());

    return redirect()->route('comites.create')
                     ->with('success', 'Comité creado exitosamente.');
}

}
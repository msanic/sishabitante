<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;

class DocumentoController extends Controller
{
    public function create()
    {
        return view('documentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_doc' => 'required|max:255',
            'Fechadocumento' => 'required|date',
            'Descripcion' => 'required',
            'Archivo' => 'required|mimes:pdf,doc,docx,jpg,png|max:2048', // Añade validación para el archivo aquí
        ]);
    
        $documento = new Documento();
        $documento->Nombre_doc = $request->Nombre_doc;
        $documento->Fechadocumento = $request->Fechadocumento;
        $documento->Descripcion = $request->Descripcion;
        $documento->id_usuario = auth()->id();
    
        if($request->hasFile('Archivo')){
            $file=$request->file('Archivo');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->move(public_path().'/fotos/',$fileName);
            $documento->Archivo=$fileName;

        }
    
        $documento->save();
    
        return redirect()->route('documentos.index')->with('success', 'Documento creado exitosamente.');
    }
    
    public function show($id)
{
    $documento = Documento::findOrFail($id);
    return view('documentos.show', compact('documento'));
}


public function verArchivo($id)
{
    $documento = Documento::findOrFail($id);
    $archivo = $documento->Archivo; // Aquí asumimos que "Archivo" es el nombre de tu columna BLOB

    return response($archivo)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment;filename="' . $documento->Nombre_doc . '.pdf"');
}


public function index(Request $request)
{
    $user_id = auth()->id();  

    $searchTerm = $request->get('search');

    if ($searchTerm) {
        $documentos = Documento::where('Nombre_doc', 'LIKE', '%' . $searchTerm . '%')
                              ->where('id_usuario', $user_id)  
                              ->get();
    } else {
        $documentos = Documento::where('id_usuario', $user_id)  
                              ->get();
    }

    return view('documentos.index', compact('documentos'));
}

public function edit($id)
{
    $documento=Documento::find($id);
    return view('documentos.edit',compact('documento'));
    //
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $documento=Documento::find($id);
    $documento->Nombre_doc = $request->Nombre_doc;
    $documento->Fechadocumento = $request->Fechadocumento;
    $documento->Descripcion = $request->Descripcion;
    if($request->hasFile('Archivo')){
        $file=$request->file('Archivo');
        File::delete(public_path('fotos/'.$documento->Archivo));
        $fileName = time() . '_' . $file->getClientOriginalName(); 
        $file->move(public_path().'/fotos/',$fileName);
        $documento->Archivo=$fileName;

    }
    $documento->save();
    return redirect()->route('documentos.index');

    //
}
public function destroy($id)
{
    $documento=Documento::find($id);
    if(File::Exists(public_path('fotos/'.$documento->Archivo))){
        File::delete(public_path('fotos/'.$documento->Archivo));
    }
    $documento->delete();
    return redirect()->route('documentos.index');

    //
}
}
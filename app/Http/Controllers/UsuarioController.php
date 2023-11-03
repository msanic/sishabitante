<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
    {
        $this->middleware('AdminSolo');
    }



    public function index()
    {
        $usuarios=User::all();
        return view('usuario.index',compact('usuarios'));

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
        $usuarios=new User;
        $usuarios->name=$request->input('name');
        $usuarios->email=$request->input('email');
        $usuarios->password=Hash::make($request->input('password'));
        $usuarios->rol=$request->input('rol');
        if($request->hasFile('foto')){
            $file=$request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->move(public_path().'/loginfoto/',$fileName);
            $usuarios->foto=$fileName;

        }
        $usuarios->save();
        return redirect()->back();
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuarios=User::find($id);
        $usuarios->name=$request->input('name');
        $usuarios->email=$request->input('email');
        $usuarios->rol=$request->input('rol');
        if ($request->filled('password')) {
            $usuarios->password = Hash::make($request->input('password'));
    
        } else {
            $usuarios->password = $usuarios->password;
        }
        if($request->hasFile('foto')){
            $file=$request->file('foto');
            File::delete(public_path('loginfoto/'.$usuarios->foto));
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->move(public_path().'/loginfoto/',$fileName);
            $usuarios->foto=$fileName;

        }
        $usuarios->save();
        return redirect()->back();
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuarios=User::find($id);
        if(File::Exists(public_path('loginfoto/'.$usuarios->foto))){
            File::delete(public_path('loginfoto/'.$usuarios->foto));
        }
        $usuarios->delete();
        return redirect()->back();
        //
    }
}

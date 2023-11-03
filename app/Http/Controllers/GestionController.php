<?php
namespace App\Http\Controllers;
use App\Models\Documento;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index()
{
    $documentos = Documento::all();
    return view('gestion.index', ['documentos' => $documentos]); 
}

}

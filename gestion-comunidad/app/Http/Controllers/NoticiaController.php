<?php

namespace App\Http\Controllers;

use App\Models\Noticia;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::with('autor')->orderBy('fecha_publicacion', 'desc')->paginate(10);
        return view('noticias.index', compact('noticias'));
    }

    public function show(Noticia $noticia)
    {
        $noticia->load('autor');
        return view('noticias.show', compact('noticia'));
    }
}


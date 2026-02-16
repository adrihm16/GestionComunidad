<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::with('autor')->orderBy('fecha_publicacion', 'desc')->get();
        return view('noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:150',
            'contenido' => 'required|string',
            'adjunto_url' => 'nullable|string|max:255',
        ]);

        $validated['autor_id'] = Auth::id();
        $validated['fecha_publicacion'] = now();

        Noticia::create($validated);
        return redirect()->route('noticias.index')->with('success', 'Noticia publicada correctamente.');
    }

    public function show(Noticia $noticia)
    {
        $noticia->load('autor');
        return view('noticias.show', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:150',
            'contenido' => 'required|string',
            'adjunto_url' => 'nullable|string|max:255',
        ]);

        $noticia->update($validated);
        return redirect()->route('noticias.index')->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return redirect()->route('noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }
}

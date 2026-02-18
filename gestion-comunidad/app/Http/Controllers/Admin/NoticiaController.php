<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::with('autor')->orderBy('fecha_publicacion', 'desc')->paginate(15);
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'   => 'required|string|max:150',
            'contenido' => 'required|string',
            'imagen'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $adjunto_url = null;
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('noticias', 'public');
            $adjunto_url = '/storage/' . $path;
        }

        Noticia::create([
            'titulo'            => $validated['titulo'],
            'contenido'         => $validated['contenido'],
            'adjunto_url'       => $adjunto_url,
            'autor_id'          => Auth::id(),
            'fecha_publicacion' => now(),
        ]);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia publicada correctamente.');
    }

    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $validated = $request->validate([
            'titulo'   => 'required|string|max:150',
            'contenido' => 'required|string',
            'imagen'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $adjunto_url = $noticia->adjunto_url;

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($noticia->adjunto_url) {
                $oldPath = str_replace('/storage/', '', $noticia->adjunto_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('imagen')->store('noticias', 'public');
            $adjunto_url = '/storage/' . $path;
        }

        $noticia->update([
            'titulo'      => $validated['titulo'],
            'contenido'   => $validated['contenido'],
            'adjunto_url' => $adjunto_url,
        ]);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->adjunto_url) {
            $path = str_replace('/storage/', '', $noticia->adjunto_url);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $noticia->delete();

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia eliminada correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VecinoController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('inmuebles');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('cargo_comunidad', 'like', "%{$search}%");
            });
        }

        $vecinos = $query->orderBy('nombre')->get();
        return view('vecinos.index', compact('vecinos'));
    }
}

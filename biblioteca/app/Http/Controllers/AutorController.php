<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $autores = Autor::when($search, function ($query, $search) {
            return $query->where('nome', 'like', "%{$search}%")
                        ->orWhere('nacionalidade', 'like', "%{$search}%");
        })->paginate(10);

        return view('autores.index', compact('autores', 'search'));
    }

    public function create()
    {
        return view('autores.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:100',
        ]);

        Autor::create($request->all());

        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso!');
    }

    public function show($id)
    {
        return redirect()->route('autores.index');
    }

    // 🔥 CORREÇÃO: Use $id em vez de Route Model Binding
    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.form', compact('autor'));
    }

    // 🔥 CORREÇÃO: Use $id em vez de Route Model Binding
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:100',
        ]);

        $autor = Autor::findOrFail($id);
        $autor->update($request->all());

        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso!');
    }

    // 🔥 CORREÇÃO: Use $id em vez de Route Model Binding
public function destroy($id)
{
    $autor = Autor::findOrFail($id);
    
    // 🔥 PRIMEIRO exclui todos os livros do autor
    $autor->livros()->delete();
    
    // DEPOIS exclui o autor
    $autor->delete();

    return redirect()->route('autores.index')->with('success', 'Autor e seus livros excluídos com sucesso!');
}
}
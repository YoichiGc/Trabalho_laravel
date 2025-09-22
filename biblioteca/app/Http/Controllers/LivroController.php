<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $livros = Livro::with('autor')
            ->when($search, function ($query, $search) {
                return $query->where('titulo', 'like', "%{$search}%")
                            ->orWhereHas('autor', function ($q) use ($search) {
                                $q->where('nome', 'like', "%{$search}%");
                            });
            })->paginate(10);

        return view('livros.index', compact('livros', 'search'));
    }

    public function create()
    {
        $autores = Autor::all();
        return view('livros.form', compact('autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
        ]);

        Livro::create($request->all());

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    // 🔥 COMENTE ou REMOVA este método show
    /*
    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }
    */

    // Ou melhor: redirecione para a listagem
    public function show(Livro $livro)
    {
        return redirect()->route('livros.index');
    }

    public function edit(Livro $livro)
    {
        $autores = Autor::all();
        return view('livros.form', compact('livro', 'autores'));
    }

    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
        ]);

        $livro->update($request->all());

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}
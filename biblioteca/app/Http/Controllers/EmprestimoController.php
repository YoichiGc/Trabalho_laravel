<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $emprestimos = Emprestimo::with('livro')
            ->when($search, function ($query, $search) {
                return $query->where('nome_usuario', 'like', "%{$search}%")
                            ->orWhereHas('livro', function ($q) use ($search) {
                                $q->where('titulo', 'like', "%{$search}%");
                            });
            })->paginate(10);

        return view('emprestimos.index', compact('emprestimos', 'search'));
    }

    public function create()
    {
        $livros = Livro::all();
        return view('emprestimos.form', compact('livros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'nome_usuario' => 'required|string|max:255',
            'data_emprestimo' => 'required|date',
            'data_devolucao' => 'nullable|date|after:data_emprestimo',
        ]);

        Emprestimo::create($request->all());

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo criado com sucesso!');
    }

    public function show(Emprestimo $emprestimo)
    {
        return redirect()->route('emprestimos.index');
    }

    public function edit(Emprestimo $emprestimo)
    {
        $livros = Livro::all();
        return view('emprestimos.form', compact('emprestimo', 'livros'));
    }

    public function update(Request $request, Emprestimo $emprestimo)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'nome_usuario' => 'required|string|max:255',
            'data_emprestimo' => 'required|date',
            'data_devolucao' => 'nullable|date|after:data_emprestimo',
        ]);

        $emprestimo->update($request->all());

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo atualizado com sucesso!');
    }

    public function destroy(Emprestimo $emprestimo)
    {
        $emprestimo->delete();
        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo excluído com sucesso!');
    }
}
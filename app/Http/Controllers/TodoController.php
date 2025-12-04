<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){

    $todos = Todo::all();
    return view('todo.index', compact('todos'));

    }
    //Afficher le formulaire de creation

    public function create(){
        return view('todo.create');
    } 

    
    public function store(Request $request){
        $request->validate([
            'titre'=> 'required|max:255',
            'description'=>'nullable'
        ]);

        Todo::create([
            'titre'=> $request ->titre,
            'description'=>$request ->description,
            'complete' =>false,
        ]);
        return redirect()->route('todo.index')->with('success', 'Tâche créée avec succès');
    } 

    public function edit(Todo $todo){
        return view('todo.edit', compact('todo'));
    }

        public function update(Request $request, Todo $todo){
        $request->validate([
            'titre'=> 'required|max:255',
            'description'=>'nullable'
        ]);

        $todo->update([
            'titre'=> $request ->titre,
            'description'=>$request ->description,
            'complete' =>$request->has('complete'),
        ]);
        return redirect()->route('todo.index')->with('success', 'Tâche mise à jour avec succès');
    } 

    public function destroy(Todo $todo){
        $todo -> delete();
        return redirect()->route('todo.index')->with('success', 'Tâche supprimée avec succès');
    }
}

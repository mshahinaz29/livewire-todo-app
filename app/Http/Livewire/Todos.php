<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Todos extends Component
{
    public $title = '';
    public $edit_id = 0;
    public $edit_title = '';


    public function render()
    {
        return view('livewire.todos', [
            'todos' => Todo::get()
        ]);
    }

    public function addTodo()
    {
        $this->validate([
            'title' => 'required',
        ]);

        Todo::create([
            'title' => $this->title,
            'completed' => false
        ]);

        $this->title = '';
    }

    public function deleteTodo($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
    }

    public function toggleTodo($id)
    {
        $todo = Todo::find($id);

        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function editTodo($id)
    {
        $todo = Todo::find($id);

        $this->edit_id = $id;
        $this->edit_title = $todo->title;
    }

    public function updateTodo($id)
    {
        $todo = Todo::find($id);

        $todo->title = $this->edit_title;
        $todo->save();

        $this->edit_id = 0;
    }
}

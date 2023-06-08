<div>
   <div style="position:fixed; top:10%; left: 60vh; width: 500px">
        
        <div class="mb-4">
            <input type="text" name="addTodo" class="form-control form-control-lg" 
            id="addTodo" placeholder="What needs to be done" 
            wire:keydown.enter="addTodo"
            wire:model="title">
            
            @if ($errors->has('title'))
                <div style="color:red">
                    {{ $errors->first('title')}}
                </div>
            @endif
            {{-- <button class="btn btn-primary" wire:click="addTodo" type="submit">Add</button> --}}
        </div>

        <ul class="list-group"> 
            @foreach ($todos as $todo)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                @if ($todo->id != $edit_id)
                    <div>
                        
                        <input type="checkbox" wire:change="toggleTodo({{ $todo->id }})"
                        {{$todo->completed ? 'checked':''}}>
                        <a 
                            href="#" 
                            class="{{ $todo->completed ? 'completed':''}}"
                            {{-- onclick="updateTodoPrompt({{ $todo->title }}) || event.stopImmediatePropagation()"
                            wire:click="updateTodo({{ $todo->id }}, todoUpdated)" --}}
                        >
                            {{ $todo->title }}
                        </a>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-info" 
                        wire:click="editTodo({{ $todo->id }})">
                        <i class="fa-solid fa-pen-to-square"></i></button>

                        <button class="btn btn-sm btn-danger" 
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="deleteTodo({{ $todo->id }})">
                        &times;</button>
                        
                    </div>    
                @else
                    <input type="text" class="form-control form-control-lg" 
                    wire:keydown.enter="updateTodo({{ $todo->id }})"
                    wire:model="edit_title"
                    >
                    <button class="btn btn-sm btn-success" wire:click="updateTodo({{ $todo->id }})"><i class="fa-solid fa-check"></i></button>
                @endif
                
            </li> 
            @endforeach

        </ul>
   </div>

</div>

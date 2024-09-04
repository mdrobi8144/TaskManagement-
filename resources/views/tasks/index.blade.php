@extends('layouts.task-lo')

@section('title', 'Your Tasks')

@section('content')
<div class="container">
    <h1>Your Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>

    <ul class="list-group">
        @foreach($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <form action="{{ route('tasks.toggleCompletion', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                    </form>
                    <a href="{{ route('tasks.edit', $task) }}" class="ms-2 {{ $task->completed ? 'text-decoration-line-through' : '' }}">
                        {{ $task->title }}
                    </a>
                </div>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection

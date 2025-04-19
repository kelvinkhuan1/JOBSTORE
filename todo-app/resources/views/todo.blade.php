<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TODO App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 2rem; background: #f4f4f4; }
        h1 { margin-bottom: 1rem; }
        form { margin-bottom: 2rem; }
        ul { list-style: none; padding: 0; }
        li { background: white; padding: 1rem; margin-bottom: 1rem; border-radius: 5px; display: flex; align-items: center; justify-content: space-between; }
        .completed { text-decoration: line-through; color: gray; }
        .task-controls form { display: inline; margin-left: 10px; }
    </style>
</head>
<body>
    <h1>TO-DO List</h1>

    {{-- Add New Task --}}
    <form method="POST" action="/add">
        @csrf
        <input type="text" name="description" placeholder="Enter a task" required>
        <input type="date" name="date" required>
        <label>From:</label>
        <input type="time" name="from_time" required>

        <label>To:</label>
        <input type="time" name="to_time" required>
        <button type="submit">Add Task</button>
    </form>

    {{-- Task List --}}
    <ul>
        @forelse ($todos as $todo)
            <li>
                <div>
                    {{-- Toggle Checkbox --}}
                    <form action="/toggle/{{ $todo['id'] }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="checkbox" onchange="this.form.submit()" {{ $todo['checked'] ? 'checked' : '' }}>
                    </form>

                    {{-- Description --}}
                    <span class="{{ $todo['checked'] ? 'completed' : '' }}">
                        {{ $todo['description'] }}
                    </span>

                    <div style="font-size: 0.8rem; color: gray;">
                        {{ $todo['date'] }} {{ $todo['from_time'] }} - {{ $todo['to_time'] }}
                    </div>
                </div>

                <div class="task-controls">
                    {{-- Update --}}
                    <form method="POST" action="/update/{{ $todo['id'] }}">
                        @csrf
                        <input type="text" name="description" value="{{ $todo['description'] }}" required>
                        <input type="time" name="from_time" value="{{ $todo['from_time'] }}" required>
                        <input type="time" name="to_time" value="{{ $todo['to_time'] }}" required>
                        <button type="submit">Update</button>
                    </form>

                    {{-- Delete --}}
                    <form action="/delete/{{ $todo['id'] }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Delete this task?')">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li>No tasks</li>
        @endforelse
    </ul>
</body>
</html>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Session::get('todos', []);
        return view('todo', ['todos' => $todos]);
    }

    public function add(Request $request)
    {
        $description = $request->input('description');
        $date = $request->input('date');
        $fromTime = $request->input('from_time');
        $toTime = $request->input('to_time');

        $todos = Session::get('todos', []);

        array_unshift($todos, [
            'id' => (string) Str::uuid(),
            'date' => $date,
            'from_time' => $fromTime,
            'to_time' => $toTime,
            'checked' => false,
            'description' => $description,
        ]);

        // ✅ Sort by date + from_time (ascending: soonest first)
        usort($todos, function ($a, $b) {
            $aTime = strtotime($a['date'] . ' ' . $a['from_time']);
            $bTime = strtotime($b['date'] . ' ' . $b['from_time']);
            return $aTime <=> $bTime;
        });

        Session::put('todos', $todos);
        return redirect('/');
    }

    public function delete($id)
    {
        $todos = Session::get('todos', []);
        $todos = array_filter($todos, fn($todo) => $todo['id'] !== $id);
        Session::put('todos', array_values($todos));
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $todos = Session::get('todos', []);
        foreach ($todos as &$todo) {
            if ($todo['id'] === $id) {
                $todo['description'] = $request->input('description');
                break;
            }
        }
        Session::put('todos', $todos);
        return redirect('/');
    }

    public function toggle($id)
    {
        $todos = Session::get('todos', []);
        foreach ($todos as &$todo) {
            if ($todo['id'] === $id) {
                $todo['checked'] = !$todo['checked'];
                break;
            }
        }
        Session::put('todos', $todos);
        return redirect('/');
    }
}
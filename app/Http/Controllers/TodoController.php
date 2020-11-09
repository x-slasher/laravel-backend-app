<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::orderBy('id','desc')->get();
        $todo->transform(function ($item) {
            if ($item->completed == 1) {
                $item->completed = true;
            } else {
                $item->completed = false;
            }
            return $item;
        });
        return response()->json([
            'status' => 200,
            'data' => $todo
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'completed' => 'boolean'
        ]);

        $todo = Todo::create($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Todo created successfully',
            'data' => $todo
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'completed' => 'boolean'
        ]);

        $todo->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Todo list updated successfully',
            'data' => $todo
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Todo deleted successfully'
        ],200);
    }
}

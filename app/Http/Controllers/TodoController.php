<?php

namespace App\Http\Controllers;

use App\Models\Todo;
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
		$todos = Todo::latest()->paginate(1);
		return response()->json($todos);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate_todo();
		$todo = Todo::create(request()->only('title', 'content'));
		return response()->json($todo);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Todo  $todo
	 * @return \Illuminate\Http\Response
	 */
	public function show(Todo $todo)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Todo  $todo
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
	 * @param  \App\Models\Todo  $todo
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Todo $todo)
	{
		$this->validate_todo();
		$todo = Todo::update(request()->only('title', 'content'));
		return response()->json($todo);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Todo  $todo
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Todo $todo)
	{
		Todo::destroy($todo);
		return response()->json("ok");
	}

	public function validate_todo()
	{
		return request()->validate([
			'title' => 'required|min:10|max:255',
			'content' => 'required',
		]);
	}
}

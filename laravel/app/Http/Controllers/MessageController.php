<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->get();
        return response()->json($messages);
    }

    public function mypage()
    {
        return view('mypage');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $params = $request->all();
        return Message::create(['content' => $params['message']]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        return response()->json('deleted');
    }
}

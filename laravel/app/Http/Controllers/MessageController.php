<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Http\Resources\UserResource;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'desc')->get();
        foreach ($messages as $message) {
            $message->date = date_format($message->created_at, 'Y-m-d H:i');;
        }
        return MessageResource::collection($messages);
    }

    public function mypage()
    {
        return view('mypage');
    }

    public function top()
    {
        return view('message.index');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $params = $request->all();
        return Message::create(
            [
                'content' => $params['message'],
                'user_id' => $params['user_id']
            ]
        );
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

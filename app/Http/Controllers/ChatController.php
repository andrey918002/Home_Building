<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    const LIMIT = 10;

    public function show($id)
    {
        return view('chat.chat')->with([
            'chat' => User::where('id', $id)->first()
        ]);
    }

    public function getList() {
        return view('chat.list');
    }

    public function getChats() {
        $json = [];

        try {
            $chats = DB::select('SELECT u.name, m2.chat_id, m2.from, m2.to, m2.message, m2.created_at, m2.is_read FROM (
                                            SELECT m.chat_id, MAX(m.id) id FROM messages m GROUP BY m.chat_id
                                        ) t1
                                        LEFT JOIN messages m2 ON t1.id = m2.id
                                        LEFT JOIN users u ON (
                                            (u.id = m2.`to` OR u.id = m2.`from`) AND u.id != ' . auth()->user()->id . '
                                        )
                                        ORDER BY m2.created_at DESC');

            $json['chats'] = [];

            foreach ($chats as $chat) {
                $json['chats'][] = [
                    'name' => $chat->name,
                    'partner' => auth()->user()->id != $chat->from ? $chat->from : $chat->to,
                    'message' => $chat->message,
                    'created_at' => $chat->created_at,
                    'is_read' => $chat->is_read
                ]; // данные в json
            }

            $json['success'] = true;
        } catch (\Exception $e) {
            $json['success'] = false;
            $json['error'] = $e->getMessage();
        }

        return $json;
    }

    public function getMessages(Request $request)
    {
        $json = [];

        try {

            $offset = $request->input('page') ? self::LIMIT * ($request->input('page') - 1) : 0;

            $json['messages'] = Message::where(
                function ($query) use ($request) {
                    $query->where('from', auth()->user()->id)
                        ->where('to', $request->input('to'));
                }
            )->orWhere(
                function ($query)  use ($request) {
                    $query->where('to', auth()->user()->id)
                        ->where('from', $request->input('to'));
                }
            )
                ->orderByDesc('created_at')
                ->offset($offset)
                ->limit(self::LIMIT)
                ->get();

            foreach ($json['messages'] as $message) {
                if($message->from == $request->input('to') && !$message->is_read) {
                    $message->is_read = true;
                    $message->save();
                }
            }

            $json['success'] = true;

        } catch (\Exception $e) {
            $json['success'] = false;
            $json['error'] = $e->getMessage();
        }

        return $json;
    }

    public function sendMessage(Request $request)
    {
        $json = [];

        try {
            $message = Message::create([
                'from'      => auth()->user()->id,
                'to'        => $request->input('id'),
                'message'   => $request->input('message'),
                'is_read'   => 0
            ]);

            $json['message'] = $message;
            $json['success'] = true;

        } catch (\Exception $e) {
            $json['success'] = false;
            $json['error'] = $e->getMessage();
        }

        return $json;
    }

    public function getNewMessage(Request $request)
    {
        $json = [];

        try {

            $json['messages'] = Message::where(
                function ($query)  use ($request) {
                    $query->where('to', auth()->user()->id)
                        ->where('from', $request->input('chat_id'))
                        ->where('is_read', false);
                }
            )
                ->get();

            foreach ($json['messages'] as $message) {
                $message->is_read = true;
                $message->save();
            }

            $json['success'] = true;

        } catch (\Exception $e) {
            $json['success'] = false;
            $json['error'] = $e->getMessage();
        }

        return $json;
    }

    public function getUnreadChats()
    {
        $json = [];

        try {
            $chats = DB::select("SELECT COUNT(t1.f) as total FROM (SELECT COUNT(`from`) as f FROM messages WHERE `to` = " . auth()->user()->id. " AND is_read = '0' GROUP BY `from`) as t1"); // запрос с подзапросом. Позапрос: коливчество непрочитанных сообщений от каждого человека. Запрос; сумируем количество людей от которых пришли непрочитанные сообщения.

            $json['chats'] = $chats[0]->total;

            $json['success'] = true;

        } catch (\Exception $e) {
            $json['success'] = false;
            $json['error'] = $e->getMessage();
        }

        return $json;
    }
}


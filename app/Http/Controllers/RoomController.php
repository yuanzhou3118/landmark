<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Exception;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * user management index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function query()
    {
        $room = Room::orderBy('id')->get();

        return view('room.manage', ['room' => $room]);
    }

    public function edit($id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return redirect()->route('admin.room.query');
        }

        $room = Room::whereId($id)->first();

        return view('room.edit', ['room' => $room]);
    }

    public function update(Request $request, $id)
    {
        $roomId = intval(trim($id));

        $room = Room::whereId($roomId)->first();
        Log::info('roomid:'.$roomId);
        if (is_null($room)) {
            return redirect()->route('admin.room.query');
        }

        $name = trim($request->input('name'));
        if (mb_strlen($name) == 0) {
            $result = 'Save Error';

            return view('room.edit', ['room' => $room, 'result' => $result]);
        }

        $desc = trim($request->input('desc'));
        Log::info('desc:'.$request->input('desc'));
        if (mb_strlen($desc) == 0) {
            $result = 'Save Error';

            return view('room.edit', ['room' => $room, 'result' => $result]);
        }

        $room->name = $name;
        $room->desc = $desc;

        $result = 0;

        try {
            $room->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store room exception ,exception:' . $e->getMessage());
        }
        if ($result == 1) {
            return redirect()->route('admin.room.query');
        }

        return view('room.edit', ['room' => $room, 'result' => 'Save Error']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $room = Room::whereId($id)->first();

        if (is_null($room)) {
            return redirect()->route('admin.room.query');
        }

        $result = 'Delete Error';

        try {
            $room::destroy($id);

            $result = 'Delete Success';
        } catch (Exception $e) {
            Log::error('delete room exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('room.delete', ['result' => $result]);
    }

    public function create()
    {
        return view('room.create');
    }

    public function store(Request $request)
    {
        $room = new Room();

        $name = trim($request->input('name'));
        if (mb_strlen($name) == 0) {
            $result = 'Add Error';

            return view('room.create', ['result' => $result]);
        }

        $desc = trim($request->input('desc'));

        if (mb_strlen($desc) == 0) {
            $result = 'Add Error';

            return view('room.create', ['result' => $result]);
        }

        $room->name = $name;
        $room->desc = $desc;
        $room->location = 'HK';

        $result = 0;

        try {
            $room->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store room exception ,exception:' . $e->getMessage());
        }
        if($result == 1){
            return redirect()->route('admin.room.query');
        }
        return view('room.create', ['result' => 'Add Error']);
    }
}

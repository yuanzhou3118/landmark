<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Room;
use Illuminate\Http\Request;
use Exception;
use Log;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    /**
     * user management index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function query()
    {
        $appointment = DB::table('appointments')
            ->join('rooms', 'rooms.id', '=', 'appointments.room_id')
            ->orderBy('appointments.created_at')
            ->get([
                'appointments.location',
                'rooms.name',
                'appointments.room_id',
                'appointments.date',
                'appointments.time_from',
                'appointments.id',
            ]);

        return view('appointment.manage', ['appointment' => $appointment]);
    }

    public function edit($id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return redirect()->route('admin.appointment.query');
        }

        $appointment = appointment::whereId($id)->first();

        $roomName = Room::whereId($appointment->room_id)->first(['name']);

        $room = Room::get(['id', 'name']);

        return view('appointment.edit', ['appointment' => $appointment, 'room_name' => $roomName, 'room' => $room]);
    }

    public function update(Request $request, $id)
    {
        $appointmentId = intval(trim($id));

        $appointment = appointment::whereId($appointmentId)->first();

        if (is_null($appointment)) {
            return redirect()->route('admin.appointment.query');
        }

        $location = trim($request->input('location'));
        if (mb_strlen($location) == 0) {
            $result = 'Save Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $timeFrom = intval(trim($request->input('time_from')));
        if ($timeFrom < 0) {
            $result = 'Save Error';

            return view('appointment.edit', ['appointment' => $appointment, 'result' => $result]);
        }

        $timeTo = intval(trim($request->input('time_to')));
        if ($timeTo < 0) {
            $result = 'Save Error';

            return view('appointment.edit', ['appointment' => $appointment, 'result' => $result]);
        }

        $year = trim($request->input('year'));
        if ($year < 0) {
            $result = 'Save Error';

            return view('appointment.edit', ['appointment' => $appointment, 'result' => $result]);
        }

        $month = trim($request->input('month'));
        if ($month < 0) {
            $result = 'Save Error';

            return view('appointment.edit', ['appointment' => $appointment, 'result' => $result]);
        }

        $day = trim($request->input('day'));
        if ($day < 0) {
            $result = 'Save Error';

            return view('appointment.edit', ['appointment' => $appointment, 'result' => $result]);
        }

        $roomId = trim($request->input('room_id'));
        if (mb_strlen($roomId) == 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $date = $year . '-' . $month . '-' . $day;

        $appointment->location = $location;
        $appointment->time_from = $timeFrom;
        $appointment->time_to = $timeTo;
        $appointment->date = $date;
        $appointment->room_id = $roomId;

        $result = 0;

        try {
            $appointment->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store appointment exception ,exception:' . $e->getMessage());
        }
        if ($result == 1) {
            return redirect()->route('admin.appointment.query');
        }

        return view('appointment.edit', ['appointment' => $appointment, 'result' => 'Save Error']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $appointment = appointment::whereId($id)->first();

        if (is_null($appointment)) {
            return redirect()->route('admin.appointment.query');
        }

        $result = 'Delete Error';

        try {
            $appointment::destroy($id);

            $result = 'Delete Success';
        } catch (Exception $e) {
            Log::error('delete appointment exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('appointment.delete', ['result' => $result]);
    }

    public function create()
    {
        $room = Room::get(['id', 'name']);

        return view('appointment.create', ['appointment' => new Appointment(), 'room' => $room]);
    }

    public function store(Request $request)
    {
        $appointment = new Appointment();

        $timeFrom = intval(trim($request->input('time_from')));
        if ($timeFrom < 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $timeTo = intval(trim($request->input('time_to')));
        if ($timeTo < 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $year = intval(trim($request->input('year')));
        if ($year < 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $month = trim($request->input('month'));
        if ($month < 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $day = trim($request->input('day'));
        if ($day < 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $date = $year . '-' . $month . '-' . $day;

        $location = trim($request->input('location'));
        if (mb_strlen($location) == 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $roomId = trim($request->input('room_id'));
        if (mb_strlen($roomId) == 0) {
            $result = 'Make Error';

            return view('appointment.create', ['appointment' => $appointment, 'result' => $result]);
        }

        $appointment->location = $location;
        $appointment->time_from = $timeFrom;
        $appointment->time_to = $timeTo;
        $appointment->date = $date;
        $appointment->room_id = $roomId;
        $appointment->backend_user_id = session('bk_auth');
        $appointment->backend_user_name = session('bk_name');
        $appointment->user_id = 1;

        $result = 0;

        try {
            $appointment->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store appointment exception ,exception:' . $e->getMessage());
        }
        if ($result == 1) {
            return redirect()->route('admin.appointment.query');
        }
        return view('appointment.create', ['appointment' => $appointment, 'result' => 'Add Error']);
    }
}

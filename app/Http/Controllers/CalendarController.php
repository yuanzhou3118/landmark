<?php

namespace App\Http\Controllers;

use App\Models\BackendUser;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function daily()
    {
        return view('calendar.manage');
    }

    public function dailyDo()
    {
        $appointment = DB::table('appointments')
            ->join('rooms', 'rooms.id', '=', 'appointments.room_id')
            ->get([
                'rooms.name as room_name',
                'appointments.room_id',
                'appointments.date',
                'appointments.time_from',
                'appointments.time_to',
                'appointments.backend_user_id',
                'appointments.backend_user_name',
                'appointments.user_id',
                'appointments.id',
            ]);

        return response()->json(['appointment' => $appointment]);
    }
}

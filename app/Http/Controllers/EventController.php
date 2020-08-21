<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CalendarEventModel;

class EventController extends Controller 
{
    function add(Request $request)
    {
        $postData = $request->all();
        
        $calendarEvent = CalendarEventModel::create([
            'event'     => $postData['event'],
            'datefrom'  => $postData['dateFrom'],
            'dateto'    => $postData['dateTo'],
            'weekdays'  => implode(',',$postData['weekdays'])
        ]);

        return response()->json(['status' => 'ok', 'calendarevent' => $calendarEvent]);
    }
}
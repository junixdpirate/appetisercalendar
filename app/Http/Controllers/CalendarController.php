<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CalendarController extends Controller 
{
    function index()
    {
        return view('calendar');
    }
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEventModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calendar_event';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event', 'datefrom', 'dateto', 'weekdays'
    ];    
}

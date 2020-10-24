<?php

namespace App\Models\Conference;

use Illuminate\Database\Eloquent\Model;

class AgendaSlot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'date', 'start_time', 'end_time', 'type', 'activation', 'conference_id'
    ];
}

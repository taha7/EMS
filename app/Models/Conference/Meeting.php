<?php

namespace App\Models\Conference;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['agenda_slot_id', 'company_id', 'client_id'];
}

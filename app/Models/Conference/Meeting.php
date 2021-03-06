<?php

namespace App\Models\Conference;

use App\Models\Traits\Relations\MeetingRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use MeetingRelations, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['agenda_slot_id', 'company_id', 'client_id'];
}

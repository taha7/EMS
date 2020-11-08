<?php

namespace App\Models\Conference;

use App\Models\Traits\Relations\AgendaSlotRelations;
use App\Models\Traits\Scopes\General\InConf;
use Illuminate\Database\Eloquent\Model;

class AgendaSlot extends Model
{
    use InConf, AgendaSlotRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'date', 'start_time', 'end_time', 'type', 'activation', 'conference_id'
    ];
}

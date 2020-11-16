<?php

namespace App\Models\Conference;

use App\Models\Traits\Relations\AgendaSlotRelations;
use App\Models\Traits\Scopes\AgendaSlot\SlotType;
use App\Models\Traits\Scopes\General\InConf;
use Illuminate\Database\Eloquent\Model;

class AgendaSlot extends Model
{
    use InConf, SlotType ,AgendaSlotRelations;

    const PUBLIC_SLOT = 1;
    const PRIVATE_SLOT = 2;
    const EXCEPTION_SLOT = 3;
    const MEDIA_SLOT = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'date', 'start_time', 'end_time', 'type', 'activation', 'conference_id'
    ];
}

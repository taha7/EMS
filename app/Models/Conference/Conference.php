<?php

namespace App\Models\Conference;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'location', 'start_date', 'end_date', 'cut_off_date', 'registeration_deadline', 'subdomain',
        'enable_login', 'web_enable_preferences', 'web_enable_register', 'web_enable_remark_box',
        'mobile_enable', 'small_group_definition', 'hotel_accommodation', 'split_days', 'investor_selection_limit',
        'allow_big_groups', 'min_media_slot', 'max_media_slot', 'title', 'is_virtual', 'meeting_link_status'
    ];
}

<?php

namespace App\Models\Lookups;

use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title_id', 'job_title', 'from', 'cc', 'mobile', 'image', 'activation'
    ];
}

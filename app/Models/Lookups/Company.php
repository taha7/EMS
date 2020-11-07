<?php

namespace App\Models\Lookups;

use App\Models\Traits\Relations\CompanyRelations;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use CompanyRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'activation', 'sector_id', 'country_id'];
}

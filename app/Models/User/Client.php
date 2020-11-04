<?php

namespace App\Models\User;

use App\Models\Traits\Relations\ClientRelations;
use App\Models\Traits\Scopes\Client\Type;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use ClientRelations, Type;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'family_name', 'middle_name', 'job_title', 'address', 'telephone', 'mobile', 'fax', 'email',
        'additional_email', 'assistant_name', 'assistant_phone', 'assistant_email', 'primary_signatory_id',
        'secondary_signatory_id', 'country_id', 'title_id', 'company_id', 'client_type_id', 'name_format_type',
        'sort', 'nationality_id', 'naming_convension'
    ];

}

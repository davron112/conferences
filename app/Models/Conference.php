<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Conference.
 *
 * @package namespace App\Models;
 */
class Conference extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'begin_date',
        'end_date',
        'deadline',
        'subject',
        'description',
        'additional_files',
        'address', 'phone',
        'email',
        'organization',
        'payment_account'
    ];

}

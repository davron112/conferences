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

    const STATUS_ACTIVE = 'ACTIVE';

    const STATUS_PENDING = 'PENDING';

    const STATUS_EXPIRE = 'EXPIRE';
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
        'status',
        'mini_description',
        'description',
        'additional_files',
        'address',
        'phone',
        'email',
        'organization',
        'meeting_link',
        'meeting_info',
        'payment_account'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories() {
        return $this->hasMany(Category::class, 'conference_id', 'id');
    }

}

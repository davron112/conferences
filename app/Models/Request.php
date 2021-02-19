<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Request.
 *
 * @package namespace App\Models;
 */
class Request extends Model implements Transformable
{
    use TransformableTrait;

    const STATUS_NEW = 'NEW';

    const STATUS_APPROVED = 'ACCEPTED';

    const STATUS_NOT_APPROVED = 'NOT_ACCEPTED';

    const PAYMENT_STATUS_PAID = 'PAID';

    const PAYMENT_STATUS_UNPAID = 'UNPAID';

    protected $appends = ['category_name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'conference_id',
        'category_id',
        'user_id',
        'send_owner',
        'send_user',
        'email',
        'phone',
        'username',
        'status',
        'payment_status',
        'payment_link',
        'note_client',
        'authors',
        'subject',
        'file',
        'answer_text'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return mixed
     */
    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }
}

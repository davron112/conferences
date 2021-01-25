<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\UserFile;

/**
 * Class UserFileTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserFileTransformer extends TransformerAbstract
{
    /**
     * Transform the UserFile entity.
     *
     * @param \App\Models\UserFile $model
     *
     * @return array
     */
    public function transform(UserFile $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

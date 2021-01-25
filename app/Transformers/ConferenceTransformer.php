<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Conference;

/**
 * Class ConferenceTransformer.
 *
 * @package namespace App\Transformers;
 */
class ConferenceTransformer extends TransformerAbstract
{
    /**
     * Transform the Conference entity.
     *
     * @param \App\Models\Conference $model
     *
     * @return array
     */
    public function transform(Conference $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Request;

/**
 * Class RequestTransformer.
 *
 * @package namespace App\Transformers;
 */
class RequestTransformer extends TransformerAbstract
{
    /**
     * Transform the Request entity.
     *
     * @param \App\Models\Request $model
     *
     * @return array
     */
    public function transform(Request $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

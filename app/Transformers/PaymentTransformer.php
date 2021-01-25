<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Payment;

/**
 * Class PaymentTransformer.
 *
 * @package namespace App\Transformers;
 */
class PaymentTransformer extends TransformerAbstract
{
    /**
     * Transform the Payment entity.
     *
     * @param \App\Models\Payment $model
     *
     * @return array
     */
    public function transform(Payment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

<?php

namespace App\Presenters;

use App\Transformers\PaymentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PaymentPresenter.
 *
 * @package namespace App\Presenters;
 */
class PaymentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PaymentTransformer();
    }
}

<?php

namespace App\Presenters;

use App\Transformers\RequestTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RequestPresenter.
 *
 * @package namespace App\Presenters;
 */
class RequestPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RequestTransformer();
    }
}

<?php

namespace App\Presenters;

use App\Transformers\UserFileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserFilePresenter.
 *
 * @package namespace App\Presenters;
 */
class UserFilePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserFileTransformer();
    }
}

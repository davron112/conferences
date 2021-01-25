<?php

namespace App\Presenters;

use App\Transformers\ConferenceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ConferencePresenter.
 *
 * @package namespace App\Presenters;
 */
class ConferencePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ConferenceTransformer();
    }
}

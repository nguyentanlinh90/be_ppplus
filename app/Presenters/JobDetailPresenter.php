<?php

namespace App\Presenters;

use App\Transformers\JobDetailTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class JobDetailPresenter.
 *
 * @package namespace App\Presenters;
 */
class JobDetailPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new JobDetailTransformer();
    }
}

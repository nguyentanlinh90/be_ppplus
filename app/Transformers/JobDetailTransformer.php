<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\JobDetail;

/**
 * Class JobDetailTransformer.
 *
 * @package namespace App\Transformers;
 */
class JobDetailTransformer extends TransformerAbstract
{
    /**
     * Transform the JobDetail entity.
     *
     * @param \App\Entities\JobDetail $model
     *
     * @return array
     */
    public function transform(JobDetail $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}

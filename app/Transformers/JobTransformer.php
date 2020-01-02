<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Job;

/**
 * Class JobTransformer.
 *
 * @package namespace App\Transformers;
 */
class JobTransformer extends TransformerAbstract
{
    /**
     * Transform the Job entity.
     *
     * @param \App\Entities\Job $model
     *
     * @return array
     */
    public function transform(Job $model)
    {

        $tmp = [];
        foreach ($model->job_details as $key => $item) {
            $model->job_details[$key]['hour_day'] =  unserialize($item['hour_day']);
            $model->job_details[$key]['week_day'] =  unserialize($item['week_day']);
        }
//        print_r($model->job_details);
//        echo 'done';exit;
        //$data = unserialize($model->job_details['hour_day']);
        //print_r($data);
        //exit;
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'logo_url' => $model->logo_url,
            'merchant_name' => $model->merchant_name,
            'rating' => $model->rating,
            'trending' => $model->trending,
            'job_title' => $model->job_title,
            'age_min' => $model->age_min,
            'age_max' => $model->age_max,
            'gender' => $model->gender,
            'location' => $model->location,
            'time_start' => $model->time_start,
            'time_end' => $model->time_end,
            'amount' => $model->amount,
            'job_details' => $model->job_details

        ];
    }
}

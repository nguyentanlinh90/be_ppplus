<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JobDetailRepository;
use App\Entities\JobDetail;
use App\Validators\JobDetailValidator;

/**
 * Class JobDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class JobDetailRepositoryEloquent extends BaseRepository implements JobDetailRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return JobDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return JobDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }



}

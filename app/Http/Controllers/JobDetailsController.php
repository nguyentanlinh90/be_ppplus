<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\JobDetailCreateRequest;
use App\Http\Requests\JobDetailUpdateRequest;
use App\Repositories\JobDetailRepository;
use App\Validators\JobDetailValidator;

/**
 * Class JobDetailsController.
 *
 * @package namespace App\Http\Controllers;
 */
class JobDetailsController extends Controller
{
    /**
     * @var JobDetailRepository
     */
    protected $repository;

    /**
     * @var JobDetailValidator
     */
    protected $validator;

    /**
     * JobDetailsController constructor.
     *
     * @param JobDetailRepository $repository
     * @param JobDetailValidator $validator
     */
    public function __construct(JobDetailRepository $repository, JobDetailValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $jobDetails = $this->repository->all();

//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $jobDetails,
//            ]);
//        }
//
//        return view('jobDetails.index', compact('jobDetails'));
        echo '<pre>';
        print_r($jobDetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  JobDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(JobDetailCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $jobDetail = $this->repository->create($request->all());

            $response = [
                'message' => 'JobDetail created.',
                'data'    => $jobDetail->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $jobDetail,
            ]);
        }

        return view('jobDetails.show', compact('jobDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobDetail = $this->repository->find($id);

        return view('jobDetails.edit', compact('jobDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  JobDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(JobDetailUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $jobDetail = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'JobDetail updated.',
                'data'    => $jobDetail->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'JobDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'JobDetail deleted.');
    }
}

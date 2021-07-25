<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckIfEligibleRequest;
use App\Http\Requests\SubmitSubmissionRequest;
use App\Mail\SendEmail;
use App\Repositories\Api\RuangguruApiRepository;
use App\Repositories\Eloquent\EligiblePrizeMappingsRepository;
use App\Repositories\Eloquent\SubmissionsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    protected RuangguruApiRepository $ruangguruApiRepository;
    protected EligiblePrizeMappingsRepository $eligiblePrizeMappingsRepository;
    protected SubmissionsRepository $submissionsRepository;

    public function __construct(
        RuangguruApiRepository $ruangguruApiRepository,
        EligiblePrizeMappingsRepository $eligiblePrizeMappingsRepository,
        SubmissionsRepository $submissionsRepository
    ) {
        $this->ruangguruApiRepository = $ruangguruApiRepository;
        $this->eligiblePrizeMappingsRepository = $eligiblePrizeMappingsRepository;
        $this->submissionsRepository = $submissionsRepository;
    }

    public function index()
    {
        return view('pages.home.submit-submission');
    }

    public function checkIfEligible(CheckIfEligibleRequest $request)
    {
        $validated = $request->validated();
        $userId = $validated['userId'];

        $ruangguruApiRepository = $this->ruangguruApiRepository;
        $eligiblePrizeMappingsRepository = $this->eligiblePrizeMappingsRepository;

        $response = Cache::remember('userID-'.$userId, 60, function () use ($userId, $ruangguruApiRepository, $eligiblePrizeMappingsRepository) {
            $data = $ruangguruApiRepository->getByUserId($userId);
            $status = $data['status'];

            if($status == 'error') {
                return response()->json([
                    'status' => $data['status'],
                    'message' => $data['message']
                ], 404);
            }

            $user = $data['user'];
            $packages = $data['packages'];

            $isEligible = 0;
            $eligibleList = [];

            foreach($packages as $package) {
                if($package['orderStatus'] == 'SUCCEED') {
                    $isEligible = 1;
                    array_push($eligibleList, $package['packageTag']);
                }
            }

            $eligiblePrizes = $eligiblePrizeMappingsRepository->view('view_eligible_prize_mappings', ['product_subscription_name', 'product_tag', 'prize_name'], ['product_tag' => $eligibleList]);

            return response()->json([
                'user' => $user,
                'isEligible' => $isEligible,
                'eligiblePrizes' => $eligiblePrizes
            ], 200);
        });

        return $response;
    }

    public function submitSubmission(SubmitSubmissionRequest $request)
    {
        $validated = $request->validated();

        $checkDuplicate = $this->submissionsRepository->findDuplicate(['user_id' => $validated['user_id']]);

        if($checkDuplicate >= 1) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Submission already Created',
                'data' => $checkDuplicate
            ], 200);
        } else {
            $insert = $this->submissionsRepository->create($validated);

            if($insert) {
                $data = $this->submissionsRepository->getByUserId($validated['user_id']);
                //Mail::to($validated['user_email'])->send(new SendEmail($data));
                Mail::to('bernandotorrez4@gmail.com')->send(new SendEmail($data));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Submission Succesfully',
                    'data' => $insert
                ], 200);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Submission Failed',
                    'data' => null
                ], 200);
            }
        }
    }

    public function checkSubmission()
    {
        return view('pages.home.check-submission');
    }

    public function checkMySubmission(CheckIfEligibleRequest $request)
    {
        $validated = $request->validated();
        $submissionsRepository = $this->submissionsRepository;

        $data = Cache::remember('checkMySubmission-userId-'.$validated['userId'], 60, function () use ($submissionsRepository, $validated) {
            return $submissionsRepository->getByUserId($validated['userId']);
        });

        if($data->status_submission == 'Crt') {
            $progress = 'Created';
        } else if($data->status_submission == 'Dlv') {
            $progress = 'Delivery';
        } else if($data->status_submission == 'Rjt') {
            $progress = 'Rejected';
        }

        if($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Success',
                'data' => $data->user_id,
                'progress' => $progress
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found',
                'data' => null,
                'progress' => null
            ], 200);
        }


    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitSubmissionRequest;
use App\Repositories\Api\RuangguruApiRepository;
use App\Repositories\Eloquent\EligiblePrizeMappingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home.index');
    }

    public function checkIfEligible(
        SubmitSubmissionRequest $request,
        RuangguruApiRepository $ruangguruApiRepository,
        EligiblePrizeMappingsRepository $eligiblePrizeMappingsRepository
    ) {
        $validated = $request->validated();
        $userId = $validated['userId'];

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
}

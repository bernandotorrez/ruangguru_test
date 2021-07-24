<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitSubmissionRequest;
use App\Repositories\Api\RuangguruApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    protected array $eligibleMapping;

    public function __construct()
    {
        $this->eligibleMapping = ['englishacademy', 'skillacademy', 'ruangguru'];
    }

    public function index()
    {
        return view('pages.home.index');
    }

    public function checkIfEligible(
        SubmitSubmissionRequest $request,
        RuangguruApiRepository $ruangguruApiRepository
    ) {
        $validated = $request->validated();
        $userId = $validated['userId'];

        $response = Cache::remember('userID-'.$userId, 60, function () use ($userId, $ruangguruApiRepository) {
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

            foreach($packages as $package) {
                if(in_array($package['packageTag'], $this->eligibleMapping)) {
                    if($package['orderStatus'] == 'SUCCEED') {
                        $isEligible = 1;
                    }
                }
            }

            return response()->json([
                'user' => $user,
                'isEligible' => $isEligible
            ], 200);
        });

        return $response;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitSubmissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    protected string $apiUrl;
    protected array $eligibleMapping;

    public function __construct()
    {
        $this->apiUrl = 'https://us-central1-silicon-airlock-153323.cloudfunctions.net/rg-package-dummy';
        $this->eligibleMapping = ['englishacademy', 'skillacademy', 'ruangguru'];
    }

    public function index()
    {
        return view('pages.home.index');
    }

    public function checkIfEligible(SubmitSubmissionRequest $request)
    {
        $validated = $request->validated();
        $userId = $validated['userId'];

        $response = Cache::remember('userID-'.$userId, 60, function () use ($userId) {
            $data = Http::get($this->apiUrl, ['userId' => $userId]);
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
                    $isEligible = 1;
                }
            }

            return response()->json([
                'user' => $user,
                'isEligible' => 0
            ], 200);
        });

        return $response;
    }
}

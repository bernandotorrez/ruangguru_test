<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\Http;

class RuangguruApiRepository
{
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = 'https://us-central1-silicon-airlock-153323.cloudfunctions.net/rg-package-dummy';
    }

    public function getByUserId(string $userId)
    {
        $data = Http::get($this->apiUrl, ['userId' => $userId])->json();

        return $data;
    }

}

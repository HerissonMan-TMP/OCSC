<?php

namespace App\Services\TruckersMPAPI;

use Illuminate\Support\Facades\Http;
use function Symfony\Component\Translation\t;

class Request
{
    /**
     * The API endpoint URL to retrieve the data.
     */
    private const API_ENDPOINT = 'api.truckersmp.com';

    /**
     * The version of the API to use.
     */
    private const API_VERSION = 'v2';

    /**
     * The endpoint of the request.
     *
     * @var string
     */
    protected $endpoint = '';

    public function get()
    {
        $response = Http::get('https://' . self::API_ENDPOINT . '/' . self::API_VERSION . '/' . $this->endpoint);

        if ($response['error'] === true) {
            dd('https://' . self::API_ENDPOINT . '/' . self::API_VERSION . '/' . $this->endpoint);
            $response->throw();
        }

        return $response->json();
    }
}

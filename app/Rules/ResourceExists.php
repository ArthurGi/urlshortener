<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 18.08.2019
 * Time: 15:09
 */

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ResourceExists implements Rule
{
    public function passes($attribute, $value)
    {
        $statusCode = $this->checkResource($value);
        if ($statusCode && $statusCode == 200) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return ':attribute doesn\'t exist in web';
    }

    public function checkResource(string $url)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url);
            return $response->getStatusCode();
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            Log::Warning('guzzle_connect_exception', [
                'url' => $url,
                'message' => $e->getMessage()
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::Warning('guzzle_connection_timeout', [
                'url' => $url,
                'message' => $e->getMessage()
            ]);
        }
        return false;
    }
}
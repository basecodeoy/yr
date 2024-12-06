<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Yr\Weather;

use BaseCodeOy\Yr\Weather\Data\Response;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final readonly class Client
{
    private PendingRequest $pendingRequest;

    public function __construct()
    {
        $this->pendingRequest = Http::baseUrl('https://api.met.no/weatherapi/locationforecast/2.0/')
            ->withUserAgent('Laravel/Yr-Weather-Client')
            ->throw();
    }

    public function compact(float $lat, float $lon): Response
    {
        return $this->request('compact', $lat, $lon);
    }

    public function complete(float $lat, float $lon): Response
    {
        return $this->request('complete', $lat, $lon);
    }

    private function request(string $method, float $lat, float $lon): Response
    {
        return Response::fromResponse(
            $this->pendingRequest->get($method, [
                'lat' => $lat,
                'lon' => $lon,
            ])->json(),
        );
    }
}

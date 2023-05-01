<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Weather;

use BombenProdukt\Yr\Weather\Data\Response;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final readonly class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.met.no/weatherapi/locationforecast/2.0/')
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
            $this->client->get($method, [
                'lat' => $lat,
                'lon' => $lon,
            ])->json(),
        );
    }
}

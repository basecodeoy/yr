<?php

declare(strict_types=1);

namespace BombenProdukt\Yr\Location;

use BombenProdukt\Yr\Location\Data\Response;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final readonly class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://www.yr.no/api/v0/locations')
            ->withUserAgent('Laravel/Yr-Location-Client')
            ->throw();
    }

    public function get(string $location, string $language = 'en'): Response
    {
        return $this->request($location, ['language' => $language]);
    }

    public function forecast(string $location): Response
    {
        return $this->request("{$location}/forecast");
    }

    public function currentHour(string $location): Response
    {
        return $this->request("{$location}/forecast/currenthour");
    }

    public function celestialEvents(string $location): Response
    {
        return $this->request("{$location}/celestialevents");
    }

    public function suggest(string $query, string $language = 'en'): Response
    {
        return $this->request('suggest', ['q' => $query, 'language' => $language]);
    }

    private function request(string $path, array $query = []): Response
    {
        return Response::fromResponse($this->client->get($path, $query)->json());
    }
}

<?php

declare(strict_types=1);

namespace BaseCodeOy\Yr\Location;

use BaseCodeOy\Yr\Location\Data\CelestialEvents\Response as CelestialEventsResponse;
use BaseCodeOy\Yr\Location\Data\CurrentHour\Response as CurrentHourResponse;
use BaseCodeOy\Yr\Location\Data\Forecast\Response as ForecastResponse;
use BaseCodeOy\Yr\Location\Data\Location\Response as LocationResponse;
use BaseCodeOy\Yr\Location\Data\Suggest\Response as SuggestResponse;
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

    public function info(string $location, string $language = 'en'): LocationResponse
    {
        return LocationResponse::fromResponse(
            $this->request($location, ['language' => $language]),
        );
    }

    public function forecast(string $location): ForecastResponse
    {
        return ForecastResponse::fromResponse(
            $this->request("{$location}/forecast"),
        );
    }

    public function currentHour(string $location): CurrentHourResponse
    {
        return CurrentHourResponse::fromResponse(
            $this->request("{$location}/forecast/currenthour"),
        );
    }

    public function celestialEvents(string $location): CelestialEventsResponse
    {
        return CelestialEventsResponse::fromResponse(
            $this->request("{$location}/celestialevents"),
        );
    }

    public function suggest(string $query, string $language = 'en'): SuggestResponse
    {
        return SuggestResponse::fromResponse(
            $this->request('suggest', ['q' => $query, 'language' => $language]),
        );
    }

    private function request(string $path, array $query = []): array
    {
        return $this->client->get($path, $query)->json();
    }
}

<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
    private PendingRequest $pendingRequest;

    public function __construct()
    {
        $this->pendingRequest = Http::baseUrl('https://www.yr.no/api/v0/locations')
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
            $this->request($location.'/forecast'),
        );
    }

    public function currentHour(string $location): CurrentHourResponse
    {
        return CurrentHourResponse::fromResponse(
            $this->request($location.'/forecast/currenthour'),
        );
    }

    public function celestialEvents(string $location): CelestialEventsResponse
    {
        return CelestialEventsResponse::fromResponse(
            $this->request($location.'/celestialevents'),
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
        return $this->pendingRequest->get($path, $query)->json();
    }
}

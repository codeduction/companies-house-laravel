<?php

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;

class PersonSignificantControl extends DataTransferObject
{
    public null|string $countryOfResidence;
    public null|string $etag;
    public null|Carbon $notifiedOn;
    public null|string $name;
    public null|DateOfBirth $dateOfBirth;
    public null|string $kind;
    public null|string $individualId;
    public null|array $naturesOfControl;
    public null|array $nameElements;
    public null|Address $address;

    /**
     * Hydrate Person of Significant Control
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            countryOfResidence: $item['country_of_residence'],
            etag: $item['etag'],
            notifiedOn: isset($item['notified_on'])
                ? Carbon::parse($item['notified_on'])
                : null,
            name: $item['name'],
            dateOfBirth: DateOfBirth::hydrate(
                item: $item['date_of_birth'] ?? null,
            ),
            kind: $item['kind'],
            individualId: static::getIndividualIdFromLinks($item['links']),
            naturesOfControl: $item['natures_of_control'],
            nameElements: $item['name_elements'],
            address: isset($item['address']) ? Address::hydrate(
                item: $item['address'],
            ) : null,
        );
    }

    /**
     * Get an Individual ID from the Links array
     *
     * @param array $links
     *
     * return string
     */
    public static function getIndividualIdFromLinks(array $links): string
    {
        return Str::after(
            subject: $links['self'],
            search: 'individual/',
        );
    }
}

<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Actions\PersonSignificantControl;

use JustSteveKing\CompaniesHouse\DTO\Officer;
use JustSteveKing\CompaniesHouse\DTO\PersonSignificantControl;

class CreatePersonSignificantControl
{
    /**
     * Handle the creation of a Person of Significant Control
     *
     * @param Response $response
     *
     * @return PersonSignificantControl
     */
    public function handle(array $item): PersonSignificantControl
    {
        return PersonSignificantControl::hydrate(
            item: $item,
        );
    }
}

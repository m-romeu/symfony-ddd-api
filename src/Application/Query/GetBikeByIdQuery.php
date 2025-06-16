<?php

declare(strict_types=1);

namespace App\Application\Query;


class GetBikeByIdQuery
{
    public function __construct(
        private readonly int $id,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }
}

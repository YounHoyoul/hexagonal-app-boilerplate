<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Application\Get;

use Src\Shared\Domain\Bus\Query\QueryInterface;
use Src\Shared\Domain\Criteria\Criteria;

final class GetUserByCriteriaQuery implements QueryInterface
{
    public function __construct(
        public readonly Criteria $criteria
    ) {
    }
}

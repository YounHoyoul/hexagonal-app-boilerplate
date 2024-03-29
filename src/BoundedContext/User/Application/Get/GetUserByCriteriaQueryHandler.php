<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Application\Get;

use Src\BoundedContext\User\Application\UserResponse;
use Src\BoundedContext\User\Domain\Actions\FindUserByCriteriaAction;
use Src\Shared\Domain\Bus\Query\QueryHandlerInterface;

final class GetUserByCriteriaQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly FindUserByCriteriaAction $action
    ) {
    }

    public function __invoke(GetUserByCriteriaQuery $query): UserResponse
    {
        $user = $this->action->__invoke(
            criteria: $query->criteria
        );

        return UserResponse::fromUser($user);
    }
}

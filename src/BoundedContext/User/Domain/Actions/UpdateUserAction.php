<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Domain\Actions;

use Src\BoundedContext\User\Domain\Exceptions\UserNotFound;
use Src\BoundedContext\User\Domain\Repositories\UserRepositoryInterface;
use Src\BoundedContext\User\Domain\User;
use Src\BoundedContext\User\Domain\ValueObjects\UserEmail;
use Src\BoundedContext\User\Domain\ValueObjects\UserId;
use Src\BoundedContext\User\Domain\ValueObjects\UserName;
use Src\Shared\Domain\Action\ActionValidatable;
use Src\Shared\Domain\Action\CommandAction;
use Src\Shared\Domain\Contracts\ValidationCheckContract;

final class UpdateUserAction extends CommandAction
{
    use ActionValidatable;

    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly ValidationCheckContract $validationChecker
    ) {
    }

    protected function handle(UserId $id, UserName $name, UserEmail $email): void
    {
        $user = $this->repository->find($id);

        if ($user === null) {
            throw new UserNotFound();
        }

        $user = User::fromPrimitives(
            id: $id->value(),
            email: $email->value(),
            name: $name->value()
        );

        $this->repository->update($id, $user);
    }
}

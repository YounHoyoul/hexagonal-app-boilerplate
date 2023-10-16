<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Application\Update;

use Src\BoundedContext\User\Domain\Actions\UpdateUserAction;
use Src\BoundedContext\User\Domain\ValueObjects\UserEmail;
use Src\BoundedContext\User\Domain\ValueObjects\UserId;
use Src\BoundedContext\User\Domain\ValueObjects\UserName;
use Src\BoundedContext\User\Domain\ValueObjects\UserPassword;
use Src\BoundedContext\User\Domain\ValueObjects\UserPasswordConfirmation;
use Src\Shared\Domain\Bus\Command\CommandHandlerInterface;

final class UpdateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UpdateUserAction $action
    ) {
    }

    public function __invoke(UpdateUserCommand $command): void
    {
        $this->action->__invoke(
            id: UserId::fromValue($command->id),
            name: UserName::fromValue($command->name),
            email: UserEmail::fromValue($command->email),
            password: UserPassword::fromValue($command->password),
            password_confirmation: UserPasswordConfirmation::fromValue($command->password_confirmation)
        );
    }
}

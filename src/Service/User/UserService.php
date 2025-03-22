<?php

namespace App\Service\User;

use App\Repository\UserApiRepository;
use App\DTO\UserDto;

class UserService
{
  public function __construct(private UserApiRepository $repository) {}

  public function getAll(string $query = ''): array
  {
    return $this->repository->getAll($query);
  }

  public function updateUser(UserDto $user): UserDto
  {
    // Walidacja + logika biznesowa
    if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
      throw new \InvalidArgumentException("Nieprawidłowy email");
    }

    return $this->repository->update($user);
  }
}

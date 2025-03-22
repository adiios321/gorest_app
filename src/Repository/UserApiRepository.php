<?php

namespace App\Repository;

use App\Http\GoRestApiClient;
use App\DTO\UserDto;

class UserApiRepository
{
  public function __construct(private GoRestApiClient $api) {}

  public function getAll(string $query = ''): array
  {
    $params = $query ? "?name=" . urlencode($query) : '';
    $data = $this->api->request('GET', '/users' . $params);

    return array_map(fn($item) => UserDto::fromArray($item), $data);
  }

  public function update(UserDto $user): UserDto
  {
    $data = $this->api->request('PUT', "/users/{$user->id}", [
      'json' => $user->toArray(),
    ]);

    return UserDto::fromArray($data);
  }
}

<?php

namespace App\DTO;

class UserDto
{
  public function __construct(
    public ?int $id,
    public string $name,
    public string $email,
    public string $gender,
    public string $status
  ) {}

  public static function fromArray(array $data): self
  {
    return new self(
      $data['id'] ?? null,
      $data['name'],
      $data['email'],
      $data['gender'],
      $data['status'],
    );
  }

  public function toArray(): array
  {
    return [
      'name' => $this->name,
      'email' => $this->email,
      'gender' => $this->gender,
      'status' => $this->status,
    ];
  }
}

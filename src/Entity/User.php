<?php

namespace App\Entity;

/**
 * User class represents a user entity with various attributes.
 */
class User implements EntityInterface
{
    public function __construct(
        private readonly int $id,
        private readonly string $email,
        private readonly string $name,
        private readonly string $password,
        private readonly ?int $age = null
    )
    {
    }

    /**
     * Gets the unique identifier of the user.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the name of the user.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the email address of the user.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets the hashed password of the user.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Gets the age of the user.
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * Serializes the user data to an array.
     */
    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'age' => $this->age,
        ];
    }
}

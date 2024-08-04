<?php

namespace App\Entity;

class User
{
    private int $id;
    private string $email;
    private string $name;
    private string $password;
    private ?int $age;

    public function __construct(int $id, string $email, string $name, string $password, ?int $age = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return array
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

<?php

namespace App\Entity;

/**
 * User class represents a user entity with various attributes.
 */
class User
{
    /**
     * @var int The unique identifier of the user.
     */
    private int $id;

    /**
     * @var string The email address of the user.
     */
    private string $email;

    /**
     * @var string The name of the user.
     */
    private string $name;

    /**
     * @var string The hashed password of the user.
     */
    private string $password;

    /**
     * @var int|null The age of the user, which can be null.
     */
    private ?int $age;

    /**
     * User constructor.
     *
     * @param int $id The unique identifier of the user.
     * @param string $email The email address of the user.
     * @param string $name The name of the user.
     * @param string $password The hashed password of the user.
     * @param int|null $age The age of the user, which can be null.
     */
    public function __construct(int $id, string $email, string $name, string $password, ?int $age = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->age = $age;
    }

    /**
     * Gets the unique identifier of the user.
     *
     * @return int The unique identifier of the user.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the name of the user.
     *
     * @return string The name of the user.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the email address of the user.
     *
     * @return string The email address of the user.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets the hashed password of the user.
     *
     * @return string The hashed password of the user.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Gets the age of the user.
     *
     * @return int|null The age of the user, which can be null.
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * Serializes the user data to an array.
     *
     * @return array An array containing the serialized user data.
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

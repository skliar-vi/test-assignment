<?php

namespace App\DataSource;

use App\Exception\DataSourceException;

/**
 * UserJsonDataSource class provides user data from a JSON file.
 */
class UserJsonDataSource implements UserDataSourceInterface
{
    /**
     * @var string The file path to the JSON file containing user data.
     */
    protected string $filePath;

    /**
     * UserJsonDataSource constructor.
     *
     * @param string $filePath The path to the JSON file containing user data.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Retrieves all users from the JSON file.
     *
     * @return array An array of all users.
     * @throws DataSourceException If the file cannot be read or contains invalid JSON.
     */
    public function getAll(): array
    {
        return $this->getFromFile();
    }

    /**
     * Finds a user by specific criteria in the JSON file.
     *
     * @param array $criteria The criteria to search for the user.
     * @return array|null An array representing the user data if found, null otherwise.
     * @throws DataSourceException If the file cannot be read or contains invalid JSON.
     */
    public function findOne(array $criteria): ?array
    {
        $rawUsers = $this->getAll();

        foreach ($rawUsers as $rawUser) {
            $found = true;

            foreach ($criteria as $field => $value) {
                if ($rawUser[$field] !== $value) {
                    $found = false;
                    break;
                }
            }

            if ($found) {
                return $rawUser;
            }
        }

        return null;
    }

    /**
     * Retrieves user data from the JSON file.
     *
     * @return array An array of user data from the JSON file.
     * @throws DataSourceException If the file cannot be read or contains invalid JSON.
     */
    private function getFromFile(): array
    {
        if (!file_exists($this->filePath)) {
            throw new DataSourceException('File not found');
        }

        $result = json_decode(file_get_contents($this->filePath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DataSourceException('Invalid JSON');
        }

        return $result;
    }
}

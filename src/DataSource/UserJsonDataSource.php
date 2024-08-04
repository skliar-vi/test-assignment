<?php

namespace App\DataSource;

use App\Exception\DataSourceException;

class UserJsonDataSource implements UserDataSourceInterface
{
    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return array
     * @throws DataSourceException
     */
    public function getAll(): array
    {
        return $this->getFromFile();
    }

    /**
     * @param array $criteria
     * @return array|null
     * @throws DataSourceException
     */
    public function findOne(array $criteria): ?array
    {
        $rawUsers = $this->getAll();

        foreach ($rawUsers as $key => $rawUser) {
            $found = true;

            foreach ($criteria as $field => $value) {
                if ($rawUser[$field] !== $value) {
                    $found = false;
                    break;
                }
            }

            if (!$found) {
                continue;
            }

            return $rawUser;
        }

        return null;
    }

    /**
     * @return array
     * @throws DataSourceException
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

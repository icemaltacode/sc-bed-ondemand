<?php
namespace com\icemalta\todopal\model;

use \PDO;
use \JsonSerializable;
use com\icemalta\todopal\model\DBConnect;

class AccessToken implements JsonSerializable
{

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
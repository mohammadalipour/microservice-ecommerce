<?php
// src/Messenger/Message/SearchMessage.php
namespace App\Messenger\Message;

class SearchMessage
{
    private string $query;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    public function getQuery(): string
    {
        return $this->query;
    }
}

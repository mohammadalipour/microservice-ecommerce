<?php
namespace App\Messenger\Handler;

use App\Messenger\Message\SearchMessage;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class SearchMessageHandler
{

    public function __construct()
    {
    }
    public function __invoke(SearchMessage $message)
    {
        return;
    }
}

<?php

namespace app\Handlers;

use app\Interfaces\DBConnectionInterface;

class ImageHandler extends RequestHandler
{
    public function handle(DBConnectionInterface $connection): void
    {
 /*       $connection->log(
            [
                'ip_address' => $this->getRequestIP(),
                'user_agent' => $this->getUserAgent(),
                'page_url' => $this->getPageUrl()
            ]
        );*/
        $this->sendRandom();
    }

    /**
     * @return void
     */
    private function sendRandom(): void
    {

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(['value' => rand(1,4)]);

    }

}

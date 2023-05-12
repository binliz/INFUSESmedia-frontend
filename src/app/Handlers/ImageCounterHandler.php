<?php

namespace app\Handlers;

use app\Interfaces\DBConnectionInterface;

class ImageCounterHandler extends RequestHandler
{
    public function handle(DBConnectionInterface $connection): void
    {
        if ($this->isPost()) {
            $connection->log(
                [
                    'ip_address' => $this->getRequestIP(),
                    'user_agent' => $this->getUserAgent(),
                    'image_mark' => $this->getParam('imageId')
                ]
            );

            return;
        }
        $count = $connection->getLogCount([
                                              'ip_address' => $this->getRequestIP(),
                                              'user_agent' => $this->getUserAgent(),
                                              'image_mark' => $this->getParam('imageId')
                                          ]);
        $this->sendLogCount($count ?? 0);
    }

    /**
     * @return void
     */
    private function sendLogCount(int $value): void
    {
        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(['value' => $value]);
    }

}

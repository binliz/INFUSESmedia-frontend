<?php

namespace app\Interfaces;

interface DBConnectionInterface
{

    public function log(array $data);

    public function getLogCount(array $filter): ?int;
}

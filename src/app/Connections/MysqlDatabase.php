<?php

namespace app\Connections;

use app\Interfaces\DBConnectionInterface;

class MysqlDatabase implements DBConnectionInterface
{
    protected \PDO $db;

    public function connect($config)
    {
        $this->db = new \PDO(
            $config['dsn'], $config['user'], $config['password']
        );
    }

    public function log(array $data): void
    {
        if (!$this->validate($data)) {
            return;
        }

        $sql = 'INSERT INTO `logs` (`ip_address`,`user_agent`,`image_mark`) VALUES (:ip_address,:user_agent,:image_mark)' .
            ' ON DUPLICATE KEY UPDATE `views_count`=`views_count`+1 ';

        $sth = $this->db->prepare($sql);
        $sth->bindParam('ip_address', $data['ip_address']); // In real case i will be use inet_pton
        $sth->bindParam('user_agent', $data['user_agent']);
        $sth->bindParam('image_mark', $data['image_mark']);
        $sth->execute();

    }

    public function getLogCount(array $filter): ?int
    {

        if (!$this->validate($filter)) {
            return null;
        }

        $sql = 'SELECT `views_count` FROM `logs` WHERE ip_address=:ip_address AND user_agent=:user_agent AND image_mark=:image_mark';
        $sth = $this->db->prepare($sql);
        $sth->bindParam('ip_address', $filter['ip_address']); // In real case i will be use inet_pton
        $sth->bindParam('user_agent', $filter['user_agent']);
        $sth->bindParam('image_mark', $filter['image_mark'], \PDO::PARAM_INT);
        if ($sth->execute()) {
            return $sth->fetchColumn();
        }
        return null;
    }

    private function validate(array $data): bool
    {
        if (count(array_intersect_key($data, array_flip(['ip_address', 'user_agent', 'image_mark']))) !== 3) {
            // LOG to Errors or throw
            return false;
        }

        if (empty($data['ip_address'])) {
            // LOG to Errors or throw
            return false;
        }
        if (empty($data['user_agent'])) {
            // LOG to Errors or throw
            return false;
        }
        if (empty($data['image_mark'])) {
            // LOG to Errors or throw
            return false;
        }

        return true;
    }
}

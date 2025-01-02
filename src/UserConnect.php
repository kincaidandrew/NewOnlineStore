<?php 

    require_once '../config/config.php'; //access the login values

    try {
        //var_dump($dsn, $username, $password, $options);
        $connection = new PDO($dsn, $username, $password, $options);

        // echo 'DB connected';

    } catch (\PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
?>
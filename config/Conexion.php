<?php


class Conexion extends PDO
{
    private $host = 'localhost';
    private $dbname = 'ws-yt';
    private $user = '';
    private $pass = '';

    public function __construct()
    {
        try {
            parent::__construct('mysql:host=' . $this->host . ';dbname=' . $this->dbname .
                ';charset=utf8', $this->user, $this->pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        }
        catch (PDOException $e)
        {
            echo 'Error: ' . $e->getMessage();
            exit;
        }
    }
}
<?php

class Database {
    private  $driver;
    private $host;
    private $dbname;
    private $username;

    private $conn;

    function __construct()
    {
        $this->driver = "mysql";
        $this->host = "localhost";
        $this->dbname = "aluco_parking";
        $this->username = "root";
    }

    function getConexao(){
        try{
            $this->conn = new PDO(
               "{$this->driver}:host={$this->host};dbname={$this->dbname}",
                $this->username
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

            return $this->conn;

        } catch(Exception $e){

            error_log($e->getMessage(), 3, 'error_log.txt'); // Salva o erro em um arquivo de log
            die("Erro ao conectar ao banco de dados. Tente novamente mais tarde.");
            
        }
    }


}

?>
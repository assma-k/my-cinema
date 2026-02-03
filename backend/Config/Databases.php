<?php
class Databases
{
    private $config;
    private $pdo;

    public function Connexion()
    {
        if ($this->pdo === null) {

            try {
                $this->config = parse_ini_file(__DIR__."/config.ini");
                $this->pdo = new PDO("mysql:host={$this->config['servername']};dbname={$this->config['dbname']}", $this->config["username"], $this->config["password"]);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set msg si erreur grace exception
            } catch (PDOException $e) {
                echo "Connection raté: " . $e->getMessage();
            };
        }
        return $this->pdo;
    }
}

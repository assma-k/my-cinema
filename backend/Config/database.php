<?php
class Databases
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "TonMotDePasseIci";
    private $dbname = "cinema";
    private $pdo;

    public function Connexion()
    {
        if ($this->pdo === null) {

            try {
                $this->pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// set msg si erreur grace exception
                echo "Connection reussie";
            } catch (PDOException $e) {
                echo "Connection raté: " . $e->getMessage();
            };
        }
        return $this->pdo;
    }
}

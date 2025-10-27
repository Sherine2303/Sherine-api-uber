<?php
    class ClientsModel
    {
        private $pdo;

        public function __construct()
        {
            try {
                $this->pdo = new PDO("mysql:host=localhost;dbname=bruno_uber;charset=utf8", "root", "");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        public function getDBAllClients()
        {
            $stmt = $this->pdo->query("SELECT * FROM client");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getDBClientsByID($idClients)
        {
            $req = "
                SELECT * FROM Client
                WHERE client_id = :idClient
            ";
            $stmt = $this->pdo->prepare($req);
            $stmt -> bindValue(":idClient",$idClients, PDO::PARAM_INT);
            $stmt -> execute();
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        }
        public function getDBChauffeurByIdVoiture ($idChauffeurs)
        { 
            $req = "
                SELECT * FROM voiture
                WHERE chauffeur_id = :idChauffeurs 
            ";
            $stmt = $this->pdo->prepare($req); $stmt->bindValue(":idChauffeurs", $idChauffeurs, PDO::PARAM_INT);
            $stmt->execute(); $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $voitures; 
        } 
    }
    //$clientsModel = new ClientsModel(); 
    //print_r($clientsModel->getDBAllClients());
?>

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
        public function createDBClient($data){
            $req = "INSERT INTO client (client_id,client_nom,client_telephone)
                VALUES (:client_id, :client_nom, :client_telephone)";
            $stmt =$this->pdo->prepare($req);
            $stmt->bindParam(":client_id",$data['client_id'], PDO::PARAM_INT);
            $stmt->bindParam(":client_nom",$data['client_nom'], PDO::PARAM_STR);
            $stmt->bindParam(":client_telephone",$data['client_telephone'], PDO::PARAM_INT);
            $stmt->execute();
            $client = $this-> getDBclientsByID($data['client_id']);
            return $client;
        }
        public function updateDBClient ($id,$data){
            $req = "UPDATE client
                    SET client_id= :client_id, client_nom= :client_nom, client_telephone= :client_telephone
                    WHERE client_id= :id";
            $stmt = $this->pdo->prepare($req);

            $stmt->bindParam(":client_id",$data['client_id'], PDO::PARAM_INT);
            $stmt->bindParam(":client_nom",$data['client_nom'], PDO::PARAM_STR);
            $stmt->bindParam(":client_telephone",$data['client_telephone'], PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            //verifie si une ligne a été modifiée 
            return $stmt->rowCount()>0;
        }
    }
    //$clientsModel = new ClientsModel(); 
    //print_r($clientsModel->getDBAllClients());
?>

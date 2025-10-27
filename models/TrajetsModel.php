<?php
    class TrajetsModel
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

        public function getDBAllTrajets()
        {
            $stmt = $this->pdo->query("SELECT * FROM trajet");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getDBTrajetsByID($idTrajets)
        {
            $req = "
                SELECT * FROM Trajet
                WHERE trajet_id = :idTrajet
            ";
            $stmt = $this->pdo->prepare($req);
            $stmt -> bindValue(":idTrajet",$idTrajets, PDO::PARAM_INT);
            $stmt -> execute();
            $Trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $Trajets;
        }
        public function getDBTrajetByIdDetail ($idTrajets) {
        $req = "
            SELECT trajet.trajet_id, chauffeur.chauffeur_nom, client.client_nom FROM trajet
            INNER JOIN chauffeur
            ON trajet.trajet_id = chauffeur.chauffeur_id
            INNER JOIN possede
            ON trajet.trajet_id = possede.trajet_id
            INNER JOIN client
            ON possede.client_id = client.client_id
            WHERE trajet.trajet_id = :idTrajets
        ";
        $stmt = $this->pdo->prepare($req);
        $stmt->bindValue(":idTrajets", $idTrajets, PDO::PARAM_INT);
        $stmt->execute();
        $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $trajets;
        }
    }
    //$trajetsModel = new TrajetsModel(); 
    //print_r($trajetsModel->getDBAllTrajets());
?>

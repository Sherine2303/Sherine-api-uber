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
    }
    //$trajetsModel = new TrajetsModel(); 
    //print_r($trajetsModel->getDBAllTrajets());
?>

<?php
require_once "models/trajetsModel.php";

class TrajetsController
{
    private $model;

    public function __construct()
    {
        $this->model = new TrajetsModel();
    }

    public function getAlltrajets()
    {
        $trajets = $this->model->getDBAllTrajets();
        echo json_encode($trajets);
    }
    public function getDBTrajetsByID($idTrajets)
    {
        $lignesTrajets = $this -> model -> getDBTrajetsByID($idTrajets);
        echo json_encode($lignesTrajets);
    }
}

//$trajetsController = new TrajetsController();
//$trajetsController->getAlltrajets();
?>
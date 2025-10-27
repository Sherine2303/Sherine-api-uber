<?php
require_once "models/voituresModel.php";

class VoituresController
{
    private $model;

    public function __construct()
    {
        $this->model = new VoituresModel();
    }

    public function getAllVoitures()
    {
        $voitures = $this->model->getDBAllVoitures();
        echo json_encode($voitures);
    }
    public function getDBVoituresByID($idVoitures)
    {
        $lignesVoitures = $this -> model -> getDBVoituresByID($idVoitures);
        echo json_encode($lignesVoitures);
    }
}

//$voituresController = new voituresController();
//$voituresController->getAllVoitures();
?>
<?php
require_once "models/ChauffeursModel.php";

class ChauffeursController
{
    private $model;

    public function __construct()
    {
        $this->model = new ChauffeursModel();
    }

    public function getAllChauffeurs()
    {
        $chauffeurs = $this->model->getDBAllChauffeurs();
        echo json_encode($chauffeurs);
    }
    public function getDBChauffeursByID($idChauffeurs)
    {
        $lignesChauffeurs = $this -> model -> getDBChauffeursByID($idChauffeurs);
        echo json_encode($lignesChauffeurs);
    }
    public function getChauffeurByIdVoiture ($idChauffeurs) {
        $lignesVoiture = $this->model->getDBChauffeurByIdVoiture($idChauffeurs);
        echo json_encode($lignesVoiture);
    }
}
//$chauffeursController = new ChauffeursController();
//$chauffeursController->getAllChauffeurs();
?>
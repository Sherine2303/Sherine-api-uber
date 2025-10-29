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
    public function createChauffeur($data){
        $ligneChauffeur = $this ->model->createDBChauffeur($data);
        http_response_code(201);
        echo json_encode($ligneChauffeur);
    }
    public function updateChauffeur($id,$data){
        $success=$this->model->updateDBChauffeur($id,$data);
        if ($success){
            http_response_code(204);
        }else{
            http_response_code(404);
            echo json_encode(["message" => "Chauffeur non trouvé non modifiée"]);
        }
    }

}
//$chauffeursController = new ChauffeursController();
//$chauffeursController->getAllChauffeurs();
?>
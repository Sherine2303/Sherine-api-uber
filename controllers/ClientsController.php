<?php
require_once "models/ClientsModel.php";

class ClientsController
{
    private $model;

    public function __construct()
    {
        $this->model = new ClientsModel();
    }

    public function getAllClients()
    {
        $clients = $this->model->getDBAllClients();
        echo json_encode($clients);
    }
    public function getDBClientsByID($idClients)
    {
        $lignesClients = $this -> model -> getDBClientsByID($idClients);
        echo json_encode($lignesClients);
    }
    public function getChauffeurByIdVoiture ($idChauffeurs)
    { 
        $lignesVoiture = $this->model->getDBChauffeurByIdVoiture($idChauffeurs);
        echo json_encode($lignesVoiture);
    }
    public function createClient($data){
        $ligneClient = $this ->model->createDBClient($data);
        http_response_code(201);
        echo json_encode($ligneClient);
    }
    public function updateClient($id,$data){
        $success=$this->model->updateDBClient($id,$data);
        if ($success){
            http_response_code(204);
        }else{
            http_response_code(404);
            echo json_encode(["message" => "Client non trouvé non modifiée"]);
        }
    }
    public function deleteClient($id){
        $success=$this->model->deleteDBClient($id);
        if ($success){
            http_response_code(204);
        }else{
            http_response_code(404);
            echo json_encode(["message" => "Client introuvable"]);
        }
    }
}
//$clientsController = new ClientsController();
//$clientsController->getAllClients();
?>
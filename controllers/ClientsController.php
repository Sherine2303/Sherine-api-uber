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
}
//$clientsController = new ClientsController();
//$clientsController->getAllClients();
?>
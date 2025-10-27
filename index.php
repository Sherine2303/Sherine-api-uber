<?php
require_once "./controllers/ChauffeursController.php";
$chauffeursController = new ChauffeursController();
require_once "./controllers/ClientsController.php";
$clientsController = new ClientsController();
require_once "./controllers/TrajetsController.php";
$trajetsController = new TrajetsController();
require_once "./controllers/VoituresController.php";
$voituresController = new VoituresController();
// Vérifie si le paramètre "page" est vide ou non présent dans l'URL
if (empty($_GET["page"])) {
    // Si le paramètre est vide, on affiche un message d'erreur
    echo "La page n'existe pas";
} else {
    // Sinon, on récupère la valeur du paramètre "page"
    // Par exemple, si l’URL est : index.php?page=chauffeurs/3
    // Alors $_GET["page"] vaut "chauffeurs/3"
    
    // On découpe cette chaîne en segments, en séparant sur le caractère "/"
    // Cela donne un tableau, ex : ["chauffeurs", "3"]
    $url = explode("/", $_GET['page']); //exploser l'url et mettre dans la 
    
    // Affiche le contenu du tableau pour vérifier comment l’URL est interprétée
    //print_r($url);

    // On teste le premier segment pour déterminer la ressource demandée
    switch($url[0]) {
        case "chauffeurs":
        if (isset($url[1])) {
            if (isset($url[2]) && $url[2] === "voitures") {
                // /chauffeurs/3/voitures
                $chauffeursController->getChauffeurByIdVoiture($url[1]);
            } else {
                // /chauffeurs/3
                $chauffeursController->getDBChauffeursById($url[1]);
            }
        } else {
            // /chauffeurs
            echo $chauffeursController->getAllChauffeurs();
        }
        break;

    case "clients":
        if (isset($url[1])) {
            $clientsController->getDBClientsById($url[1]);
        } else {
            echo $clientsController->getAllClients();
        }
        break;

    case "voitures":
        echo $voituresController->getAllVoitures();
        break;

    case "trajets":
        if (isset($url[1])) {
            if (isset($url[2]) && $url[2] === "detail") {
                // /trajets/3/detail
                $trajetsController->getTrajetByIdDetail($url[1]);
            } else {
                // /trajets/3
                $trajetsController->getDBTrajetsById($url[1]);
            }
        } else {
            // /trajets
            echo $trajetsController->getAllTrajets();
        }
        break;

    default:
        echo "La page n'existe pas";
    }
}
?>

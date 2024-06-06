<?php

use \App\Controller\AuthorsController;

include_once '../app/controllers/authorsController.php';

switch ($_GET['authors']):
    case 'show';
        AuthorsController\showAction($connexion, $_GET['id']);
        break;
    default:
        AuthorsController\indexAction($connexion);
        break;
endswitch;

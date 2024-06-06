<?php

if (isset($_GET['books'])) :
    include_once '../app/routers/books.php';

else :
    include_once '../app/controllers/pageController.php';
    \App\Controllers\pageController\homeAction($connexion);
endif;


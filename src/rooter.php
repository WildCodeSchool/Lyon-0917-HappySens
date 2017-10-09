<?php
// Check if page are in URI
if (isset($_GET['page'])) {
    $display = $_GET['page'];
} else {
    $display = "home";
}
// Check case match with the case in URI
switch ($display) {
    case 'home':
        $link = "home.php";
        break;
    case 'entreprise':
        $link = "entreprise.php";
        break;
    case 'employe':
        $link = "employe.php";
        break;
    case 'happy':
        $link = "happy_coach.php";
        break;
    case 'contact':
        $link = "contact.php";
        break;
    case 'inscription':
        $link = "inscription.php";
        break;
    case 'newProject':
        $link = "add_project.php";
        break;
    case 'recapProject':
        $link = "recap_projet.php";
        break;
    case 'profilEmploye':
        $link = "profil_employe.php";
        break;
    case 'profilEntreprise':
        $link = "profil_entreprise.php";
        break;
    case 'profilHappy':
        $link = "profil_happyCoach.php";
        break;
    case 'inscriptions':
        $link = "inscription.php";
        break;
    default:
        $link = "home.php";
        break;
}
require "public/includes/pages/$link";

?>
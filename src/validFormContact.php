<?php

session_start();

//create array for stock error
$errors = [];

//regex
$regexPhone = "/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/";


if (!array_key_exists('first_name', $_POST) || $_POST['first_name'] == '') {// on verifie l'existence du champ et d'un contenu
    $errors['first_name'] = "Merci de mettre un prénom valide (ex : Pierre)";
}

if (!array_key_exists('last_name', $_POST) || $_POST['last_name'] == '') {// on verifie l'existence du champ et d'un contenu
    $errors['last_name'] = "Merci de mettre un nom valide (ex : Dupont)";
}

if (!array_key_exists('company_name', $_POST) || $_POST['company_name'] == '') {// on verifie l'existence du champ et d'un contenu
    $errors['company_name'] = "Merci de mettre un nom d'entreprise valide (ex : Happy Sens)";
}


if (!array_key_exists('email', $_POST) || $_POST['email'] == '' ) {// on verifie existence de la clé
    $errors['email'] = "Merci de mettre un email valide (ex : nom.prenom@entreprise.com)";
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {// on verifie existence de la clé
    $errors ['mail'] = "Votre email n'est pas valide (ex : nom.prenom@entreprise.com)";
}

if (!array_key_exists('phone', $_POST) || $_POST['phone'] == ''  ) {// on verifie existence de la clé
    $errors['phone'] = "Merci de mettre un n° de téléphone valide (ex : 04-00-00-00-00)";
}

if (!preg_match('/^0\d(\s|-)?(\d{2}(\s|-)?){4}$/',$_POST['phone']) ) {// on verifie existence de la clé
    $errors['phone'] = "Merci de mettre un n° de téléphone valide (ex : 04-00-00-00-00)";
}


if ($_POST['choose'] == 'choose') {
    $errors['choose'] = "Merci de choisir un sujet";


}if (!array_key_exists('content', $_POST) || $_POST['content'] == '') {
    $errors['content'] = "Merci de laisser un message";
}


//On check les infos transmises lors de la validation
if (!empty($errors)) { // si erreur on renvoie vers la pages précédente
    $_SESSION['errors'] = $errors;//on stocke les erreurs
    $_SESSION['inputs'] = $_POST;


    var_dump($errors);

} else {
    $_SESSION['inputs'] = $_POST;
}
header('Location: ../pages/contact.php');









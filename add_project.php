<!doctype html>
<html lang="en">
<head>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>HappySens</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
<link rel="stylesheet" href="public/css/style.css">
<body>


<div class="container">
    <form class="col s12">
        <div class="row">

            <h2>Proposez votre happy projet</h2>


            <div class="input-field col s3">
                <input id="project_name" type="text" class="validate">
                <label for="project_name">Nom de votre projet</label>
            </div>

            <div class="input-field col s3">
                <input id="project_location" type="text" class="validate">
                <label for="project_location">Lieu de votre projet</label>
            </div>

            <div class="input-field col s3">
                <input id="start_date" type="text" class="datepicker">
                <label for="start_date">Date de démarrage</label>
            </div>

            <div class="input-field col s3">
                <input id="end_date" type="text" class="datepicker">
                <label for="end_date">Date de fin</label>
            </div>


            <div class="input-field col s6">
                <label for="theme"></label>
                <select class="icons" id="theme" name="theme">
                    <option value="" disabled selected>Thématique</option>
                    <option value="1" data-icon="http://via.placeholder.com/50x50" class="circle">Bien-être</option>
                    <option value="2" data-icon="http://via.placeholder.com/50x50" class="circle">Bricolage</option>
                    <option value="3" data-icon="http://via.placeholder.com/50x50" class="circle">Broderie</option>
                    <option value="4" data-icon="http://via.placeholder.com/50x50" class="circle">Cause animale</option>
                    <option value="5" data-icon="http://via.placeholder.com/50x50" class="circle">Cause humanitaire
                    </option>
                    <option value="6" data-icon="http://via.placeholder.com/50x50" class="circle">Chant</option>
                    <option value="7" data-icon="http://via.placeholder.com/50x50" class="circle">Cinéma</option>
                    <option value="8" data-icon="http://via.placeholder.com/50x50" class="circle">Cirque</option>
                    <option value="9" data-icon="http://via.placeholder.com/50x50" class="circle">Collection d'objet
                    </option>
                    <option value="10" data-icon="http://via.placeholder.com/50x50" class="circle">Couture</option>
                    <option value="11" data-icon="http://via.placeholder.com/50x50" class="circle">Cuisine</option>
                    <option value="12" data-icon="http://via.placeholder.com/50x50" class="circle">Culture et jardinage
                    </option>
                    <option value="13" data-icon="http://via.placeholder.com/50x50" class="circle">Danse</option>
                    <option value="14" data-icon="http://via.placeholder.com/50x50" class="circle">Décoration</option>
                    <option value="15" data-icon="http://via.placeholder.com/50x50" class="circle">Dessin</option>
                    <option value="16" data-icon="http://via.placeholder.com/50x50" class="circle">Ecologie</option>
                    <option value="17" data-icon="http://via.placeholder.com/50x50" class="circle">Ecriture</option>
                    <option value="18" data-icon="http://via.placeholder.com/50x50" class="circle">Gastronomie</option>
                    <option value="19" data-icon="http://via.placeholder.com/50x50" class="circle">Gravure</option>
                    <option value="20" data-icon="http://via.placeholder.com/50x50" class="circle">Jeux-vidéos</option>
                    <option value="21" data-icon="http://via.placeholder.com/50x50" class="circle">Littérature</option>
                    <option value="22" data-icon="http://via.placeholder.com/50x50" class="circle">Maquettisme</option>
                    <option value="23" data-icon="http://via.placeholder.com/50x50" class="circle">Musique</option>
                    <option value="24" data-icon="http://via.placeholder.com/50x50" class="circle">Oenologie</option>
                    <option value="25" data-icon="http://via.placeholder.com/50x50" class="circle">Peinture</option>
                    <option value="26" data-icon="http://via.placeholder.com/50x50" class="circle">Photographie</option>
                    <option value="27" data-icon="http://via.placeholder.com/50x50" class="circle">Sculpture</option>
                    <option value="28" data-icon="http://via.placeholder.com/50x50" class="circle">Spectacle</option>
                    <option value="30" data-icon="http://via.placeholder.com/50x50" class="circle">Sport animalier
                    </option>
                    <option value="31" data-icon="http://via.placeholder.com/50x50" class="circle">Sport aérien</option>
                    <option value="32" data-icon="http://via.placeholder.com/50x50" class="circle">Sport collectif
                    </option>
                    <option value="33" data-icon="http://via.placeholder.com/50x50" class="circle">Sport de combat
                    <option value="34" data-icon="http://via.placeholder.com/50x50" class="circle">Sport handisport
                    <option value="35" data-icon="http://via.placeholder.com/50x50" class="circle">Sport individuel
                    </option>
                    <option value="36" data-icon="http://via.placeholder.com/50x50" class="circle">Sport mécanique
                    </option>
                    <option value="37" data-icon="http://via.placeholder.com/50x50" class="circle">Sport de montagne
                    </option>
                    <option value="38" data-icon="http://via.placeholder.com/50x50" class="circle">Sport nautique
                    </option>
                    <option value="39" data-icon="http://via.placeholder.com/50x50" class="circle">Théâtre</option>
                    <option value="40" data-icon="http://via.placeholder.com/50x50" class="circle">Tricot</option>
                </select>
            </div>


            <div class="input-field col s6">
                <label for="language"></label>
                <select id="language" name="language" multiple>
                    <option value="" disabled selected>Langues parlées (1 obligatoire, 4 optionnelles)</option>
                    <option value="1">Français</option>
                    <option value="2">Anglais</option>
                    <option value="3">Allemand</option>
                    <option value="4">Chinois</option>
                    <option value="5">Coréen</option>
                    <option value="6">Espagnol</option>
                    <option value="7">Grec</option>
                    <option value="8">Italien</option>
                    <option value="9">Japonais</option>
                    <option value="10">Polonais</option>
                    <option value="11">Portuguais</option>
                    <option value="12">Russe</option>
                </select>
            </div>


            <div class="input-field col s12">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Ecrire votre présentation du projet</label>
            </div>

            <div class="input-field col s6">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">3 avantages pour votre employeur</label>
            </div>

            <div class="input-field col s6">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">3 avantages pour le groupe de votre projet</label>
            </div>


            <div class="file-field input-field col s6">
                <div class="btn">Image
                    <input type="file">
                </div>

                <div class="file-path-wrapper">
                    <label for="image_project"></label>
                    <input class="file-path validate" type="text" id="image_project" name="image_project">
                </div>
            </div>
        </div>


        <div class="col s6">
            <div class="center">
                <a class="waves-effect waves-light btn">Retour</a>
                <a class="waves-effect waves-light btn">Envoyer</a>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="public/script/datepicker.js"></script>
<script type="text/javascript" src="public/script/app.js"></script>
</body>
</html>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>
<body>
<header>

    <nav>
        <div class="nav-wrapper white">
            <a href="#" class="brand-logo center"><span class="light-blue-text text-darken-2">Logo</span></a>
            <ul id="slide-out" class="side-nav">
                <li><div class="user-view">
                        <div class="background">
                            <img src="../../images/happysens-love.jpg">
                        </div>
                        <a href="#!user"><img class="circle" src="https://www.publicationsports.com/vProd/asset/image/component/ps/ps_single_login/user_logo.png"></a>
                        <a href="#!name"><span class="white-text name">John Doe</span></a>
                        <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
                    </div></li>

                <li><a class="subheader">Fonction : happy-officer</a></li>
                <li><div class="divider"></div></li>
                <li><a class="subheader">Subheader</a></li>
                <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
            </ul>
            <a href="#" data-activates="slide-out" class="button"><i class="material-icons light-blue-text text-darken-2">menu</i></a>
        </div>
    </nav>

</header>

<main class="container-fluid" id="main">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-5 z-depth-1">
            <div class="row valign-wrapper">
                <div class="col s2">
                    <img src= "public/images/happysens-peinture.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                </div>
                <div class="col s10">
                    <span class="black-text"><p>Titres Happy projets !<?php echo $_POST['titres']; ?></p></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l4">
                <div class="card orange lighten-5">
                    <div class="card-content red-text">
                        <span class="card-title">Titre de projet <?php echo $_POST['titre de projet']; ?></span>
                        <p>En attente de validation</p>
                    </div>
                    <div class="card-action">

                    </div>
                </div>
            </div>
            <div class="col s12 m12 l4">
                <div class="card deep-orange lighten-4">
                    <div class="card-content red-text">
                        <span class="card-title">Titre de projet <?php echo $_POST['titre de projet']; ?></span>
                        <p>En cours</p>
                    </div>
                    <div class="card-action">

                    </div>
                </div>
            </div>
            <div class="col s12 m12 l4 ">
                <div class="card amber darken-2">
                    <div class="card-content red-text">
                        <span class="card-title">Titre de projet <?php echo $_POST['titre de projet']; ?></span>
                        <p>Terminé</p>
                    </div>
                    <div class="card-action">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-panel grey lighten-5 z-depth-2">
        <div class="row valign-wrapper">
            <div class="col s10">
                   <span class="black-text">
                      <p>Nombre de projets total :</p>
                      <p>Nombre de collaborateurs engagés :</p>
                   </span>
            </div>
        </div>
    </div>
    <div class="card-panel grey lighten-5 z-depth-2">
        <div class="row valign-wrapper">
            <div class="col s6">
                    <span class="black-text">
                       <p>Les talents et spécialités déployés :</p>
                    </span>
            </div>
            <div class="col s8 m6 l4">

                    <span class="black-text">
                       <tr>
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                       </tr>
                    </span>
            </div>
            <div class="col s8 m6 l4">
                    <span class="black-text">
                       <tr>
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                       </tr>
                    </span>
            </div>
            <div class="col s8 m6 l4">
                    <span class="black-text">
                       <tr>
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                            <td><?php echo $row['']; ?>Spécialités + niveau de 1 à 4 soleils</td><br />
                       </tr>
                    </span>
            </div>
        </div>
    </div>
</main>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="public/script/app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../../script/sideNav.js"></script>
</body>
</html>
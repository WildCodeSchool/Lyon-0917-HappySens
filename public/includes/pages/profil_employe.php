<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>

    <!--  include Head  -->
    <?php require 'public/includes/structure/head.php'; ?>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#" class="waves-effect waves-light btn darken-2">Deconnexion<i class="material-icons right">person</i></a></li>

        </ul>
    </div>
</nav>




<!--  includes all required Javascript files -->
<?php require 'public/includes/structure/script.php'; ?>
</body>
</html>

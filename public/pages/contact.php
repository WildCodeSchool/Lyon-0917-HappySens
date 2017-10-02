<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Contact | HappySens</title>

    <!--  include Head  -->
    <?php //include '../includes/head.php'; ?>
</head>
<body>
<main class="col s12">
    <?php include '../includes/navbar.php'; ?>

    <!--  Jumbotron  -->
    <?php include '../includes/jumbotron.php'; ?>


    <section class="Contact">
        <div class="row">
            <?php include "../includes/textContact.php"; ?>
            <?php include "../includes/formContact.php"; ?>
        </div>
    </section>


    <!--  include button scroll to top  -->
    <?php include '../includes/goToTop.php'; ?>

    <!--  include footer  -->
    <div class="row" id="footer">
        <!--  include icons engagement  -->
        <?php include '../includes/iconsEngagement.php'; ?>

        <!--  include footer  -->
        <?php include '../includes/footer.php'; ?>
    </div>
</main>
<!--  includes all required Javascript files -->
<?php // include '../includes/script.php'; ?>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="../script/app.js"></script>
<script type="text/javascript" src="../script/scrollTop.js"></script>
</body>
</html>

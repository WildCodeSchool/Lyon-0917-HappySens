<!DOCTYPE html>
<html>
<head>

    <!--  include Head  -->
    <?php include '../includes/head.php'; ?>
</head>
<body>
<main class="col s12">


    <?php include "../includes/jumbotron.php"; ?>


    <section class="Contact">
        <div class="row">
            <?php include "../includes/textContact.php"; ?>
            <?php include "../includes/formContact.php"; ?>
        </div>
    </section>


    <!--  include button scroll to top  -->
    <?php require '../includes/goToTop.php'; ?>

    <!--  include footer  -->
    <div class="row" id="footer">
        <?php require '../includes/footer.php'; ?>
    </div>
</main>
<!--  includes all required Javascript files -->
<?php require '../includes/script.php'; ?>
</body>
</html>
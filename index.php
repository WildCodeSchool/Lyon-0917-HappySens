<!DOCTYPE html>
<html>
<head>

    <!--  include Head  -->
    <?php require './public/includes/head.php'; ?>
</head>
<body>
<main class="col s12">
    <?php require './public/includes/navbar.php'; ?>

    <!--  Jumbotron  -->
    <?php require './public/includes/jumbotron.php'; ?>
    <section class="Work">
        <?php require './public/includes/cardCategories.php'; ?>
    </section>


    <!--  include button scroll to top  -->
    <?php require './public/includes/goToTop.php'; ?>

    <!--  include footer  -->
    <div class="row" id="footer">
        <?php require './public/includes/footer.php'; ?>
    </div>
</main>
<!--  includes all required Javascript files -->
<?php require './public/includes/script.php'; ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>

    <!--  include Head  -->
    <?php require './public/includes/head.php'; ?>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/stylebloc1.css">
</head>
<body>
<main class="col s12">
    <?php require './public/includes/navbar.php'; ?>

    <!--  Jumbotron  -->
    <?php require './public/includes/jumbotron.php'; ?>
    <section class="Work">
        <?php require './public/includes/cardCategories.php'; ?>

        <section class="Rachid col s12">
            <?php require './public/includes/bloc1Concept.php'; ?>
        </section>

        <section class="Rachid col s12">
            <?php require './public/includes/shemaTexte.php'; ?>
        </section>
    <!--   Emplacement require Fantasia      -->
            <?php  require './public/includes/howItWorks.php'; ?>
    </section>

<section class="log">
    <?php require './public/includes/modalLog.php'; ?>
</section>


    <!--  include button scroll to top  -->
    <?php require './public/includes/goToTop.php'; ?>

    <!--  include footer  -->
    <div class="row" id="footer">
        <!--  include icons engagement  -->
        <?php require './public/includes/iconsEngagement.php'; ?>

        <!--  include footer  -->
        <?php require './public/includes/footer.php'; ?>
    </div>
</main>
<!--  includes all required Javascript files -->
<?php require './public/includes/script.php'; ?>

</body>
</html>

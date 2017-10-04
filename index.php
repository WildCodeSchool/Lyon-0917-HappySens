<!DOCTYPE html>
<html>
<head>

    <!--  include Head  -->
    <?php require 'public/includes/structure/head.php'; ?>
</head>
<body>
<<<<<<< HEAD
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
=======
<header id="header">
    <?php require 'public/includes/components/navbar.php'; ?>
    <!--    Modals for connection    -->
    <section class="log">
        <?php require 'public/includes/components/modalLog.php'; ?>
>>>>>>> 6bec0b6265202c0d4af7e751251db1dacfe15823
    </section>

</header>
<main class="col s12" id="main">
    <!--  rooting files  -->
    <?php require 'src/rooter.php'; ?>

    <!--  include button scroll to top !!! Don't move this link !!! -->
    <?php require 'public/includes/components/goToTop.php'; ?>
</main>
<!--  include footer  -->
<div class="s12" id="footer">
    <!--  include icons engagement  -->
    <?php require 'public/includes/components/iconsEngagement.php'; ?>

    <!--  include footer  -->
    <?php require 'public/includes/structure/footer.php'; ?>
</div>
<!--  includes all required Javascript files -->
<?php require 'public/includes/structure/script.php'; ?>

</body>
</html>

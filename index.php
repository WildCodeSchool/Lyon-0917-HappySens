<!DOCTYPE html>
<html>
<head>

    <!--  include Head  -->
    <?php require 'public/includes/structure/head.php'; ?>
</head>
<body>
<header id="header">
    <?php require 'public/includes/components/navbar.php'; ?>
    <!--    Modals for connection    -->
    <section class="log">
        <?php require 'public/includes/components/modalLog.php'; ?>
    </section>

</header>
<main class="col s12">


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

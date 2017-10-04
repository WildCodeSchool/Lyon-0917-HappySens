<!DOCTYPE html>
<html>
<head>

    <!--  include Head  -->
    <?php include '../public/includes/head.php'; ?>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<main class="col s12">

    <?php include "../public/includes/navbar.php"; ?>

    <div id="index-banner" class="parallax-container-others">
        <div class="section no-pad-bot">
            <div class="col s12">
                <div class="headerTitle left" id="headerTitle">
                    <h1 class="header left amber-text">Bienvenue sur Happy Sens</h1>
                    <div class="row">
                        <h5 class="header left white-text">Ici le slogan ou une phrase d'accroche !!!</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="log">
        <?php require '../public/includes/modalLog.php'; ?>
    </section>

    <section class="createProjet">

    </section>

    <!--  include button scroll to top  -->
    <?php require '../public/includes/goToTop.php'; ?>

    <!--  include footer  -->
    <div class="row" id="footer">
        <?php require '../public/includes/footer.php'; ?>
    </div>
</main>
<!--  includes all required Javascript files -->
<?php require '../public/includes/script.php'; ?>
</body>
</html>
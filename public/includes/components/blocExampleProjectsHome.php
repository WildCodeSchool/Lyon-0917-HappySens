<div class="col s12 m6">
    <div class="center">
        <span class="cardTitle pink-text darken-2-text">Voici quelques idées de thémes pour votre Projets :</span>
        <div class="row">
            <!--  This require import the datas array  -->
            <?php require "src/data/datasHomeProject.php";?>

            <!--  And now we can generate the cards with the values  -->
            <?php foreach ($datasHomeBottom as $datas): ?>
                <div class="col s12 m6 l4">
                    <div class="card horizontal <?php echo $datas['color']; ?> hoverable">
                        <div class="card-image">
                            <img src="<?php echo $datas['img']; ?>" class="img-responsive vignettesHome">
                        </div>
                        <div class="card-stacked">
                            <div class="card-title">
                                <p class="header white-text"><?php echo $datas['titre']; ?></p>
                            </div>
                            <div class="card-action">
                                <a href="<?php echo $datas['link']; ?>" class="amber-text">Plus de détails</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
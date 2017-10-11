<div class="valign-wrapper">
    <div class="row">
        <!--  This require import the datas array  -->
        <?php require "src/data/dataCardsCategoriesHome.php";?>

        <!--  And now we can generate the cards with the values  -->
        <?php foreach($datasCardsCategories as $data): ?>
        <div class="col s12 l4">
            <div class="card center hoverable" id="<?php echo $data['id']; ?>">
                <div class="card-content white-text">
                    <span class="cardTitle"><?php echo $data['target']; ?></span>
                    <ul class="textCard">
                        <li>
                            <?php echo $data['content']; ?>
                        </li>
                    </ul>
                </div>
                <div class="card-action">
                    <a href="<?php echo $data['link']; ?>"><span class="waves-effect waves-light btn blue-text text-darken-3 white">Je découvre HAPPY SENS</span></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
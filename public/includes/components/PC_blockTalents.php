<div class="container">
    <div class="row center-align">
        <h1 class="center-align"> Les Happy Talents </h1>
        <?php foreach ($talents as $key => $passion): ?>
            <!-- Dropdown Trigger -->
            <a class='dropdown-button btn' href='#' data-activates='<?php echo $key; ?>'><?php echo $key; ?></a>
            <ul id='<?php echo $key; ?>' class='dropdown-content'>
                <?php foreach ($passion as $talent): ?>
                    <!-- Dropdown Structure -->
                    <li><?php echo $talent; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>
</div>

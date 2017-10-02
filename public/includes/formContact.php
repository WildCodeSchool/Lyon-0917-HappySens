<?php
session_start();

?>



<form method="post"  action="../includes/validFormContact.php" class="col s6">
    <div class="row">
        <div class="col s12 ">
            <?php if (!empty($_POST)): ?>
                <?php if (array_key_exists('errors', $_SESSION)): ?>
                    <p class="text-red">Le formulaire n'a pas été envoyée : </p>
                    <?= implode('<br>', $_SESSION['errors']); ?>
                 <?php else: ?>
                     <p class="text-green">Le formulaire a été envoyé avec succés.<br>
                         Nous vous recontacterons le plus rapidement possible</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">account_circle</i>
            <input id="first_name" type="text" class="validate" name="first_name"
                   value="<?php echo isset($_SESSION['inputs']['first_name']) ? $_SESSION['inputs']['first_name'] : ""; ?>" required>
            <label for="first_name">Prénom</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">account_circle</i>
            <input id="last_name" type="text" class="validate" name="last_name"
                   value="<?php echo isset($_SESSION['inputs']['last_name']) ? $_SESSION['inputs']['last_name'] : ""; ?>" required>
            <label for="last_name">Nom</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" class="validate" name="email"
                   value="<?php echo isset($_SESSION['errors']['email']) ? "" : $_SESSION['inputs']['email']?>" required>
            <label for="email" data-error="<?php echo $_SESSION['errors']['email'] ?>" data-success="right">Email</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">phone</i>
            <input id="phone" type="tel" class="validate" name="phone"
                   value="<?php echo isset($_SESSION['errors']['phone']) ? "" : $_SESSION['inputs']['phone']?>" required>
            <label for="phone" data-error="<?php echo isset($_SESSION['errors']['phone']) ? $_SESSION['errors']['phone'] : "" ?>" data-success="right">Téléphone</label>
            <p class="invalid"><?php echo isset($_SESSION['errors']['phone']) ? $_SESSION['errors']['phone'] : "" ?></p>
        </div>
    </div>


    <div class="row">
        <div class="input-field col s6">
            <i class="material-icons prefix">domain</i>
            <input id="company_name" type="text" class="validate"  name="company_name"
                   value="<?php echo isset($_SESSION['inputs']['company_name']) ? $_SESSION['inputs']['company_name'] : ""; ?>" required>
            <label for="company_name">Entreprise</label>
        </div>

        <div class="col s12 m6">
        <label for="choose">Objet du message </label>
        <select class="browser-default" id="choose" name="choose" required>
            <option value="" disabled selected>Votre choix</option>
            <option value="1"
                <?php echo ((($_SESSION['inputs']['choose']) AND ($_SESSION['inputs']['choose']) === '1') ? "selected" : ""); ?>>Option 1</option>
            <option value="2"
                <?php echo ((($_SESSION['inputs']['choose']) AND ($_SESSION['inputs']['choose']) === '2') ? "selected" : ""); ?>>Option 2</option>
            <option value="3"
                <?php echo ((($_SESSION['inputs']['choose']) AND ($_SESSION['inputs']['choose']) === '3') ? "selected" : ""); ?>>Option 3</option>
        </select>
        </div>


    </div>

    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <textarea id="content" class="materialize-textarea" name="content" ><?php echo isset($_SESSION['errors']['content']) ? "" : $_SESSION['inputs']['content']?></textarea>
            <label for="content">Votre message :</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6 center-align">
            <button class="btn waves-effect waves-light" type="reset" name="reset">Annuler
                <i class="material-icons left">reply</i>
            </button>
        </div>
        <div class="input-field col s6 center-align">
            <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>



<?php

unset($_SESSION['inputs']);
unset($_SESSION['success']);
unset($_SESSION['errors']);

    <form class="col s6">
        <div class="row">
            <div class="input-field col s12 m6">
                <input placeholder="ex: martin" id="first_name" type="text" class="validate">
                <label for="first_name">Prénom</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="last_name" type="text" class="validate" placeholder="ex: Dupond">
                <label for="last_name">Nom</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="company_name" type="text" class="validate" placeholder="ex: Happy Sens">
                <label for="company_name">Entreprise</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="email" type="email" class="validate" placeholder="ex: prenom.nom@entreprise.com">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="email" type="email" class="validate" placeholder="ex: 04-04-04-04-04">
                <label for="email">Téléphone</label>
            </div>
        </div>
        <div class="row">

                <label for="choose">Objet du message </label>
                <select class="browser-default" id="choose">
                    <option value="" disabled selected>Votre choix</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                </select>

                <br>

        </div>

        <div class="row">
            <div class="input-field col s12">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Votre message :</label>
            </div>
        </div>


    </form>

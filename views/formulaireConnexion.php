<section style="width:100vw;height:100vh;display: flex;justify-content: space-around;align-items: center;">
        <form action="index.php" method="get" style="width: 25rem;">
            <input type="hidden" name="action" value="connecterAdherent">
            <input type="hidden" name="controleur" value="AdherentControleur">
            <fieldset class="form" style="max-width: 150%">
                <legend>
                    <h1>Se connecter</h1>
                </legend>
                <div class="relative">
                    <input type="text" name="login" id="login_id" placeholder="" required/>
                    <label for="login_id" class="placeholder">Identifiant</label>
                </div>
                <div class="relative">
                    <input type="password" name="mdp" placeholder="" id="password_id" />
                    <label for="password_id" class="placeholder">Mot de passe</label>
                </div>
                <p>
                    <input type="submit" value="Je me connecte" />
                </p>
            </fieldset>
        </form>
        <!-- inscription form -->
        <form action="index.php" method="get" style="width: 25rem;">
            <input type="hidden" name="action" value="creerCompteAdherent">
            <input type="hidden" name="controleur" value="AdherentControleur">
            <fieldset class="form" style="max-width: 150%">
                <legend>
                    <h1>S'inscrire</h1>
                </legend>
                <div class="relative">
                    <input type="text" name="login" id="logins_id" placeholder="" required/>
                    <label for="logins_id" class="placeholder">Login</label>
                </div>
                <div class="relative">
                    <input type="password" name="mdp" id="passwords_id" placeholder="" required/>
                    <label for="passwords_id" class="placeholder">Mot de passe</label>
                </div>
                <div class="relative">
                    <input type="text" name="nomAdherent" id="nom_id" placeholder="" required/>
                    <label for="nom_id" class="placeholder">Nom</label>
                </div>
                <div class="relative">
                    <input type="text" name="prenomAdherent" id="prenom_id" placeholder="" required/>
                    <label for="prenom_id" class="placeholder">Prénom</label>
                </div>
                <div class="relative">
                    <input type="email" name="email" id="email_id" placeholder="" required/>
                    <label for="email_id" class="placeholder">Adresse e-mail</label>
                </div>
                <p>
                    <input type="submit" value="Je m'inscris" />
                </p>
                <p>
                    <?= $message ?>
                </p>
            </fieldset>
</section>

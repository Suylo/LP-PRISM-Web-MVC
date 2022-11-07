<section style="width:100vw;height:100vh;display: flex;justify-content: space-around;align-items: center;">
        <form action="index.php" method="get" style="width: 25rem;">
            <input type="hidden" name="action" value="connecterAdherent">
            <input type="hidden" name="controleur" value="AdherentControleur">
            <fieldset class="form" style="max-width: 150%">
                <legend>
                    <h1>Se connecter</h1>
                </legend>
                <p>
                    <input type="text" placeholder="Identifiant..." name="login" id="login_id" required/>
                </p>
                <p>
                    <input type="password" placeholder="Mot de passe..." name="mdp" id="password_id" required/>
                </p>
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
                <p>
                    <input type="text" name="login" id="login_id" placeholder="Login..." required/>
                </p>
                <p>
                    <input type="password" name="mdp" id="password_id" placeholder="Mot de passe..." required/>
                </p>
                <p>
                    <input type="text" placeholder="Nom..." name="nomAdherent" id="nom_id" required/>
                </p>
                <p>
                    <input type="text" name="prenomAdherent" placeholder="Prénom..." id="prenom_id" required/>
                </p>
                <p>
                    <input type="email" name="email" id="email_id" placeholder="E-mail..." required/>
                </p>
                <p>
                    <input type="submit" value="Je m'inscris" />
                </p>
                <p>
                    <?= $message ?>
                </p>
            </fieldset>
</section>

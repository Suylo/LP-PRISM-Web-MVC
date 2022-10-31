<div class="form">
    <form action="index.php" method="get">
        <input type="hidden" name="action" value="connecterAdherent">
        <input type="hidden" name="controleur" value="AdherentControleur">
        <fieldset class="form" style="max-width: 150%">
            <legend>
                <h1>Se connecter</h1>
            </legend>
            <p>
                <label for="login_id">Login :&nbsp;</label>
                <input type="text" name="login" id="login_id" required/>
            </p>
            <p>
                <label for="password_id">Mot de passe :&nbsp;</label>
                <input type="password" name="password" id="password_id" required/>
            </p>
            <p>
                <input type="submit" value="Je me connecte" />
            </p>
        </fieldset>
</div>
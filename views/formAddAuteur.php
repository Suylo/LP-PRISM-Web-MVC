<div class="form">
    <!-- add auteur -->
    <form action="routeur.php" method="post">
        <input type="hidden" name="action" value="addAuteur">
        <input type="hidden" name="controller" value="auteur">
        <fieldset class="form" style="max-width: 150%">
            <legend>
                <h1><?= $titre ?></h1>
            </legend>
            <p>
                <label for="nomAuteur_id">Nom de l'auteur</label> :
                <input type="text" placeholder="Ex : Jean" name="nomAuteur" id="nomAuteur_id" required/>
            </p>
            <p>
                <label for="prenomAuteur_id">Prénom de l'auteur</label> :
                <input type="text" placeholder="Ex : Dupont" name="prenomAuteur" id="prenomAuteur_id" required/>
            </p>
            <p>
                <label for="dateNaissanceAuteur_id">Date de naissance de l'auteur</label> :
                <input type="date" name="dateNaissanceAuteur" id="dateNaissanceAuteur_id" required/>
            </p>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset>
</div>
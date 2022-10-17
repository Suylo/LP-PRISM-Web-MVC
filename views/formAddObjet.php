<div class="form">
    <form action="routeur.php" method="get">
        <input type="hidden" name="action" value="creer<?= static::$objet ?>">
        <input type="hidden" name="controleur" value="<?= static::$objet ?>Controleur">
        <fieldset class="form" style="max-width: 150%">
            <legend>
                <h1><?= $titre ?></h1>
            </legend>
            <?php foreach ($fields as $field => $val): ?>
                <p>
                    <label for="<?= $field ?>_id"><?= $val[0] ?> : </label>
                    <input type="<?= $val[1] ?>" name="<?= $field ?>" id="<?= $field ?>_id" required/>
                </p>
            <?php endforeach;?>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset>
</div>
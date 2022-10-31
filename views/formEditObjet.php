<div class="form">
    <form action="index.php" method="get">
        <input type="hidden" name="action" value="modifier<?= static::$objet ?>">
        <input type="hidden" name="controleur" value="<?= static::$objet ?>Controleur">
        <input type="hidden" name="<?= static::$cle ?>" value="<?= $objet->get(static::$cle); ?>">
        <fieldset class="form" style="max-width: 150%">
            <legend>
                <h1><?= $titre ?></h1>
            </legend>
            <?php foreach ($fields as $field => $val): ?>
                <p>
                    <label for="<?= $field ?>_id"><?= $val[0] ?> :&nbsp;</label>
                    <input type="<?= $val[1] ?>" name="<?= $field ?>" id="<?= $field ?>_id" value="<?= $objet->get("$field"); ?>" required/>
                </p>
            <?php endforeach;?>
            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset>

</div>
<div class="form">
    <form action="index.php" method="get">
        <input type="hidden" name="action" value="creerObjet">
        <input type="hidden" name="controleur" value="<?= static::$objet ?>Controleur">
        <fieldset class="form" style="max-width: 150%">
            <legend>
                <h1><?= $titre ?></h1>
            </legend>
            <?php foreach ($fields as $field => $val): ?>
                <div class="relative">
                    <input type="<?= $val[1] ?>" name="<?= $field ?>" id="<?= $field ?>_id" placeholder="" required/>
                    <label for="<?= $field ?>_id" class="placeholder"><?= $val[0] ?></label>
                </div>
            <?php endforeach; ?>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
        </fieldset>
</div>
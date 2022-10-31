<div class="form">
    <h1><?= $titre ?></h1>
    <?php
    foreach ($tableauAffichage as $ligne) {
        echo $ligne;
    } ?>
</div>



<div id="modal__msg">
    <div class="modal__msg__content">
        <div class="modal__msg__header">
            <h2>Message</h2>
        </div>
        <div class="modal__msg__body">
            <p><?= $_GET['msg'] ?></p>
        </div>
        <div class="modal__msg__footer">
            <button class="btn btn--primary" onclick="window.location.href='index.php?controleur=<?= static::$objet?>Controleur&action=lireObjets'">OK</button>
        </div>
    </div>
</div>
<nav class="default_menu">
    <ul>
        <li>
        <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "AuteurControleur") {?>
                <a href="index.php?controleur=AuteurControleur&action=lireObjets" class="--active hover">
                    <i class="bi-book"></i>&nbsp;&nbsp;Auteurs</a>
            <?php } else {?>
                <a href="index.php?controleur=AuteurControleur&action=lireObjets" class="hover">
                    <i class="bi-book"></i>&nbsp;&nbsp;Auteurs</a>
            <?php }?>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "LivreControleur") {?>
                <a href="index.php?controleur=LivreControleur&action=lireObjets" class="--active hover">
                    <i class="bi-files"></i>&nbsp;&nbsp;Livres</a>
            <?php } else { ?>
                <a href="index.php?controleur=LivreControleur&action=lireObjets" class="hover">
                    <i class="bi-files"></i>&nbsp;&nbsp;Livres</a>
            <?php } ?>
        </li>
        <?php if(Session::userConnected()) { ?>
            <li>
                <a href="#">
                    <strong>Bienvenue M. <?php echo Session::getUserLogged() ?></strong>
                </a>
                <ul class="dropdown">
                    <li>
                        <a href="index.php?controleur=AdherentControleur&action=logout">
                            <i class="bi-person-plus"></i>&nbsp;Se déconnecter
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>
</nav>

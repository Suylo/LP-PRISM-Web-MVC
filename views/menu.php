<nav>
    <ul>
        <li>
        <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "AuteurControleur") {?>
                <a href="index.php?controleur=AuteurControleur&action=lireObjets" class="--active hover">
                    <i class="bi-book"></i>&nbsp;&nbsp;Auteurs</a>
            <?php } else {?>
                <a href="index.php?controleur=AuteurControleur&action=lireObjets" class="hover">
                    <i class="bi-book"></i>&nbsp;&nbsp;Auteurs</a>
            <?php }?>
            <ul class="dropdown">
                <li>
                    <a href="index.php?controleur=AuteurControleur&action=addObjet">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
            </ul>
        </li>
        <li>
        <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "AdherentControleur") {?>
                <a href="index.php?controleur=AdherentControleur&action=lireObjets" class="--active hover">
                    <i class="bi-person"></i>&nbsp;&nbsp;Adhérents</a>
            <?php } else { ?>
                <a href="index.php?controleur=AdherentControleur&action=lireObjets" class="hover">
                    <i class="bi-person"></i>&nbsp;&nbsp;Adhérents</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="index.php?controleur=AdherentControleur&action=addObjet">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "LivreControleur") {?>
                <a href="index.php?controleur=LivreControleur&action=lireObjets" class="--active hover">
                    <i class="bi-files"></i>&nbsp;&nbsp;Livres</a>
            <?php } else { ?>
                <a href="index.php?controleur=LivreControleur&action=lireObjets" class="hover">
                    <i class="bi-files"></i>&nbsp;&nbsp;Livres</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="index.php?controleur=LivreControleur&action=addObjet">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "GenreControleur") {?>
                <a href="index.php?controleur=GenreControleur&action=lireObjets" class="--active hover">
                        <i class="bi-tag"></i>&nbsp;&nbsp;Genres</a>
                <?php } else { ?>
                    <a href="index.php?controleur=GenreControleur&action=lireObjets" class="hover">
                        <i class="bi-tag"></i>&nbsp;&nbsp;Genres</a>
                <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="index.php?controleur=GenreControleur&action=addObjet">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "CategorieControleur") {?>
                <a href="index.php?controleur=CategorieControleur&action=lireObjets" class="--active hover">
                    <i class="bi-tags"></i>&nbsp;&nbsp;Catégories</a>
            <?php } else { ?>
                <a href="index.php?controleur=CategorieControleur&action=lireObjets" class="hover">
                    <i class="bi-tags"></i>&nbsp;&nbsp;Catégories</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="index.php?controleur=CategorieControleur&action=addObjet">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "NationaliteControleur") {?>
                <a href="index.php?controleur=NationaliteControleur&action=lireObjets" class="--active hover">
                    <i class="bi-flag"></i>&nbsp;&nbsp;Nationalités</a>
            <?php } else { ?>
                <a href="index.php?controleur=NationaliteControleur&action=lireObjets" class="hover">
                    <i class="bi-flag"></i>&nbsp;&nbsp;Nationalités</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="index.php?controleur=NationaliteControleur&action=addObjet">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if(Session::userConnected()) { ?>
            <a href="index.php?controleur=AdherentControleur&action=logout" class="login_button">
                <i class="bi-box-arrow-in-right"></i>&nbsp;&nbsp;Se déconnecter
            </a>
            <?php } ?>
        </li>
    </ul>
</nav>

<nav>
    <ul>
        <li>
        <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "AuteurControleur") {?>
                <a href="routeur.php?controleur=AuteurControleur&action=lireObjets" class="--active hover">
                    <i class="bi-book"></i>&nbsp;&nbsp;Auteurs</a>
            <?php } else {?>
                <a href="routeur.php?controleur=AuteurControleur&action=lireObjets" class="hover">
                    <i class="bi-book"></i>&nbsp;&nbsp;Auteurs</a>
            <?php }?>
            <ul class="dropdown">
                <li>
                    <a href="routeur.php?controleur=AuteurControleur&action=addObjet">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi-pencil-square">&nbsp;</i>
                        Modifier
                    </a>
                </li>
            </ul>
        </li>
        <li>
        <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "AdherentControleur") {?>
                <a href="routeur.php?controleur=AdherentControleur&action=lireObjets" class="--active hover">
                    <i class="bi-person"></i>&nbsp;&nbsp;Adhérents</a>
            <?php } else { ?>
                <a href="routeur.php?controleur=AdherentControleur&action=lireObjets" class="hover">
                    <i class="bi-person"></i>&nbsp;&nbsp;Adhérents</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="#">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi-pencil-square">&nbsp;</i>
                        Modifier
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "LivreControleur") {?>
                <a href="routeur.php?controleur=LivreControleur&action=lireObjets" class="--active hover">
                    <i class="bi-files"></i>&nbsp;&nbsp;Livres</a>
            <?php } else { ?>
                <a href="routeur.php?controleur=LivreControleur&action=lireObjets" class="hover">
                    <i class="bi-files"></i>&nbsp;&nbsp;Livres</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="#">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi-pencil-square">&nbsp;</i>
                        Modifier
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "GenreControleur") {?>
                <a href="routeur.php?controleur=GenreControleur&action=lireObjets" class="--active hover">
                        <i class="bi-tag"></i>&nbsp;&nbsp;Genres
                </a>
                <?php } else { ?>
                    <a href="routeur.php?controleur=GenreControleur&action=lireObjets" class="hover">
                        <i class="bi-tag"></i>&nbsp;&nbsp;Genres</a>
                <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="#">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi-pencil-square">&nbsp;</i>
                        Modifier
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "CategorieControleur") {?>
                <a href="routeur.php?controleur=CategorieControleur&action=lireObjets" class="--active hover">
                    <i class="bi-tags"></i>&nbsp;&nbsp;Catégories</a>
            <?php } else { ?>
                <a href="routeur.php?controleur=CategorieControleur&action=lireObjets" class="hover">
                    <i class="bi-tags"></i>&nbsp;&nbsp;Catégories</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="#">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi-pencil-square">&nbsp;</i>
                        Modifier
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <?php if($_GET['action'] == "lireObjets" && $_GET['controleur'] == "NationaliteControleur") {?>
                <a href="routeur.php?controleur=NationaliteControleur&action=lireObjets" class="--active hover">
                    <i class="bi-flag"></i>&nbsp;&nbsp;Nationalités</a>
            <?php } else { ?>
                <a href="routeur.php?controleur=NationaliteControleur&action=lireObjets" class="hover">
                    <i class="bi-flag"></i>&nbsp;&nbsp;Nationalités</a>
            <?php } ?>
            <ul class="dropdown">
                <li>
                    <a href="#">
                        <i class="bi-person-plus"></i>&nbsp;Ajouter
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi-pencil-square">&nbsp;</i>
                        Modifier
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

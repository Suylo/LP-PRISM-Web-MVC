<?php
//$num_banniere = rand(1, 6);
//$fleur = isset($_GET['fleur']) ? $_GET['fleur'] : "rose";
/*  remarque PHP : la structure "ternaire" ci-dessus
    est exactement équivalente au code suivant :
  if (isset($_GET['fleur'])) {
    $fleur = $_GET['fleur'];
  } else {
    $fleur = "rose";
  }
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/icones/fleur.ico" rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="css/stylesDivers.css">
    <link rel="stylesheet" type="text/css" href="css/stylesBanniere.css">
    <link rel="stylesheet" type="text/css" href="css/stylesMenu.css">
    <link rel="stylesheet" type="text/css" href="css/stylesGalerie.css">
    <title>Galeries de fleurs</title>
</head>
<body>
<!-- Retourne la date -->
<?php echo "<p>appel serveur à " . date('H:i:s') . "</p>"; ?>
<div id="page">
    <img id="parametres" src="img/divers/parametres.png" onclick="changer_parametres();">
    <header>
        <div id="banniere" onclick="stopper_defilement()" ondblclick="lancer_defilement()">
            <img id="1" class="img_banniere visible" alt="banniere" src="img/banniere/banniere1.jpg">
            <img id="2" class="img_banniere cachee" alt="banniere" src="img/banniere/banniere2.jpg">
            <img id="3" class="img_banniere cachee" alt="banniere" src="img/banniere/banniere3.jpg">
            <img id="4" class="img_banniere cachee" alt="banniere" src="img/banniere/banniere4.jpg">
            <img id="5" class="img_banniere cachee" alt="banniere" src="img/banniere/banniere5.jpg">
            <img id="6" class="img_banniere cachee" alt="banniere" src="img/banniere/banniere6.jpg">
        </div>
        <nav>
            <ul>
                <li><a href="#" onclick="adapter_galerie('rose');">Rose</a></li>
                <li><a href="#" onclick="adapter_galerie('hortensia');">Hortensia</a></li>
                <li><a href="#" onclick="adapter_galerie('fruitier');">Fruitier</a></li>
                <li><a href="#" onclick="adapter_galerie('autre');">Autre</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="titrePage">
            <h1><span id="titre">Galerie de roses</span></h1>
        </div>
        <div class='galerie'>
            <div class='ligne_galerie'>
                <img id='fleur1' class='img_galerie' alt='1' title='Rose 1 lol'
                     src='img/fleurs/rose/rose1.jpg'>
                <img id='fleur2' class='img_galerie' alt='2' title=''
                     src='img/fleurs/rose/rose2.jpg'>
                <img id='fleur3' class='img_galerie' alt='3' title=''
                     src='img/fleurs/rose/rose3.jpg'>
            </div>
            <div class='ligne_galerie'>
                <img id='fleur4' class='img_galerie' alt='4' title=''
                     src='img/fleurs/rose/rose4.jpg'>
                <img id='fleur5' class='img_galerie' alt='5' title=''
                     src='img/fleurs/rose/rose5.jpg'>
                <img id='fleur6' class='img_galerie' alt='6' title=''
                     src='img/fleurs/rose/rose6.jpg'>
            </div>
        </div>
    </main>
    <footer onmouseover="construit_infobulle()" onmouseout="detruit_infobulle()">
        <p>JavaScript 2023</p>
        <p>TD1 - dynamiser les pages web</p>
    </footer>
</div>
<script>

    function changer_parametres() {
        let oldRandom = Math.floor(Math.random() * 4) + 1;
        console.log("Old " + oldRandom);
        let newRdn = Math.floor(Math.random() * 4) + 1;
        console.log("New " + newRdn);
        do {
            newRdn= Math.floor(Math.random() * 4) + 1;
        } while (oldRandom !== newRdn)

        console.log(newRdn);
        document.querySelector('body').style.backgroundImage = "url('img/background/bg-" + newRdn + ".jpg')";
    }

    function adapter_galerie(nom) {
        for (let i = 1; i <= 6; i++) {
            // ON sait que y a 6 images, à chaque fois qu(on click on boucle 6 fois
            // On récupère l'id avec getelementbyid ensuite on change les images à chaque clic
            let image = document.getElementById('fleur' + i);
            image.src = 'img/fleurs/' + nom + '/' + nom + i + '.jpg';
            adapter_titre(tabTitres[nom]);
        }
    }

    let chb = setInterval(change_banniere_v2, 4000);


    function construit_infobulle() {
        let info = document.createElement('div');
        info.innerHTML = "<p>c'est moi la bulle !</p>";
        info.id = "bulle";
        info.style.position = "fixed";
        info.style.top = "100px";
        info.style.borderRadius = "10px 10px 0 10px";
        info.style.padding = "15px";
        info.style.right = "150px";
        info.style.backgroundColor = "white";
        info.style.textAlign = "center";
        info.style.width = "fit-content";
        info.style.color = "black";
        document.body.appendChild(info);
    }

    function detruit_infobulle() {
        let info = document.getElementById('bulle');
        document.body.removeChild(info);
    }

    let tabTitres = new Array();
    tabTitres['rose'] = 'Galerie de roses'
    tabTitres['hortensia'] = 'Galerie d\'hortensias';
    tabTitres['fruitier'] = 'Galerie de fruitiers';
    tabTitres['autre'] = 'Galerie de fleurs diverses';

    function adapter_titre(nom) {
        let title = document.getElementById("titre");
        title.innerHTML = nom;
    }


    function stopper_defilement() {
        clearInterval(chb);
    }

    function lancer_defilement() {
        setInterval(change_banniere_v2, 4000);
    }


    function suivant(n) {
        return n >= 6 ? 1 : n + 1;
    }

    function change_banniere_v1() {
        // On récupère la bannière avec la classe visible, la seule et l'unique : la première
        let banniere = document.querySelector('.img_banniere.visible');
        banniere.style.transition = "opacity 2s";
        // On la cache
        cacher(banniere);
        // On récupère l'id de la bannière suivante avec suivant(n) qui retourne le nombre suivant
        afficher(document.getElementById("" + suivant(parseInt(banniere.id))));
    }

    function change_banniere_v2() {
        let banniere = document.querySelector('.img_banniere.visible');
        banniere.style.transition = "opacity 3s";
        let suivantId = suivant(parseInt(banniere.id));
        let nextBanniere = document.getElementById(suivantId)
        nextBanniere.style.transition = "opacity 3s";
        cacher(banniere);
        afficher(nextBanniere);
    }

    // Simplification de cacher/afficher
    function cacherOuAfficher(im) {
        im.classList.toggle('cachee');
        im.classList.toggle('visible');
    }

    // On cache une image
    function cacher(img) {
        img.classList.add('cachee');
        img.classList.remove('visible');
    }

    // On affiche une image
    function afficher(img) {
        img.classList.add('visible');
        img.classList.remove('cachee');
    }

</script>
</body>
</html>

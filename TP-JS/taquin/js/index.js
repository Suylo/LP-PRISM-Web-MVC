let message = document.getElementById("message");

// Boutons
let melangerBtn = document.getElementById("melanger");
let solutionBtn = document.getElementById("solution");


// Selection du themes
let selectThemes = document.getElementById("themes");
selectThemes.addEventListener("change", function () {
    let selectedOption = this.value;
    this.querySelector("option[selected]").removeAttribute("selected");
    this.querySelector("option[value='" + selectedOption + "']").setAttribute("selected", "selected");
    changeImg(selectedOption);
});


// Fonction qui va se charger de modifier toutes les images
// en fonction du thème sélectionné
function changeImg(option, order = false) {
    let imageContainer = document.getElementById("jeu");
    let images = imageContainer.querySelectorAll("img");
    let numbers = Array.from(Array(16).keys())
    let randomArr = []
    while (numbers.length > 0) {
        let randomIndex = Math.floor(Math.random() * numbers.length);
        randomArr.push(numbers.splice(randomIndex, 1)[0]);
    }
    images.forEach(function (_img, _index) {
        if (order) {
            _img.src = "img/" + option + "/" + option + "_" + _index + ".jpg";
        } else {
            _img.src = "img/" + option + "/" + option + "_" + randomArr[_index] + ".jpg";
        }
    });
}


// Melanger les images
melangerBtn.addEventListener("click", function () {
    let optionSelected = document.querySelector("option[selected]").value;
    changeImg(optionSelected);
    message.innerHTML = "Vous avez mélangé le taquin !";
});

// La solution
// On click sur le bouton solution
solutionBtn.addEventListener("click", function () {
    let optionSelected = document.querySelector("option[selected]").value;
    if (solutionBtn.value === "solution"){
        melangerBtn.setAttribute("disabled", "");
        solutionBtn.value = "puzzle";

        changeImg(optionSelected, true);
        message.innerHTML = "Voici la solution";
    } else if (solutionBtn.value === "puzzle"){
        melangerBtn.removeAttribute("disabled");
        solutionBtn.value = "solution";
        changeImg(optionSelected);
        message.innerHTML = "A vous de trouver !"
    }
});

let jeu = document.getElementById("jeu");
jeu.addEventListener("mouseover", function (e) {
    if (e.target.src !== undefined) {
        let optionSelected = document.querySelector("option[selected]").value;
        let src = e.target.src;
        let index = src.indexOf("img/");
        let imgPath = src.substring(index);
        let imgSrc = "img/" + optionSelected + "/" + optionSelected + "_15.jpg";

        if (imgPath === imgSrc) {
            let imgright = e.target.nextElementSibling;
            if (imgright != null){
                imgright.style.cursor = "pointer !important";
                imgright.addEventListener('click', function (_img){
                    _img.target.src = imgSrc;

                });
            }
            e.target.nextElementSibling.cursor = "pointer";
        } else {
            e.target.style.cursor = "not-allowed";
        }
    }
});



let xhr = new XMLHttpRequest();
let div_verbes = document.getElementById("liste_verbes");
let div_input = document.getElementById("input");

document.body.onload = creer_interface;

function creer_interface() {
    let tab = [
        ['a', 'b', 'c', 'd', 'e', 'f'],
        ['g', 'h', 'i', 'j', 'k', 'l'],
        ['m', 'n', 'o', 'p', 'q', 'r'],
        ['s', 't', 'u', 'v', 'z', 'œ']
    ];

    let inputText = document.createElement("input");
    inputText.type = "text";
    inputText.id = "input__text";
    inputText.placeholder = "Entrez une séquence...";
    div_input.appendChild(inputText);


    tab.forEach(_ligne => {
        let newDiv = document.createElement("div");
        _ligne.forEach(_letter => {
            let inputAlpha = document.createElement("input");
            inputAlpha.type = "button";
            inputAlpha.id = _letter;
            inputAlpha.value = _letter;
            newDiv.appendChild(inputAlpha);
        })
        div_input.appendChild(newDiv);
    })

    let inputClear = document.createElement("input");
    inputClear.type = "button";
    inputClear.id = "input__btn";
    inputClear.value = "Effacer la liste";
    div_input.appendChild(inputClear);

    div_input.addEventListener("click", function (e){
        charger_verbes(e.target.value, "seq");
    });

    let inputSearch = document.querySelector('#input__btn')
    inputSearch.addEventListener("change", function () {
        charger_verbes(inputSearch.value, "seq");
    });
}

function callback_basique() {
    div_verbes.innerHTML = JSON.parse(xhr.responseText);
}

function callback() {

}

function charger_verbes(lettre, type) {
    let url = "recherche.php?lettre=" + lettre + "&type=" + type;

    div_verbes.innerHTML = xhr.responseText;
    xhr.open("GET", url, true);
    xhr.send();
}


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
            inputAlpha.addEventListener("click", function (e){
                charger_verbes(e.target.value, "init");
            });
        })
        div_input.appendChild(newDiv);
    })

    let inputClear = document.createElement("input");
    inputClear.type = "button";
    inputClear.id = "input__btn";
    inputClear.value = "Effacer";
    div_input.appendChild(inputClear);



    let inputSearch = document.querySelector('#input__text')
    inputSearch.addEventListener('input', function()  {
        charger_verbes(inputSearch.value, "seq");
    })

    inputClear.addEventListener('click', function (){
        div_verbes.innerHTML = "";
        inputSearch.value = null;
    })
}


function callback() {
    let xhrJSON = JSON.parse(xhr.responseText);
    div_verbes.innerHTML = "";
    for (let i = 0; i < xhrJSON.length; i++) {
        let p = document.createElement("p");
        p.innerHTML = xhrJSON[i].libelle;
        div_verbes.appendChild(p);
    }
}

function charger_verbes(lettre, type) {
    let url = "php/recherche.php?lettre=" + lettre + "&type=" + type;
    xhr.open("GET", url, true);
    xhr.addEventListener('load', callback);
    xhr.send();
}


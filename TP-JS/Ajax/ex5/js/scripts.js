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

    let input_texte = document.createElement("input");
    input_texte.type = "text";
    div_input.appendChild(inputText);


    tab.forEach(row => {
        let newDiv = document.createElement("div");
        row.forEach(letter => {
            let input_btn = document.createElement("input");
            input_btn.type = "button";
            input_btn.value = letter;
            newDiv.appendChild(input_btn);
            input_btn.addEventListener("click", function (e){
                charger_verbes(e.target.value, "init");
            });
        })
        div_input.appendChild(newDiv);
    })

    let input_effacer = document.createElement("input");
    input_effacer.type = "button";
    div_input.appendChild(input_effacer);



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


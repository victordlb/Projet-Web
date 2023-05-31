function validerMotDePasse() {
    var motDePasse = document.getElementById('mot_de_passe').value;

    // Vérifier la robustesse du mot de passe (ajustez les critères selon vos besoins)
    if (motDePasse.length < 8 || !/[a-z]/.test(motDePasse) || !/[A-Z]/.test(motDePasse) || !/[0-9]/.test(motDePasse) || !/[^a-zA-Z0-9]/.test(motDePasse)) {
        alert('Le mot de passe doit contenir au moins 8 caractères, une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.');
        return false; // Bloquer l'envoi du formulaire
    }

    return true; // Autoriser l'envoi du formulaire
}

function afficherMotDePasse() {
    var inputMotDePasse = document.getElementById('mot_de_passe');
    if (inputMotDePasse.type === 'password') {
      inputMotDePasse.type = 'text';
    } else {
      inputMotDePasse.type = 'password';
    }
  }


function ajout_attributs(){
  var element = document.getElementById("options");
  var option = element.value;
  var nvl_attributs = document.getElementById("nvAttributs");

  nvl_attributs.innerHTML = "";

  if(option === "acheteur"){

    var p1 = document.createElement("p");
    p1.textContent = "Vos informations de livraison";
    p1.id = "gras";
    nvl_attributs.appendChild(p1);

    var td1 = document.createElement("td");
    td1.textContent = "Adresse";
    nvl_attributs.appendChild(td1);

    var input1 = document.createElement("input");
    input1.type = "text";
    input1.name = "adresse";
    input1.placeholder = "Saisir votre adresse";
    input1.setAttribute("required", "");
    nvl_attributs.appendChild(input1);

    var td2 = document.createElement("td");
    td2.textContent = "Ville";
    nvl_attributs.appendChild(td2);
    
    var input2 = document.createElement("input");
    input2.type = "text";
    input2.name = "ville";
    input2.placeholder = "Ville de cette adresse";
    input2.setAttribute("required", "");
    nvl_attributs.appendChild(input2);

    var td3 = document.createElement("td");
    td3.textContent = "Code Postal";
    nvl_attributs.appendChild(td3);
    
    var input3 = document.createElement("input");
    input3.type = "text";
    input3.name = "codep";
    input3.placeholder = "Saisir le code postal";
    input3.setAttribute("required", "");
    nvl_attributs.appendChild(input3);

    var td4 = document.createElement("td");
    td4.textContent = "Pays";
    nvl_attributs.appendChild(td4);
    
    var input4 = document.createElement("input");
    input4.type = "text";
    input4.name = "pays";
    input4.placeholder = "Pays de cette adresse";
    input4.setAttribute("required", "");
    nvl_attributs.appendChild(input4);

    var p2 = document.createElement("p");
    p2.textContent = "Vos informations de paiement";
    p2.id = "gras";
    nvl_attributs.appendChild(p2);

   // var form = document.createElement("td");

    // Choix de la carte
    var carteLabel = document.createElement("td");
    carteLabel.textContent = "Choix de la carte :";
    nvl_attributs.appendChild(carteLabel);

    var carteSelect = document.createElement("select");
    carteSelect.name = "typec";

    var cartes = ["Visa", "MasterCard", "AmericanExpress"];
    for (var i = 0; i < cartes.length; i++) {
        var carteOption = document.createElement("option");
        carteOption.value = cartes[i];
        carteOption.textContent = cartes[i];
        carteSelect.appendChild(carteOption);
    }

    nvl_attributs.appendChild(carteSelect);


    // Numéro de carte
    var numeroLabel = document.createElement("td");
    numeroLabel.textContent = "Numéro de carte :";
    nvl_attributs.appendChild(numeroLabel);


    var numeroInput = document.createElement("input");
    numeroInput.type = "text";
    numeroInput.name = "numeroc";
    numeroInput.setAttribute("required", "");
    nvl_attributs.appendChild(numeroInput);


    // Nom du titulaire
    var nomLabel = document.createElement("td");
    nomLabel.textContent = "Nom du titulaire :";
    nvl_attributs.appendChild(nomLabel);

    var nomInput = document.createElement("input");
    nomInput.type = "text";
    nomInput.name = "nomc";
    nvl_attributs.appendChild(nomInput);


    // Date d'expiration
    var expirationLabel = document.createElement("td");
    expirationLabel.textContent = "Date d'expiration (mois et année) :";
    nvl_attributs.appendChild(expirationLabel);

    var expirationInput = document.createElement("input");
    expirationInput.type = "month";
    expirationInput.name = "expirationc";
    nvl_attributs.appendChild(expirationInput);

    // CVC
    var cvcLabel = document.createElement("td");
    cvcLabel.textContent = "CVC :";
    nvl_attributs.appendChild(cvcLabel);

    var cvcInput = document.createElement("input");
    cvcInput.type = "text";
    cvcInput.name = "cvc";
    nvl_attributs.appendChild(cvcInput);


  }
}

function redirection(){
  setTimeout(function()
  {
    window.location.href = "../php/accueil.php";
  }, 3000)
}
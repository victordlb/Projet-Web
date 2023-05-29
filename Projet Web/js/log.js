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

  }
}

function redirection(){
  setTimeout(function()
  {
    window.location.href = "../php/accueil.php";
  }, 3000)
}
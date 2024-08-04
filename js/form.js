function verifName(name) {
    for (var i = 0; i < name.length; i++) {
        if (!(name[i] >= 'A' && name[i] <= 'Z') && !(name[i] >= 'a' && name[i] <= 'z') && name[i] !== ' ') {
            return false;
        }
    }
    return true;
}


function verif(){
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var quest = document.getElementById("quest").value;
    if (name == "" || email == "" || quest == ""){
        alert("Veuillez remplir tous les champs");
        return false;
    }
    if (name.length > 20){
        alert("Le nom est trop long");
        return false;
    }

    if (name.indexOf(" ") == -1){
        alert("Le nom doit contenir un nom et un prénom");
        return false;
    }
    if(!verifName(name)){
        alert("Le nom doit contenir que des lettres et des espaces");
        return false;
    }
    if (email.length > 30){
        alert("L'email est trop long");
        return false;
    }
    if (quest.length > 255){
        alert("La question est trop longue");
        return false;
    }
    if(email.indexOf('@gmail.com')){
        alert("L'email doit être de type gmail");
        return false;
    }
    if (email.indexOf("@") == -1 || email.indexOf("@") == 0 || email.indexOf("@") == email.length-1 || email.indexOf("@") != email.lastIndexOf("@") || email.indexOf(".") == -1 || email.indexOf(".") == 0 || email.indexOf(".") == email.length-1)  {
        alert("L'email n'est pas valide");
        return false;
    }
    if (quest == "") {
        alert("Please enter your questions");
        return false;
    }
    return true;
}
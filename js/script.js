function toggleInformation (id) {

    var element = document.getElementById (id);
    var button, text;

    if (element.id == "assertions") {
        button = document.getElementById ('assertionsButton');
    } else if (element.id == "session") {
        button = document.getElementById ('sessionButton');
    }

    text = button.innerHTML;

    if (element.style.display != "block") {
        element.style.display = "block";
        button.innerHTML = text.replace (/Zobrazit/, "Schovat");
    }
    else {
        element.style.display = "none";
        button.innerHTML = text.replace (/Schovat/, "Zobrazit");
    }

}


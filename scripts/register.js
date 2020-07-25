function onRegisterSubmit() {
    var tooltips = document.getElementsByClassName("tooltip");
    var i;
    for (i = 0; i < tooltips.length; i++) {
        if (tooltips[i].classList.contains("toggled")) {
            tooltips[i].classList.remove("toggled");
        }
    }

    var name = document.getElementById("nameField").value;
    var email = document.getElementById("emailField").value;
    var password = document.getElementById("passwordField").value;

    if (email.length === 0 || name.length === 0 || password.length === 0) {
        alert("Toate câmpurile trebuie completate!");
        return false;
    }

    if (!validateName(name)) {
        var tooltip = document.getElementById("nameField").nextSibling
                .nextSibling;
        if (!tooltip.classList.contains("toggled")) {
            tooltip.classList.toggle("toggled");
        }
        return false;
    }

    if (!validateGender()) {
        var tooltip = document.getElementById("gendersContainer").nextSibling
                .nextSibling;
        if (!tooltip.classList.contains("toggled")) {
            tooltip.classList.toggle("toggled");
        }
        return false;
    }

    if (!validateEmail(email)) {
        var tooltip = document.getElementById("emailField").nextSibling
                .nextSibling;
        if (!tooltip.classList.contains("toggled")) {
            tooltip.classList.toggle("toggled");
        }
        return false;
    }

    var passTooltip = document.getElementById("passwordField").nextSibling
            .nextSibling;
    switch (validatePassword(password)) {
        case 1:
            passTooltip.innerHTML = "Parola trebuie să conțină cel puțin 8 caractere!";
            if (!passTooltip.classList.contains("toggled")) {
                passTooltip.classList.toggle("toggled");
            }
            return false;
        case 2:
            passTooltip.innerHTML = "Parola nu poate conține decât litere mici (a-z), litere mari (A-Z), cifre (0-9) și caracterul underscore (_)!";
            if (!passTooltip.classList.contains("toggled")) {
                passTooltip.classList.toggle("toggled");
            }
            return false;
        case 3:
            passTooltip.innerHTML = "Parola trebuie să conțină cel puțin o literă mică, o literă mare și o cifră!";
            if (!passTooltip.classList.contains("toggled")) {
                passTooltip.classList.toggle("toggled");
            }
            return false;
    }

    var pass_elem = document.createElement("input");
    pass_elem.name = "password";
    pass_elem.value = sha256(password);
    pass_elem.style.display = "none";
    document.getElementById("registerForm").appendChild(pass_elem);

    return true;
}

function validateName(name) {
    name = name.trim();
    name = name.replace(/\s{2,}/g, " ");
    var pattern = /^[a-zA-Z ]{2,}$/;
    if (!pattern.test(name)) {
        return false;
    }
    return true;
}

function validateEmail(email) {
    const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!pattern.test(String(email).toLowerCase())) {
        return false;
    }
    return true;
}

function validateGender() {
    var maleRadio = document.getElementById("radioMale");
    var femaleRadio = document.getElementById("radioFemale");
    if (!maleRadio.checked && !femaleRadio.checked) {
        return false;
    }
    return true;
}

function validatePassword(pass) {
    if (pass.length < 8) {
        return 1;
    }

    var generalPattern = /^[a-zA-Z_0-9]+$/;
    if (!generalPattern.test(pass)) {
        return 2;
    }
    var lcPattern = /^(?=.*[a-z])/;
    var ucPattern = /^(?=.*[A-Z])/;
    var numPattern = /^(?=.*[0-9])/;

    if (!lcPattern.test(pass) || !ucPattern.test(pass)
            || !numPattern.test(pass)) {
        return 3;
    }

    return 0;
}

function onInputFocus(elem) {
    var tooltip = elem.nextSibling.nextSibling;
    if (tooltip.classList.contains("toggled")) {
        tooltip.classList.remove("toggled");
    }
}

function onRadioChecked() {
    var tooltip = document.getElementById("gendersContainer").nextSibling
            .nextSibling;
    if (tooltip.classList.contains("toggled")) {
        tooltip.classList.remove("toggled");
    }
}
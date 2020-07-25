function onLoginSubmit() {
    var pass_field = document.getElementById("pass-field");
    var pass_hash = document.createElement("input");
    pass_hash.name = "password";
    pass_hash.value = sha256(pass_field.value);
    pass_hash.style.display = "none";
    pass_field.parentNode.appendChild(pass_hash);
}
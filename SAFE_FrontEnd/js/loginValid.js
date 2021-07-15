function validate() {
    var $valid = true;
    document.getElementById("InputEmail").innerHTML = "";
    document.getElementById("InputPassword").innerHtml = "";

    var userName = document.getElementById("EmailAddress").value;
    var password = document.getElementById("Password").value;

    if (userName == "") {
        document.getElementById("InputEmail").innerHTML = "Required";
        $valid = false;
    }

    if (password = "") {
        document.getElementById("InputPassword").innerHTML = "Required";
        $valid = false;
    }
    return $valid;
}
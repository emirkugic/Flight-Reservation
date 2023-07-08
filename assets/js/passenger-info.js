
document
    .getElementById("autocomplete")
    .addEventListener("change", function () {
        if (this.checked) {
            document.getElementById("passenger-name").value = "John";
            document.getElementById("passenger-surname").value = "Doe";
            document.getElementById("phone").value = "+123456789";
            document.getElementById("date-of-birth").value = "1990-01-01";

            highlightInputs();
        } else {
            document.getElementById("passenger-name").value = "";
            document.getElementById("passenger-surname").value = "";
            document.getElementById("phone").value = "";
            document.getElementById("date-of-birth").value = "";

            removeHighlights();
        }
    });

function highlightInputs() {
    var inputs = [
        "passenger-name",
        "passenger-surname",
        "phone",
        "date-of-birth",
    ];
    for (var i = 0; i < inputs.length; i++) {
        document.getElementById(inputs[i]).classList.add("highlighted");
    }
    setTimeout(removeHighlights, 1000);
}

function removeHighlights() {
    var inputs = [
        "passenger-name",
        "passenger-surname",
        "phone",
        "date-of-birth",
    ];
    for (var i = 0; i < inputs.length; i++) {
        document.getElementById(inputs[i]).classList.remove("highlighted");
    }
}
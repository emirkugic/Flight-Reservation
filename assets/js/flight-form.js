

    $("#one-way").click(function() {
        $("#return-date-input").hide();
        $("#departure-date").css("width", "400px");
    });

    $("#roundtrip").click(function() {
        $("#return-date-input").show();
        $("#departure-date").css("width", "185px");
    });


$(document).ready(function() {
    // Add method for date validation
    $.validator.addMethod("date", function(value, element) {
        return this.optional(element) || !/Invalid|NaN/.test(new Date(value).toString());
    }, "Please enter a valid date.");

    // Validation for search flight form
    $("#flight-search-form").validate({
        rules: {
            "from-input": {
                required: true,
            },
            "to-input": {
                required: true,
            },
            "departure-date": {
                required: true,
                date: true
            },
            "return-date": {
                required: true,
                date: true
            },
            passengers: {
                required: true,
            },
            "ticket-class": {
                required: true,
            }
        },
        messages: {
            "from-input": {
                required: "From field is required",
            },
            "to-input": {
                required: "To field is required",
            },
            "departure-date": {
                required: "Departure date is required",
            },
            "return-date": {
                required: "Return date is required",
            },
            passengers: {
                required: "Passenger field is required",
            },
            "ticket-class": {
                required: "Ticket class field is required",
            }
        }
    });

    $("#one-way").click(function() {
        $("#return-date-input").hide();
        $("#departure-date").css("width", "400px");
    });

    $("#roundtrip").click(function() {
        $("#return-date-input").show();
        $("#departure-date").css("width", "185px");
    });
});

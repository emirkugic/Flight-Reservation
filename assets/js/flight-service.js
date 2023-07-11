var FlightService = {
	init: function () {
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
            },

			submitHandler: function(form, event) {
                event.preventDefault();
                var searchData = {
                    departure_airport: $("#from-input").val(),
                    departure_date: $("#departure-date").val(),
                    destination_airport: $("#to-input").val(),
                    arrival_date: $("#return-date").val(),
                };
                FlightService.searchFlights(searchData);
            },
			errorPlacement: function(error, element) {
                FlightService.displayError(error.text(), element.attr("id"));
            }
        });
	},
	displayError: function(message, targetId) {
        var errorHtml = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        $(`#${targetId}`).html(errorHtml);
    },

	searchFlights: function (searchData) {
		$.ajax({
			url: "rest/flights/search",
			type: "POST",
			data: JSON.stringify(searchData),
			contentType: "application/json",
			dataType: "json",
			success: function (result) {
				console.log(result);
				window.alert(JSON.stringify(result, null, 4));
				window.location.href = "#tickets";
			},
			/*error: function (XMLHttpRequest, textStatus, errorThrown) {
				alert("Failed to retrieve flights");
			},*/
		});
	},
};
$(document).ready(function() {
    FlightService.init();
});
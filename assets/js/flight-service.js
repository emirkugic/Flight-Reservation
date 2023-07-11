var FlightService = {
	init: function () {
		// Add method for date validation
		$.validator.addMethod(
			"date",
			function (value, element) {
				return (
					this.optional(element) ||
					!/Invalid|NaN/.test(new Date(value).toString())
				);
			},
			"Please enter a valid date."
		);

		// Validation for search flight form
		$("#options-booking-form").validate({
			rules: {
				"from-input": {
					required: true,
				},
				"to-input": {
					required: true,
				},
				"departure-date": {
					required: true,
					date: true,
				},
				"return-date": {
					required: true,
					date: true,
				},
				passengers: {
					required: true,
				},
				"ticket-class": {
					required: true,
				},
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
				},
			},

			submitHandler: function (form, event) {
				event.preventDefault();
				var searchData = {
					departure_airport: $("#from-input").val(),
					departure_date: $("#departure-date").val(),
					destination_airport: $("#to-input").val(),
					arrival_date: $("#return-date").val(),
				};
				FlightService.searchFlights(searchData);
			},
			errorPlacement: function (error, element) {
				FlightService.displayError(error.text(), element.attr("id"));
			},
		});
	},
	displayError: function (message, targetId) {
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
				localStorage.setItem("flights", JSON.stringify(result));
				window.location.href = "#tickets";
			},
			/*error: function (XMLHttpRequest, textStatus, errorThrown) {
				alert("Failed to retrieve flights");
			},*/
		});
	},

	displayFlights: function (flightData) {
		$("#from-input").val(flightData[0].departure_city);
		$("#to-input").val(flightData[0].destination_city);
		$("#departure-date").val(flightData[0].departure_date);
		$("#return-date").val(flightData[0].arrival_date);
		$("#ticket-class").val("Economy");
	},

	// displayTickets: function () {
	// 	// Retrieve flights data from local storage
	// 	var flights = JSON.parse(localStorage.getItem("flights"));

	// 	// Check if there are any flights
	// 	if (flights && flights.length > 0) {
	// 		// Clear existing content in available-tickets divs
	// 		$("#available-tickets").empty();

	// 		// Loop through the flights array
	// 		flights.forEach(function (flight) {
	// 			// Create HTML for the flight details
	// 			var flightHtml = `
	//         <div class="ticket selected-ticket">
	//             <div class="time">
	//                 <p class="top date">${
	// 										flight.departure_date.split(" ")[0]
	// 									}</p>
	//                 <p class="bottom day">Day</p> <!-- You need to calculate the day here -->
	//             </div>
	//             <div class="direction">
	//                 <div class="departure">
	//                     <div class="top departure-time">
	//                         <p class="date">${
	// 														flight.departure_date.split(" ")[1]
	// 													}</p>
	//                         <p class="bottom departure-city">${
	// 														flight.departure_city
	// 													}</p>
	//                     </div>
	//                 </div>
	//                 <div class="flight-art">
	//                     <p>SA 143</p>
	//                     <img src="assets/img/flight-direction.png" alt="flight direction art" class="flight-art-img"/>
	//                     <p>3 hours 15 minutes</p> <!-- You need to calculate flight duration here -->
	//                 </div>
	//                 <div class="destination">
	//                     <div class="top departure-time">
	//                         <p class="date">${
	// 														flight.arrival_date.split(" ")[1]
	// 													}</p>
	//                         <p class="bottom departure-city">${
	// 														flight.destination_city
	// 													}</p>
	//                     </div>
	//                 </div>
	//             </div>
	//             <div class="price">
	//                 <p class="value-fare">VALUE FARE</p>
	//                 <p class="value">$64.93</p> <!-- You need to calculate price here -->
	//             </div>
	//             <img src="assets/img/selected.png" alt="" class="selected-icon" />
	//         </div>
	//         `;

	// 			// Append the flight HTML to the available-tickets div
	// 			$("#available-tickets").append(flightHtml);
	// 		});
	// 	} else {
	// 		// If no flights were found, display a message
	// 		$("#available-tickets").html("<p>No flights were found.</p>");
	// 	}
	// },
};

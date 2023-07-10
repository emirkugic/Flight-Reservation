var FlightService = {
	init: function () {
		$("#options-booking-form").on("submit", function (event) {
			event.preventDefault();
			var searchData = {
				departure_airport: $("#from-input").val(),
				departure_date: $("#departure-date").val(),
				destination_airport: $("#to-input").val(),
				arrival_date: $("#return-date").val(),
			};
			FlightService.searchFlights(searchData);
		});
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
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				alert("Failed to retrieve flights");
			},
		});
	},
};

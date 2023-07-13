var TicketService = {
    init: function () {
        $('#checkout-form').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting

            var cardNum = $('#card-num').val();
            var firstName = $('#first-name').val();
            var lastName = $('#last-name').val();
            var expCode = $('#exp-code').val();
            var cvv = $('#cvv').val();
            var securityCode = $('#security-code').val();
            var zipCode = $('#zip-code').val();

            // Check if all required fields are filled
            if(cardNum === "" || firstName === "" || lastName === "" || cvv === "" || securityCode === "" || zipCode === ""){
                alert('All fields are required');
                return false;
            }
            
            // Check if card number is only digits
            if (!/^\d+$/.test(cardNum)) {
                alert('Card number must only contain digits');
                return false;
            }

            // Check if CVV is only digits
            if (!/^\d+$/.test(cvv)) {
                alert('CVV must only contain digits');
                return false;
            }

            // Check if security code is only digits
            if (!/^\d+$/.test(securityCode)) {
                alert('Security Code must only contain digits');
                return false;
            }

            // Check if zip code is only digits
            if (!/^\d+$/.test(zipCode)) {
                alert('Zip Code must only contain digits');
                return false;
            }

            var paymentDetails = {
                cardNum: cardNum,
                firstName: firstName,
                lastName: lastName,
                expCode: expCode,
                cvv: cvv,
                securityCode: securityCode,
                zipCode: zipCode
            };

            localStorage.setItem('paymentDetails', JSON.stringify(paymentDetails));
            alert('Payment successful! Payment details: ' + JSON.stringify(paymentDetails));
            // alert(formattedDate);
            TicketService.addTicket();
        });
    },
    addTicket: function (entity) {


        
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = currentDate.getMonth() + 1; 
        var day = currentDate.getDate();
        // Format the date as "YYYY-MM-DD"
        var formattedDate = `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}`;
        
        
        
        
        
        
        
        
        var userToken = localStorage.getItem("user_token");
        var user = Utils.parseJwt(userToken);

        var passengerInfo = localStorage.getItem('passengerInfo');
        var paymentDetails = localStorage.getItem('paymentDetails'); 
           
        var selectedFlight = JSON.parse(localStorage.getItem('selectedFlight'));
        var selectedSeat = JSON.parse(localStorage.getItem('selectedSeat'));
        var baggage = JSON.parse(localStorage.getItem('baggageDetails'));
        

            var ticket = {
                booking_date: formattedDate, 
                user_id: user.id, 
                flight_id: selectedFlight.id, 
                ticket_price: selectedFlight.price+baggage.price, 
                seat_row: selectedSeat.row, 
                seat_column: selectedSeat.number
            }; 

            $.ajax({
                url: "rest/tickets/add",
                type: "POST",
                data: JSON.stringify(ticket),
                contentType: "application/json",
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    alert("Ticket added successfully");
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                    console.log(textStatus);
                    console.log(XMLHttpRequest);
                },
            });
        }
};
$(document).ready(function(){
    TicketService.init();
});



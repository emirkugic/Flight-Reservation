var SeatService = {
    init: function () {
        var seatNumber = JSON.parse(localStorage.getItem("selectedSeat"));
        this.reserveSeat(seatNumber);
    },

    reserveSeat: function (seatNumber) {
        $.ajax({
            url: "rest/seats/reserve",
            type: "PUT",
            data: JSON.stringify(seatNumber),
            contentType: "application/json",
            dataType: "json",
            success: function (result) {
                console.log(result);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(errorThrown);
            },
        });
    },
};

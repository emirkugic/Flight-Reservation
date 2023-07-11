document.getElementById("searchForm").addEventListener("submit", function (e) {
    e.preventDefault();

    var destination = document.getElementById("destination").value;
    var inDate = new Date(document.getElementById("in-date").value);
    var outDate = new Date(document.getElementById("out-date").value);
    var guests = document.getElementById("guests").value;
    var rooms = document.getElementById("rooms").value;

    var url = "https://www.booking.com/searchresults.html?";
    url += "ss=" + encodeURIComponent(destination);
    url += "&checkin_monthday=" + inDate.getDate();
    url += "&checkin_month=" + (inDate.getMonth() + 1);
    url += "&checkin_year=" + inDate.getFullYear();
    url += "&checkout_monthday=" + outDate.getDate();
    url += "&checkout_month=" + (outDate.getMonth() + 1);
    url += "&checkout_year=" + outDate.getFullYear();
    url += "&group_adults=" + guests;
    url += "&no_rooms=" + rooms;

    window.location.href = url;
});
document.getElementById("searchCarForm").addEventListener("submit", function (e) {
    e.preventDefault();

    var location = document.getElementById("location").value;
    var pickupDate = new Date(document.getElementById("up-date").value);
    var pickupTime = document.getElementById("up-time").value;
    var dropoffDate = new Date(document.getElementById("off-date").value);
    var dropoffTime = document.getElementById("off-time").value;

    var formattedPickupDate = pickupDate.toISOString().split("T")[0];
    var formattedDropoffDate = dropoffDate.toISOString().split("T")[0];
    var formattedPickupTime = pickupTime.replace(":", "%3A");
    var formattedDropoffTime = dropoffTime.replace(":", "%3A");

    var url = "https://www.rentalcars.com/search-results?";
    url += "location=-1";
    url += "&dropLocation=-1";
    url += "&locationName=" + encodeURIComponent(location);
    url += "&dropLocationName=" + encodeURIComponent(location);
    url += "&coordinates=41.00817%2C28.974445";
    url += "&dropCoordinates=41.00817%2C28.974445";
    url += "&driversAge=30";
    url += "&puDay=" + pickupDate.getDate();
    url += "&puMonth=" + (pickupDate.getMonth() + 1);
    url += "&puYear=" + pickupDate.getFullYear();
    url += "&puMinute=" + pickupTime.substr(3, 2);
    url += "&puHour=" + pickupTime.substr(0, 2);
    url += "&doDay=" + dropoffDate.getDate();
    url += "&doMonth=" + (dropoffDate.getMonth() + 1);
    url += "&doYear=" + dropoffDate.getFullYear();
    url += "&doMinute=" + dropoffTime.substr(3, 2);
    url += "&doHour=" + dropoffTime.substr(0, 2);
    url += "&ftsType=C";
    url += "&dropFtsType=C";

    window.location.href = url;
  });
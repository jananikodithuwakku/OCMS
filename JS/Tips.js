document.getElementById("enable-location").addEventListener("click", function () {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(sendLocation, showError);
    } else {
        document.getElementById("alert-message").innerHTML = "<p>Geolocation is not supported by your browser.</p>";
    }
});

function sendLocation(position) {
    let latitude = position.coords.latitude;
    let longitude = position.coords.longitude;
    let userEmail = prompt("Enter your email to receive alerts:");

    if (!userEmail) {
        document.getElementById("alert-message").innerHTML = "<p>Email is required for alerts.</p>";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "send_alert.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("alert-message").innerHTML = `<p>${xhr.responseText}</p>`;
        }
    };

    let params = `email=${userEmail}&latitude=${latitude}&longitude=${longitude}&register=true`;
    xhr.send(params);
}

function showError(error) {
    let errorMsg;
    switch (error.code) {
        case error.PERMISSION_DENIED:
            errorMsg = "User denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            errorMsg = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            errorMsg = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            errorMsg = "An unknown error occurred.";
            break;
    }
    document.getElementById("alert-message").innerHTML = `<p>${errorMsg}</p>`;
}
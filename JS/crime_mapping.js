function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: { lat: -33.8688, lng: 151.2093 },
    });

    new google.maps.Marker({
        position: { lat: -33.8688, lng: 151.2093 },
        map,
        title: "Crime Reported",
    });
}

window.onload = initMap;

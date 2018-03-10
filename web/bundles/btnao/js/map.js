var map = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={pk.eyJ1IjoiYWxlY2t2aW5jZW50IiwiYSI6ImNqOWgxcmVnZzJ6YjYycXQ0c2lwd3NwYWQifQ.ECfnUX5KCYOByUbS0noiLg}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiYWxlY2t2aW5jZW50IiwiYSI6ImNqOWgxcmVnZzJ6YjYycXQ0c2lwd3NwYWQifQ.ECfnUX5KCYOByUbS0noiLg'
}).addTo(map);

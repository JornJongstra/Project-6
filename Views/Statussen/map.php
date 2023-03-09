<main>  
   <div class="container-fluid">
        <div id="map" style="width: 100%; height: 100vh"></div>
    </div>
    
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <script>
        var map = L.map('map').setView([51.57403, 5.42173], 6);

        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            artibution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        osm.addTo(map);

        if(!navigator.geolocation) {
            console.log("Your browser doesn't support geo")
        } else {
            navigator.geolocation.getCurrentPosition(getPosition)
        }


        function getPosition(position) {
            console.log(position)
            var lat = position.coords.latitude
            var long = position.coords.longitude
            var accuracy = position.coords.accuracy

            var ezel = L.icon({
            iconUrl: './assets/images/donkey.svg',
            shadowUrl: '',

            iconSize:     [70, 50], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [17.5, 25], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
            });



            var marker = L.marker([lat, long], {icon: ezel});
            var circle = L.circle([lat, long], {radius: accuracy});


            var featureGroup = L.featureGroup([marker, circle]).addTo(map);


            map.fitBounds(featureGroup.getBounds())
            console.log("Your lat:"+ lat +"Your long:"+ long +"Your accuracy:"+ accuracy);

            map.findAccuratePosition({
                maxWait:15000,
                desiredAccuracy: 1,
                timeout: 10
            });
        }
    </script>
</main>  
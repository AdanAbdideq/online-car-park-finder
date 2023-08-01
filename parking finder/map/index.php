<!DOCTYPE html>
<html>
<head>
    <title>Parking Map</title>
    <style>
        #map {
            height: 500px;
            width: 70%;
        }

        #parkingDetails {
            width: 30%;
            padding: 10px;
            float: right;
            background-color: #f5f5f5;
        }

        #parkingDetails h3 {
            margin-top: 0;
        }

        #parkingDetails p {
            margin-bottom: 10px;
        }
        /* .main{
            display: flex;
            flex-direction: row;
        } */
    </style>
</head>
<body>
    <h1>Parking Map</h1>
    <div class="main">
    <div id="map"></div>
    <div id="parkingDetails">
        <h3>Parking Details</h3>
        <p id="direction"></p>
        <p id="price"></p>
        <button id="directionButton">Get Directions</button>
    </div>
    </div>
    <script>
        // Function to initialize the map
        function initMap() {
            // Nairobi coordinates
            var nairobi = { lat: -1.286389, lng: 36.817223 };

            // Create the map centered at Nairobi
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: nairobi
            });

            // Array of parking slots in Nairobi
            var parkingSlots = [
                { 
                    lat: -1.287834,
                    lng: 36.818305,
                    direction: "Nairobi Parking Lot 1",
                    price: "KES 350 per hour"
                },
                { 
                    lat: -1.288678,
                    lng: 36.816839,
                    direction: "Nairobi Parking Lot 2",
                    price: "KES 500 per hour"
                },
                { 
                    lat: -1.285741,
                    lng: 36.816428,
                    direction: "Nairobi Parking Lot 3",
                    price: "KES 400 per hour"
                },
                // Add more parking slots here...
            ];

            // Create an object to hold parking slot details
            var parkingDetails = {};

            // Add markers for each parking slot
            parkingSlots.forEach(function(slot) {
                var marker = new google.maps.Marker({
                    position: slot,
                    map: map
                });

                // Add click listener to each marker
                marker.addListener('click', function() {
                    // Store the clicked parking slot details
                    parkingDetails.direction = slot.direction;
                    parkingDetails.price = slot.price;

                    // Update the parking details section
                    updateParkingDetails();
                });
            });

            // Function to update the parking details section
            function updateParkingDetails() {
                var directionElement = document.getElementById('direction');
                var priceElement = document.getElementById('price');

                directionElement.textContent = 'Direction: ' + parkingDetails.direction;
                priceElement.textContent = 'Price: ' + parkingDetails.price;
            }

            // Button click listener to get directions
            var directionButton = document.getElementById('directionButton');
            directionButton.addEventListener('click', function() {
                // Redirect to the Google Maps directions page for the selected parking slot
                var encodedDirection = encodeURIComponent(parkingDetails.direction);
                window.location.href = 'https://www.google.com/maps/dir/?api=1&destination=' + encodedDirection;
            });
        }
    </script>

    <!-- Include the Google Maps API script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlMwXqKDr2yHTv9kqWjA6Cdj6TBPKumss&callback=initMap" async defer></script>
</body>
</html>

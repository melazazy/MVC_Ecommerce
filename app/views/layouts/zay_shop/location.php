<?= $this->view("zay_shop/header", $data); ?>
<style>
    #map {
        height: 400px;
        width: 100%;
    }

    h1 {
        color: #fff;
    }

    .locations {
        display: flex;
        justify-content: space-between;
    }

    .location {
        margin-bottom: 20px;
    }

    .location h3 {
        margin-bottom: 5px;
    }

    .location p {
        margin: 5px 0;
        color: #fff;
    }
</style>

<section class="bg-success py-5">
    <div class="container">
        <h1>Our Shop Locations</h1>
        <div class="locations">
            <div class="location">
                <h3>Shop 1</h3>
                <p>123 Main Street, Anytown, USA 12345</p>
                <p>Phone: 0123456789</p>
                <p>Work hours: 10:00 AM to 06:00 PM</p>
            </div>
            <div class="location">
                <h3>Shop 2</h3>
                <p>123 Main Street, Anytown, USA 12345</p>
                <p>Phone: 0123456789</p>
                <p>Work hours: 10:00 AM to 06:00 PM</p>
            </div>
            <div class="location">
                <h3>Shop 3</h3>
                <p>123 Main Street, Anytown, USA 12345</p>
                <p>Phone: 0123456789</p>
                <p>Work hours: 10:00 AM to 06:00 PM</p>
            </div>
        </div>

        <div id="map"></div>
    </div>
</section>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ7BPby09zybIIFcJHdiE4_-I4fiyWzjw"></script>

<script>
    window.addEventListener('load', initMap);

    function initMap() {
        const locations = [{
                name: "Shop 1",
                lat: 37.7749,
                lng: -122.4194,
                address: "123 Main Street, Anytown, USA 12345",
                phone: "0123456789",
                hour: "10:00 AM : 06:00 PM"
            },
            {
                name: "Shop 2",
                lat: 37.3316,
                lng: -122.0307,
                address: "456 Main Street, Anytown, USA 54321",
                phone: "01298765432",
                hour: "09:00 AM : 05:00 PM"
            },
            {
                name: "Shop 3",
                lat: 34.0522,
                lng: -118.2437,
                address: "789 Main Street, Anytown, USA 12543",
                phone: "0123894567",
                hour: "11:00 AM : 07:00 PM"
            }
        ];

        const bounds = new google.maps.LatLngBounds(); // Create bounds object here

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: bounds.getCenter()
        });

        setMarkers(map, locations, bounds); // Pass bounds as a parameter
        map.fitBounds(bounds);
    }

    function setMarkers(map, locations, bounds) { // Receive bounds as a parameter
        for (const location of locations) {
            const marker = new google.maps.Marker({
                position: {
                    lat: location.lat,
                    lng: location.lng
                },
                map: map,
                title: location.name
            });

            // Create an info window
            // ...
            const infoWindow = new google.maps.InfoWindow({
                content: `<h4>${location.name}</h4><p>Address : ${location.address}<br>phone : ${location.phone}<br>Work hours : ${location.hour}</p>`
            });

            // Open the info window when the marker is clicked
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });

            bounds.extend(marker.getPosition()); // Access bounds from the parameter
        }
    }
</script>

<?= $this->view("zay_shop/footer", $data); ?>
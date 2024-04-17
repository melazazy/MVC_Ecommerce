<?= $this->view("zay_shop/header", $data); ?>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>


<section class="bg-success py-5">
    <div class="container">

        <h1>Our Shop Locations</h1>
        <div id="map"></div>

    </div>
</section>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ7BPby09zybIIFcJHdiE4_-I4fiyWzjw"></script>
<!-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ7BPby09zybIIFcJHdiE4_-I4fiyWzjw"></script> -->

<!-- <script>
    function initMap() {
        var locations = [{
                lat: 37.7749,
                lng: -122.4194,
                name: "Shop 1"
            },
            {
                lat: 37.3316,
                lng: -122.0307,
                name: "Shop 2"
            },
            {
                lat: 34.0522,
                lng: -118.2437,
                name: "Shop 3"
            }
        ];

        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: {
                lat: 37.09024,
                lng: -95.712891
            } // Center the map initially
        });

        var markers = locations.map(function(location, i) {
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: location.name
            });

            // Add info window for each marker
            var infowindow = new google.maps.InfoWindow({
                content: '<h4>' + location.name + '</h4>' +
                    '<p>Address, phone, hours, etc.</p>'
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

            return marker;
        });
    }
</script> -->
<script>
    // The following example creates complex markers to indicate beaches near
    // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
    // to the base of the flagpole.
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: new google.maps.LatLng(0, 0),
            zoom: 0,
            // center: {
            //   lat: -33.9,
            //   lng: 151.2
            // },
            center: new google.maps.LatLng(0, 0),
            styles: [{
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#e9e9e9"
                }, {
                    "lightness": 17
                }]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{
                    "color": "#f5f5f5"
                }, {
                    "lightness": 20
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffffff"
                }, {
                    "lightness": 17
                }]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "color": "#fefefe"
                }, {
                    "lightness": 17
                }, {
                    "weight": 1.2
                }]
            }]
        });
        setMarkers(map);
    }
    // Data for the markers consisting of a name, a LatLng and a zIndex for the
    // order in which these markers should display on top of each other.
    const beaches = [
        ["8061 Lougheed Hwy, Burnaby, BC V5A 1W9", -33.890542, 151.274856],
        ["Coogee Beach", -33.923036, 151.259052],
        ["Cronulla Beach", -34.028249, 151.157507],
        ["Manly Beach", -33.80010128657071, 151.28747820854187],
        ["Maroubra Beach", -33.950198, 151.259302],
    ];

    function setMarkers(map) {
        const image = {
            url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
            labelOrigin: new google.maps.Point(130, 10),
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(20, 32),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(11, 40),
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        const shape = {
            coords: [1, 1, 1, 20, 18, 20, 18, 1],
            type: "poly",
        };

        const bounds = new google.maps.LatLngBounds();
        for (let i = 0; i < beaches.length; i++) {
            const beach = beaches[i];
            marker = new google.maps.Marker({
                position: {
                    lat: beach[1],
                    lng: beach[2]
                },
                map,
                icon: image,
                shape: shape,
                label: {
                    color: 'black',
                    fontWeight: 'bold',
                    text: beach[0],
                },
                zIndex: beach[3],
            });
            bounds.extend(marker.position);
        }
        map.fitBounds(bounds);

        var listener = google.maps.event.addListener(map, "idle", function() {
            map.setZoom(10);
            google.maps.event.removeListener(listener);
        });
    }
    initMap();
</script>
<?= $this->view("zay_shop/footer", $data); ?>
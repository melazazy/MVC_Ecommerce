<?= $this->view("zay_shop/header", $data); ?>
<style>
    .dbox {
        width: 100%;
        margin-bottom: 25px;
    }

    @media (max-width: 767.98px) {
        .dbox {
            margin-bottom: 25px !important;
            padding: 0 20px;
        }
    }

    .dbox p {
        margin-bottom: 0;
    }

    .dbox p span {
        font-weight: 500;
        color: #000;
    }

    .dbox p a {
        color: #46b5d1;
    }

    .dbox .icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #5aab6f;
        margin: 0 auto;
        margin-bottom: 20px;
    }

    .dbox .icon span {
        font-size: 20px;
        color: #fff;
    }

    .dbox .text {
        width: 100%;
    }
</style>
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <!--<div class="col-md-6 m-auto text-center">
        <h1 class="h1">Contact Us</h1>
        <!-- <p>
            Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            Lorem ipsum dolor sit amet.
        </p> -->
    <!-- <div class="col-md-4 pt-5"> -->
    <!-- <h2 class="h2 text-success border-bottom pb-3 border-light logo">Zay Shop</h2> -->
    <!-- <ul class="list-unstyled footer-link-list">
            <li>
                <i class="fas fa-map-marker-alt fa-fw"></i>
                123 Consectetur at ligula 10660
            </li>
            <li>
                <i class="fa fa-phone fa-fw"></i>
                <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
            </li>
            <li>
                <i class="fa fa-envelope fa-fw"></i>
                <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
            </li>
        </ul> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- <div class="row mb-5"> -->
    <div class="row px-5">
        <div class="col-md-3">
            <div class="dbox w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-map-marker"></span>
                </div>
                <div class="text">
                    <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dbox w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-phone"></span>
                </div>
                <div class="text">
                    <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dbox w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-paper-plane"></span>
                </div>
                <div class="text">
                    <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dbox w-100 text-center">
                <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-globe"></span>
                </div>
                <div class="text">
                    <p><span>Website</span> <a href="#">yoursite.com</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Map -->
<!-- <div id="mapid" style="width: 100%; height: 300px;"></div>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script>
    var mymap = L.map('mapid').setView([-23.013104, -43.394365, 13], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Zay Telmplte | Template Design by <a href="https://templatemo.com/">Templatemo</a> | Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    L.marker([-23.013104, -43.394365, 13]).addTo(mymap)
        .bindPopup("<b>Zay</b> eCommerce Template<br />Location.").openPopup();

    mymap.scrollWheelZoom.disable();
    mymap.touchZoom.disable();
</script> -->
<!-- Ena Map -->

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="inputname">Name</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="inputemail">Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Subject</label>
                <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Subject">
            </div>
            <div class="mb-3">
                <label for="inputmessage">Message</label>
                <textarea class="form-control mt-1" id="message" name="message" placeholder="Message" rows="8"></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Let’s Talk</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->

<?= $this->view("zay_shop/footer", $data); ?>
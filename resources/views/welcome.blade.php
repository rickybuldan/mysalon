@extends('layout.landing')
@push('after-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <style>
        /* HIDE RADIO */
        [type=radio] { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
        cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
        outline: 2px solid #222B40;
        }
    </style>
@endpush
@section('content')
<div class="row p-0">
    <div class="col-xl-5 col-md-4 col-sm-6">
        <div class="row">
            <h2>Booking Now!</h2>
            <p>We are waiting for you. Please make an Appointment here.</p>
        </div>
        <div class="row">
            <div class="card @guest bg-transparent @endguest">
                <div class="card-body ">
                    @auth
                    <div class="basic-form">
                        <div class="mb-3">
                        
                            <label class="col-sm-3 col-form-label">Choose Service</label>
                            <select id="form-service">

                            </select>
                           
                        </div>
                        <div class="row">
                            {{-- <div class="col-xl-3 col-md-6 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Person</label>
                                    <div class="dropdown bootstrap-select default-select form-control wide"><select class="default-select form-control wide">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select></div>
                                </div>
                            </div> --}}
                            <div class="col-xl-6 col-md-6 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control" placeholder="choose a date" id="min-date">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Time</label>
                                    <select id="form-time">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" id="label_employee">Select Employee</label>
                                    <div id="list_employee" class="row">
                                        {{-- <div class="col-xl-2 col-md-6 col-sm-6 mx-0">
                                            <label>
                                                <input type="radio" name="test" value="small" checked>
                                                <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                                                <p class="text-center">Jajang Nurjaman</p>
                                              </label>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-sm-6">
                                            <label>
                                                <input type="radio" name="test" value="big">
                                                <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                                              </label>
                                        </div> --}}
                                        
                                        {{-- <div class="col-xl-2 col-md-6 col-sm-6">
                                            <div class="new-arrival-product">
                                                <div class="new-arrivals-img-contnent">
                                                    <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 col-md-6 col-sm-6">
                                            <div class="new-arrival-product">
                                                <div class="new-arrivals-img-contnent">
                                                    <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <button type="button" id="book-btn" class="btn btn-primary"><i class="fa-solid fa-phone-volume me-2"></i>Booking Now!</button>
                            </div>
                        </div>
                    </div>
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary ">
                        <span class="ms-2">Login </span>
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-md-4 col-sm-6">
        <div class="card bg-transparent" style="border: 0px;">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <img class="w-50" src="{{ asset('template/admin/images/front.svg') }}" alt="">
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="row p-0">
    <div class="col-lg-12">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="{{ asset('template/admin/images/promo/promo1.jpg') }}" style="border-radius: 12px;" class="d-block w-100" alt="...">
                {{-- <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div> --}}
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('template/admin/images/promo/promo1.jpg') }}"  style="border-radius: 12px;" class="d-block w-100" alt="...">
                {{-- <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div> --}}
              </div>
              <div class="carousel-item">
                <img src="{{ asset('template/admin/images/promo/promo1.jpg') }}" style="border-radius: 12px;" class="d-block w-100" alt="...">
                {{-- <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div> --}}
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
    <!-- review -->
    
</div>
<div class="row mt-5">
    <div class="text-left"><h2>Our Services</h2></div>
    
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4><a href="ecom-product-detail.html">Bonorum et Malorum</a></h4>
                        <span class="price">$71.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4><a href="ecom-product-detail.html">FLARE DRESS</a></h4>
                        <span class="price">$548.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4><a href="ecom-product-detail.html">fox sake withe</a></h4>
                        <span class="price">$245.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4><a href="ecom-product-detail.html">Chair Grey</a></h4>
                        <span class="price">$369.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4><a href="ecom-product-detail.html">Z Product 360</a></h4>
                        <span class="price">$654.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('template/admin/images/product/1.jpg') }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4><a href="ecom-product-detail.html">Bonorum et Malorum</a></h4>
                        <span class="price">$71.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5">
    {{-- <div class="text-left"><h2>Our Services</h2></div> --}}
    <div class="col-xl-4 col-md-4 col-sm-4">
        <div class="card" style="background-color: #222B40;">
            <div class="card-body">
                <div>
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" style="font-size: 70px; color:white; " class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                            <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                          </svg>
                        <h2 class="mt-4 text-white">Our Address</h2>
                    </div>
                    <ul class="text-center text-white">
                        <li><b>POINCUT</b></li>
                        <li>Jl. Diponegoro No 3</li>
                        <li>Coblong, Bandung</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 col-sm-4">
        <div class="card" style="background-color: #222B40;">
            <div class="card-body">
                <div>
                    <div class="text-center">
                        <i class="bi bi-telephone" style="font-size: 70px; color:white; "></i>
                        <h2 class="text-white">Phone & Email</h2>
                    </div>
                    <ul class="text-center text-white">
                        <li>Phone: +628 22081996</li>
                        <li>Email: hello.shayna@gmail.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 col-sm-4">
        <div class="card"  style="background-color: #222B40;">
            <div class="card-body">
                <div>
                    <div class="text-center">
                        <i class="bi bi-envelope" style="font-size: 70px; color:white; "></i>
                        <h2 class="text-white">Social Media</h2>
                        <button type="button" class="btn btn-facebook"> <i class="fab fa-facebook-f"></i>
                        </button>
                        <button type="button" class="btn btn-instagram"> <i class="fab fa-instagram"></i>
                        </button>
                        <button type="button" class="btn btn-whatsapp"> <i class="fab fa-whatsapp"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="d-flex justify-content-center">
            <div id="map" style="height: 350px; width:100%; border-radius:12px"></div>
        </div>
    
    </div>
</div>

@endsection
@push('after-script')
<script>
    $(document).ready(function() {
        // Inisialisasi peta
        latitude=-6.9175;
        longitude=107.6191;
        zoomLevel=13;
        var map = L.map('map').setView([latitude, longitude], zoomLevel); // Ganti latitude, longitude, dan zoomLevel sesuai kebutuhan
    
        // Tambahkan tile layer (misalnya OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 19
        }).addTo(map);
    
        // Tambahkan marker
        var marker = L.marker([latitude, longitude]).addTo(map); // Ganti latitude dan longitude sesuai lokasi marker
    
        // Tambahkan popup pada marker
        marker.bindPopup("<b>POINTCUT!</b>").openPopup(); // Ganti teks popup sesuai keinginan
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="{{ $javascriptFile }}"></script>
@endpush

@extends('layouts.users')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fa fa-map-marker-alt text-primary"></i> Nearby Pharmacies</h2>

    <!-- Filter Form -->
    <form method="GET" class="pharmacy-filter-form mb-4">
        <div class="filter-row">
            <div class="filter-field">
                <input type="text" name="city" id="city" value="{{ request('city') }}" class="filter-input" autocomplete="off" placeholder=" " />
                <label for="city" class="filter-label">City</label>
                <i class="fa fa-city filter-icon"></i>
            </div>
            <div class="filter-field">
                <input type="text" name="state" id="state" value="{{ request('state') }}" class="filter-input" autocomplete="off" placeholder=" " />
                <label for="state" class="filter-label">State</label>
                <i class="fa fa-flag filter-icon"></i>
            </div>
            <div class="filter-field">
                <input type="text" name="country" id="country" value="{{ request('country') }}" class="filter-input" autocomplete="off" placeholder=" " />
                <label for="country" class="filter-label">Country</label>
                <i class="fa fa-globe filter-icon"></i>
            </div>
            <div class="filter-field">
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="filter-input" autocomplete="off" placeholder=" " />
                <label for="search" class="filter-label">Pharmacy or Drug</label>
                <i class="fa fa-search filter-icon"></i>
            </div>
            <div class="filter-actions">
                <button type="submit" class="filter-btn">
                    <i class="fa fa-search"></i> Filter
                </button>
                <a href="{{ route('user.pharmacies') }}" class="filter-btn reset">
                    <i class="fa fa-sync-alt"></i> Reset
                </a>
            </div>
        </div>
    </form>

    <div class="pharmacy-map-container">
        <!-- Pharmacy Cards -->
        <div class="pharmacy-card-wrapper">
            @if($pharmacies->count())
            <div class="pharmacy-card-grid">
                @foreach($pharmacies as $pharmacy)
                <div class="pharmacy-card" data-lat="{{ $pharmacy->latitude }}" data-lng="{{ $pharmacy->longitude }}">
                    <div class="card-body">
                        <h5 class="card-title text-info">
                            <i class="fa fa-clinic-medical"></i> {{ $pharmacy->shop_name ?? $pharmacy->name }}
                        </h5>
                        <p class="card-text mb-2"><strong>Owner:</strong> {{ $pharmacy->name }}</p>
                        <p class="card-text mb-2"><strong>Email:</strong> {{ $pharmacy->email }}</p>
                        @if($pharmacy->drugs->count())
                        <div class="pharmacy-drugs-list" style="max-height: 200px; overflow-y: auto;">
                            <strong>Available Drugs:</strong>
                            <ul class="list-unstyled mb-0">
                                @foreach($pharmacy->drugs->take(5) as $drug)
                                <li>
                                    <i class="fa fa-capsules text-success"></i>
                                    <a href="{{ route('user.drugs.compare', $drug->id) }}" class="drug-name-link" title="Order {{ $drug->name }}">
                                        {{ $drug->name }}
                                    </a>
                                    <span class="badge badge-pill badge-info ml-2">{{ $drug->quantity }} in stock</span>
                                    <span class="text-muted ml-2">ETB {{ number_format($drug->price, 2) }}</span>
                                </li>
                                @endforeach
                                @if($pharmacy->drugs->count() > 5)
                                <li>
                                    <button type="button"
                                        class="btn btn-link btn-sm p-0 more-drugs-toggle"
                                        data-pharmacy="{{ $pharmacy->id }}"
                                        style="color:#2575fc;font-weight:600;">
                                        <span class="more-text"><i class="fa fa-chevron-down"></i> More</span>
                                        <span class="less-text d-none"><i class="fa fa-chevron-up"></i> Less</span>
                                    </button>
                                </li>
                                @endif
                            </ul>
                            @if($pharmacy->drugs->count() > 5)
                            <ul class="list-unstyled mb-0 extra-drugs-list d-none" id="extra-drugs-{{ $pharmacy->id }}">
                                @foreach($pharmacy->drugs->slice(5) as $drug)
                                <li>
                                    <i class="fa fa-capsules text-success"></i>
                                    <a href="{{ route('user.drugs.compare', $drug->id) }}" class="drug-name-link" title="Order {{ $drug->name }}">
                                        {{ $drug->name }}
                                    </a>
                                    <span class="badge badge-pill badge-info ml-2">{{ $drug->quantity }} in stock</span>
                                    <span class="text-muted ml-2">ETB {{ number_format($drug->price, 2) }}</span>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        @else
                        <div class="text-muted small">No drugs listed.</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">No pharmacies found.</div>
            @endif
        </div>

        <!-- Google Map -->
        <div id="google-map" style="height: 70vh; border-radius: 15px; box-shadow: 0 6px 24px rgba(37, 117, 252, 0.1); position: sticky; top: 20px;"></div>
    </div>
</div>

<!-- Google Maps Script -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpvGVz4cun1oyIdmhOvJK9WajyJO3eiMM&callback=initMap&libraries=marker" async defer></script>

<script>
    let map;
    let markers = [];

    // Global initMap function for Google Maps callback
    function initMap() {
        map = new google.maps.Map(document.getElementById('google-map'), {
            center: {
                lat: 9.0054,
                lng: 38.7636
            },
            zoom: 12,
            mapId: '112d5a0496ec8f1f12915701', // Your Map ID here
            mapTypeControl: false,
            streetViewControl: false,
            fullscreenControl: true,
        });

        addMapMarkers();
        geocodeFilterLocation();
    }

    function addMapMarkers() {
        // Remove existing markers from map
        markers.forEach(marker => marker.map = null);
        markers = [];

        document.querySelectorAll('.pharmacy-card').forEach(card => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const name = card.querySelector('.card-title').textContent.trim();
            const email = card.querySelector('p:nth-of-type(2)').textContent.replace('Email:', '').trim();

            if (!isNaN(lat) && !isNaN(lng)) {
                const marker = new google.maps.marker.AdvancedMarkerElement({
                    position: {
                        lat,
                        lng
                    },
                    map,
                    title: name,
                });

                const infowindow = new google.maps.InfoWindow({
                    content: `<div class="map-infowindow">
                                <h6 class="text-primary mb-1">${name}</h6>
                                <p class="text-muted small mb-1">${email}</p>
                              </div>`
                });

                marker.addListener('click', () => infowindow.open(map, marker));
                markers.push(marker);
            }
        });

        if (markers.length > 0) {
            const bounds = new google.maps.LatLngBounds();
            markers.forEach(marker => bounds.extend(marker.position));
            map.fitBounds(bounds);
        }
    }

    function geocodeFilterLocation() {
        const address = [
            "{{ request('city') }}",
            "{{ request('state') }}",
            "{{ request('country') }}"
        ].filter(Boolean).join(', ');

        if (address) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                address
            }, (results, status) => {
                if (status === 'OK' && results[0]) {
                    map.setCenter(results[0].geometry.location);
                    if (markers.length === 0) map.setZoom(14);
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.more-drugs-toggle').forEach(btn => {
            btn.addEventListener('click', function() {
                const pharmacyId = this.dataset.pharmacy;
                const extraList = document.getElementById(`extra-drugs-${pharmacyId}`);
                const moreText = this.querySelector('.more-text');
                const lessText = this.querySelector('.less-text');

                extraList.classList.toggle('d-none');
                moreText.classList.toggle('d-none');
                lessText.classList.toggle('d-none');
            });
        });

        // Card hover bounce effect (optional)
        document.querySelectorAll('.pharmacy-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const lat = parseFloat(this.dataset.lat);
                const lng = parseFloat(this.dataset.lng);
                const marker = markers.find(m =>
                    m.position.lat() === lat &&
                    m.position.lng() === lng
                );
                if (marker) {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(() => marker.setAnimation(null), 750);
                }
            });
        });
    });
</script>

<style>
    .container.py-4 {
        max-width: 1100px;
    }

    .pharmacy-filter-form .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem 1.5rem;
        align-items: flex-end;
    }

    .filter-field {
        position: relative;
        flex: 1 1 150px;
        min-width: 150px;
    }

    .filter-input {
        width: 100%;
        padding: 12px 40px 12px 12px;
        border: 2px solid #d1d9e6;
        border-radius: 10px;
        font-size: 1rem;
        color: #2c3e50;
        background-color: #fff;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        outline-offset: 2px;
        outline-color: transparent;
        text-align: center;
    }

    .filter-icon {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #2575fc;
        font-size: 1.1rem;
        pointer-events: none;
    }

    .filter-label {
        position: absolute;
        top: 50%;
        left: 40px;
        transform: translateY(-50%);
        font-size: 1rem;
        color: #7a8ba6;
        cursor: text;
        pointer-events: none;
        transition: all 0.3s ease;
        user-select: none;
    }

    .filter-input:focus+.filter-label,
    .filter-input:not(:placeholder-shown)+.filter-label {
        top: 6px;
        font-size: 0.75rem;
        color: #2575fc;
        font-weight: 600;
    }

    .filter-input:focus {
        border-color: #2575fc;
        box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
    }

    .filter-actions {
        display: flex;
        gap: 0.8rem;
        flex-wrap: nowrap;
    }

    .filter-btn {
        background: #2575fc;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        user-select: none;
        text-decoration: none;
    }

    .filter-btn i {
        font-size: 1.1rem;
    }

    .filter-btn.reset {
        background: #f0f4f8;
        color: #2575fc;
        border: 2px solid #2575fc;
    }

    .filter-btn.reset:hover,
    .filter-btn:hover {
        background-color: #1a5edb;
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
        color: #fff;
        text-decoration: none;
    }

    .pharmacy-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.8rem 1.5rem;
    }

    .pharmacy-card {
        background: #fff;
        border-radius: 15px;
        transition: transform 0.35s cubic-bezier(.23, 1.01, .32, 1), box-shadow 0.35s ease;
        box-shadow: 0 6px 24px rgb(37 117 252 / 0.1);
        cursor: default;
    }

    .pharmacy-card:hover {
        transform: translateY(-8px);
        box-shadow:
            0 0 38px 10px rgba(37, 117, 252, 0.15),
            0 20px 64px 0 rgba(37, 117, 252, 0.2),
            0 6px 24px rgba(37, 117, 252, 0.1);
    }

    .card-body {
        padding: 1.6rem 1.8rem;
    }

    .card-title {
        font-size: 1.25rem;
    }

    .pharmacy-drugs-list ul {
        padding-left: 0;
        margin-top: 0.4rem;
    }

    .pharmacy-drugs-list li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 6px;
        font-size: 0.95rem;
        color: #2c3e50;
        transition: color 0.3s ease;
    }

    .drug-name-link {
        font-weight: 600;
        color: #2575fc;
        text-decoration: none;
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .drug-name-link:hover,
    .drug-name-link:focus {
        color: #1a4dbb;
        text-decoration: underline;
        outline: none;
    }

    h2 {
        color: #fff;
        margin: 0px 350px 0px 350px;
        border-radius: 10px;
    }

    .badge-info {
        background: #36d1c4 !important;
        color: #fff !important;
        font-weight: 600;
        border-radius: 12px;
        padding: 2px 10px;
        font-size: 0.8rem;
        box-shadow: 0 2px 8px #5b86e522;
    }

    .pharmacy-map-container {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        align-items: start;
    }

    @media (max-width: 1200px) {
        .pharmacy-map-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
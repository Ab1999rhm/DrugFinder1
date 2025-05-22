@extends('layouts.users')

@section('content')
<style>
    .container.py-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    .drug-page-wrapper {
        display: flex;
        gap: 1.2rem;
        align-items: flex-start;
    }

    h2 {
        text-align: center;
        color: rgb(15, 12, 224);
        background-color: rgba(223, 226, 236, 0.95);
        border-radius: 10px;
    }

    .sidebar-filter {
        min-width: 140px;
        max-width: 180px;
        background: rgba(57, 47, 198, 0.64);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(165, 8, 139, 0.06);
        padding: 1rem 0.7rem;
        margin-bottom: 1.5rem;
        animation: fadeInLeft 0.7s;
        height: 100vh;
    }

    .sidebar-filter h4 {
        color: rgb(11, 216, 120);
        font-weight: 700;
        font-size: 1.08rem;
        margin-bottom: 1rem;
        text-align: center;

    }

    .sidebar-filter label {
        font-weight: 600;
        color: #22223b;
        margin-bottom: 0.15rem;
        font-size: 0.95rem;
    }

    .sidebar-filter input {
        width: 100%;
        border: 1px solid #e0e7ff;
        border-radius: 7px;
        padding: 0.3rem 0.5rem;
        margin-bottom: 0.7rem;
        font-size: 0.97rem;
        background: #fff;
        transition: border 0.2s;
    }

    .sidebar-filter input:focus {
        border: 1.5px solidrgb(38, 7, 178);
        outline: none;
    }

    .sidebar-filter .filter-btn {
        width: 100%;
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 7px;
        padding: 0.5rem 0;
        font-size: 1.02rem;
        margin-top: 0.1rem;
        transition: background 0.2s;
    }

    .sidebar-filter .filter-btn:hover {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
    }

    .drug-content {
        flex: 1;
        min-width: 0;
        animation: fadeIn 0.7s;
    }

    .drug-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 1.2rem;
        margin-top: 1.2rem;
        min-height: 420px;
    }

    .drug-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(37, 117, 252, 0.08);
        padding: 1.2rem 1rem 1rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: box-shadow 0.2s, transform 0.12s;
        min-height: 240px;
        position: relative;
    }

    .drug-card:hover {
        box-shadow: 0 6px 24px rgba(37, 117, 252, 0.13);
        transform: translateY(-2px) scale(1.03);
    }

    .drug-meta {
        width: 100%;
        text-align: left;
        margin-bottom: 0.5rem;
        font-size: 0.97rem;
        color: #2575fc;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .drug-img {
        width: 54px;
        height: 54px;
        object-fit: contain;
        margin-bottom: 0.7rem;
        border-radius: 50%;
        background: #f7faff;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.03);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .drug-img img {
        width: 38px;
        height: 38px;
        object-fit: contain;
        display: block;
        margin: auto;
    }

    .drug-title {
        font-size: 1.06rem;
        font-weight: 600;
        color: #2575fc;
        margin-bottom: 0.3rem;
        text-align: center;
    }

    p {
        background-image: url("{{ asset('images/hospital6.jpg') }}");
        background-size: cover;
        /* Cover entire viewport */
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        /* Do not repeat */
        min-height: 20vh;
        margin: 0;
        animation: bgFadeIn 2s ease forwards;
        position: relative;
    }

    .drug-desc {
        font-size: 0.95rem;
        color: #444;
        text-align: center;
        margin-bottom: 0.4rem;
    }

    .drug-actions {
        margin-top: auto;
        display: flex;
        gap: 0.3rem;
        justify-content: center;
        width: 100%;

    }

    .drug-actions button,
    .drug-actions a {
        background: #2575fc;
        color: #fff !important;
        border: none;
        border-radius: 7px;
        padding: 5px 8px;
        font-size: 0.93rem;
        cursor: pointer;
        transition: background 0.2s;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 3px;
    }

    .drug-actions button:hover,
    .drug-actions a:hover {
        background: #6a11cb;
        color: #fff !important;
    }

    .drug-actions .btn-warning {
        background: #ffc107 !important;
        color: #333 !important;
        border: none;
    }

    .drug-actions .btn-warning:hover {
        background: #ff9800 !important;
        color: #fff !important;
    }

    .loader {
        display: none;
        margin: 2rem auto;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #2575fc;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .pagination {
        justify-content: center;
        margin-top: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .pagination .page-link {
        padding: 0.2rem 0.5rem;
        font-size: 0.85rem;
        min-width: 22px;
        height: 26px;
        border-radius: 0.25rem;
    }

    .pagination .page-link[aria-label="Previous"],
    .pagination .page-link[aria-label="Next"] {
        font-size: 1rem;
        padding: 0.12rem 0.35rem;
    }

    .pagination .page-link:hover {
        background: #2575fc;
        color: #fff;
    }

    @media (max-width: 991px) {
        .drug-page-wrapper {
            flex-direction: column;
            gap: 1.2rem;
        }

        .sidebar-filter {
            max-width: 100%;
            width: 100%;
        }

        .drug-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(3, 1fr);
        }
    }

    @media (max-width: 600px) {
        .drug-grid {
            grid-template-columns: 1fr;
            grid-template-rows: none;
        }
    }
</style>
@section('content')

<div class="container py-4">
    <h2 class="mb-4" style="color:#2575fc;font-weight:700;">
        <marquee behavior="" direction="left to right">Browse and Filter Drugs</marquee>
    </h2>
    <div class="drug-page-wrapper">
        <!-- Sidebar Filter -->
        <form id="sidebar-filter-form" class="sidebar-filter">
            <h4>Filter Drugs</h4>
            <label for="filter-name">Drug Name</label>
            <input type="text" id="filter-name" name="q" placeholder="e.g. Paracetamol" value="{{ request('q') }}">

            <label for="filter-country">Country</label>
            <input type="text" id="filter-country" name="country" placeholder="Country" value="{{ request('country') }}">

            <label for="filter-state">State</label>
            <input type="text" id="filter-state" name="state" placeholder="State" value="{{ request('state') }}">

            <label for="filter-city">City</label>
            <input type="text" id="filter-city" name="city" placeholder="City" value="{{ request('city') }}">

            <label for="filter-wereda">Wereda/Province</label>
            <input type="text" id="filter-wereda" name="wereda" placeholder="Wereda/Province" value="{{ request('wereda') }}">

            <label for="filter-price">Price Range (ETB)</label>
            <div class="d-flex align-items-center mb-2" style="gap:0.5rem;">
                <input type="number" min="0" name="price_min" id="filter-price-min" placeholder="Min" style="width:45%;" value="{{ request('price_min') }}">
                <span style="color:#6a11cb;font-weight:600;">-</span>
                <input type="number" min="0" name="price_max" id="filter-price-max" placeholder="Max" style="width:45%;" value="{{ request('price_max') }}">
            </div>

            <button type="submit" class="filter-btn"><i class="fas fa-filter"></i> Filter</button>
        </form>

        <!-- Drug List/Grid -->
        <div class="drug-content">
            <div class="loader" id="loader"></div>
            <div id="drug-list">
                @include('user.partials.drug_list', ['drugs' => $drugs])
            </div>
        </div>
    </div>
</div>

<!-- Drug Details Modal -->
<div class="modal fade" id="drugDetailModal" tabindex="-1" role="dialog" aria-labelledby="drugDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="drugDetailModalLabel">Drug Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="drug-detail-content">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Compare Prices Modal -->
<div class="modal fade" id="drugCompareModal" tabindex="-1" role="dialog" aria-labelledby="drugCompareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="drugCompareModalLabel">Compare Prices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="drug-compare-content">
                <!-- Comparison table will load here -->
            </div>
        </div>
    </div>
</div>
<style>

</style>
<!-- jQuery and Bootstrap JS for modal support -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar Filter Submission (AJAX)
        $('#sidebar-filter-form').on('submit', function(e) {
            e.preventDefault();
            $('#loader').show();
            $.get("{{ route('user.drugs.index') }}", $(this).serialize(), function(html) {
                $('#drug-list').html(html);
                $('#loader').hide();
            });
        });

        // Modal Handlers (Delegated)
        $(document).on('click', '.details-btn', function() {
            let drugId = $(this).data('id');
            $('#drug-detail-content').html('<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
            $('#drugDetailModal').modal('show');
            $.get('/user/drugs/' + drugId + '/details', function(html) {
                $('#drug-detail-content').html(html);
            });
        });

        // Order Form Handler (if used)
        $(document).on('submit', '.order-form', function(e) {
            e.preventDefault();
            let form = this;
            let btn = form.querySelector('.buy-btn');
            let loader = form.querySelector('.order-loader');
            let quantity = form.querySelector('input[name="quantity"]').value;
            let drugId = btn.getAttribute('data-drug-id');
            btn.disabled = true;
            loader.style.display = 'inline-block';

            fetch('/user/orders', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        drug_id: drugId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    btn.disabled = false;
                    loader.style.display = 'none';
                    if (data.success) {
                        btn.innerHTML = '<i class="fas fa-check"></i> Ordered!';
                        btn.classList.add('btn-success');
                        setTimeout(() => {
                            btn.innerHTML = '<i class="fas fa-cart-plus"></i> Buy';
                            btn.classList.remove('btn-success');
                        }, 2000);
                    } else {
                        alert('Could not place order: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    loader.style.display = 'none';
                    alert('Something went wrong. Please try again.');
                });
        });
    });
</script>
@endsection
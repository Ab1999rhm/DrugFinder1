@extends('layouts.sellers')

@section('content')
<style>
    /* Add Drug Page - Consistent with Dashboard Theme */
    .add-drug-bg {
        min-height: 100vh;
        background: linear-gradient(120deg, #f8fafc 60%, #e0e7ff 100%);
        position: relative;
        padding: 70px 0 40px 0;
        z-index: 1;
        animation: fadeInAddDrugBg 0.8s;
    }

    @keyframes fadeInAddDrugBg {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .add-drug-bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(120deg, #6a11cb33 0%, #2575fc22 100%);
        z-index: 2;
        pointer-events: none;
    }

    .orbit-border {
        position: absolute;
        top: 12%;
        left: 80%;
        width: 170px;
        height: 170px;
        background: radial-gradient(circle, #ffb34733 60%, transparent 100%);
        border-radius: 50%;
        z-index: 2;
        filter: blur(16px);
        animation: orbitMove 9s linear infinite alternate;
    }

    @keyframes orbitMove {
        0% {
            transform: translate(-30px, 0);
        }

        100% {
            transform: translate(20px, 30px);
        }
    }

    .add-drug-container {
        position: relative;
        z-index: 3;
        max-width: 650px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .add-drug-card {
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 8px 32px rgba(32, 56, 112, 0.13), 0 1.5px 4px rgba(80, 80, 120, 0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        margin-top: 40px;
        position: relative;
        animation: fadeInAddDrugCard 0.8s;
        overflow: hidden;
    }

    @keyframes fadeInAddDrugCard {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .add-drug-logo-bg {
        position: absolute;
        top: -40px;
        right: -40px;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, #2575fc22 70%, transparent 100%);
        border-radius: 50%;
        filter: blur(4px);
        z-index: 1;
    }

    .add-drug-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2575fc;
        letter-spacing: 1px;
        text-align: center;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.7rem;
        z-index: 2;
        position: relative;
        animation: popInDrugTitle 0.7s;
    }

    @keyframes popInDrugTitle {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .add-drug-desc {
        font-size: 1.08rem;
        color: #444;
        margin-bottom: 1.5rem;
        text-align: center;
        background: linear-gradient(90deg, #e0e7ff 0%, #f7faff 100%);
        border-radius: 10px;
        padding: 0.6rem 1rem;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.05);
        z-index: 2;
        position: relative;
    }

    .add-drug-desc .seller-name {
        color: #ff5858;
        font-weight: 600;
    }

    .success-message {
        background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
        color: #fff;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.2rem;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(67, 206, 162, 0.13);
        text-align: center;
    }

    .error-messages {
        background: linear-gradient(90deg, #ff5858 0%, #ffb347 100%);
        color: #fff;
        border-radius: 12px;
        padding: 1rem 1.2rem;
        margin-bottom: 1.2rem;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(255, 88, 88, 0.13);
        text-align: left;
    }

    .add-drug-form {
        margin-top: 1.5rem;
        z-index: 2;
        position: relative;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.3rem 1.5rem;
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        position: relative;
    }

    .form-row label {
        font-weight: 600;
        color: #2575fc;
        font-size: 1.03rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.15rem;
    }

    .form-row input[type="text"],
    .form-row input[type="number"],
    .form-row input[type="date"],
    .form-row textarea {
        padding: 0.55rem 0.9rem;
        border: 1.5px solid #e0e7ff;
        border-radius: 8px;
        font-size: 1rem;
        background: #f7faff;
        color: #222;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
        box-shadow: 0 1.5px 6px rgba(37, 117, 252, 0.05);
    }

    .form-row input:focus,
    .form-row textarea:focus {
        border-color: #2575fc;
        outline: none;
        box-shadow: 0 0 0 2px #2575fc22;
    }

    .form-row textarea {
        min-height: 70px;
        resize: vertical;
    }

    .form-row.form-row-full {
        grid-column: 1 / -1;
    }

    .form-actions {
        display: flex;
        gap: 1.3rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .btn-add {
        background: linear-gradient(90deg, #ffb347 0%, #ff5858 100%);
        color: #fff;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        padding: 0.7rem 2.2rem;
        font-size: 1.13rem;
        box-shadow: 0 4px 16px rgba(255, 184, 71, 0.13);
        transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
    }

    .btn-add:hover {
        background: linear-gradient(90deg, #ff5858 0%, #ffb347 100%);
        box-shadow: 0 8px 24px rgba(255, 88, 88, 0.23);
        transform: translateY(-2px) scale(1.06);
    }

    .btn-back {
        background: #e0e7ff;
        color: #2575fc;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        padding: 0.7rem 1.7rem;
        font-size: 1.05rem;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.09);
        transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #2575fc;
        color: #fff;
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.13);
        transform: translateY(-2px) scale(1.03);
    }
</style>

<div class="add-drug-bg">
    <div class="add-drug-bg-overlay"></div>
    <!-- Orbiting animated border -->
    <div class="orbit-border"></div>
    <div class="add-drug-container">
        <div class="add-drug-card">
            <div class="add-drug-logo-bg"></div>
            <h2 class="add-drug-title">
                <i class="fa fa-capsules"></i> Add New Drug
            </h2>
            <div class="add-drug-desc">
                <i class="fa fa-user-md"></i>
                Welcome, <span class="seller-name">{{ Auth::user()->name ?? 'Seller' }}</span>!
                Fill out the form below to add a new drug to your inventory.
            </div>
            @if(session('success'))
            <div class="success-message"><i class="fa fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="error-messages">
                <i class="fa fa-exclamation-triangle"></i>
                <ul style="margin:0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('seller.drugs.store') }}" class="add-drug-form">
                @csrf
                <div class="form-grid">
                    <div class="form-row">
                        <label for="name"><i class="fa fa-capsules"></i>Drug Name</label>
                        <input type="text" name="name" id="name" required autofocus value="{{ old('name') }}">
                    </div>
                    <div class="form-row">
                        <label for="brand"><i class="fa fa-tag"></i> Brand</label>
                        <input type="text" name="brand" id="brand" required value="{{ old('brand') }}">
                    </div>
                    <div class="form-row">
                        <label for="category"><i class="fa fa-th-list"></i> Category</label>
                        <input type="text" name="category" id="category" required value="{{ old('category') }}">
                    </div>
                    <div class="form-row">
                        <label for="dosage_form"><i class="fa fa-pills"></i> Dosage Form</label>
                        <input type="text" name="dosage_form" id="dosage_form" required value="{{ old('dosage_form') }}">
                    </div>
                    <div class="form-row">
                        <label for="strength">
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Microscope" style="width:18px;height:18px;vertical-align:middle;margin-right:4px;">
                            Strength
                        </label>
                        <input type="text" name="strength" id="strength" required value="{{ old('strength') }}">
                    </div>
                    <div class="form-row">
                        <label for="quantity"><i class="fa fa-boxes-stacked"></i> Quantity</label>
                        <input type="number" name="quantity" id="quantity" required min="1" value="{{ old('quantity') }}">
                    </div>
                    <div class="form-row">
                        <label for="price"><i class="fa fa-money-bill-wave"></i> Price (ETB)</label>
                        <input type="number" step="0.01" name="price" id="price" required min="0" value="{{ old('price') }}">
                    </div>
                    <div class="form-row">
                        <label for="expiry_date"><i class="fa fa-calendar-alt"></i> Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" required value="{{ old('expiry_date') }}">
                    </div>
                    <div class="form-row">
                        <label for="country"><i class="fa fa-country-alt"></i> Country</label>
                        <input type="string" name="country" id="country" required value="{{ old('country') }}">
                    </div>
                    <div class="form-row">
                        <label for="state"><i class="fa fa-calendar-alt"></i>State</label>
                        <input type="string" name="state" id="state" required value="{{ old('state') }}">
                    </div>
                    <div class="form-row">
                        <label for="woreda"><i class="fa fa-woreda-alt"></i>Woreda</label>
                        <input type="string" name="woreda" id="woreda" required value="{{ old('woreda') }}">
                    </div>
                    
                    <div class="form-row form-row-full">
                        <label for="description"><i class="fa fa-info-circle"></i> Description</label>
                        <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-add">
                        <i class="fa fa-plus"></i> Add Drug
                    </button>
                    <a href="{{ route('seller.drugs.index') }}" class="btn btn-back">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
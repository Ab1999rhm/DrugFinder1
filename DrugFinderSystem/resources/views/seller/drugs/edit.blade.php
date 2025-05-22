@extends('layouts.sellers')

@section('title', 'Edit Drug')

@section('content')
<style>
body { background: none !important; }

/* --- Background and Overlay --- */
.edit-drug-bg-wrapper {
    position: relative;
    min-height: 100vh;
    width: 100%;
    z-index: 0;
}
.edit-drug-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background: url('https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?auto=format&fit=crop&w=1500&q=80') center center no-repeat;
    background-size: cover;
    z-index: 0;
}
.edit-drug-bg-overlay {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, #36d1c4cc 0%, #5b86e5cc 100%);
    opacity: 0.85;
    z-index: 1;
    pointer-events: none;
}

/* --- Logo --- */
.dashboard-logo {
    position: absolute;
    top: 24px;
    left: 38px;
    z-index: 10;
    animation: fadeIn 0.9s;
}
.logo-img {
    height: 54px;
    width: auto;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(54, 209, 196, 0.13);
    transition: box-shadow 0.18s;
}
.logo-img:hover {
    box-shadow: 0 6px 18px rgba(54, 209, 196, 0.23);
    transform: scale(1.04);
}

/* --- Main Content --- */
.edit-drug-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 2;
}
.edit-drug-animated-border {
    position: absolute;
    inset: -6px;
    z-index: 0;
    border-radius: 24px;
    background: linear-gradient(120deg, #36d1c4, #5b86e5, #36d1c4, #5b86e5);
    background-size: 400% 400%;
    animation: editDrugBorderGradient 4s linear infinite;
    filter: blur(3px);
    pointer-events: none;
}
@keyframes editDrugBorderGradient {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}
.edit-drug-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(44, 62, 80, 0.16), 0 2px 8px rgba(54, 209, 196, 0.13);
    padding: 38px 36px 28px 36px;
    width: 100%;
    max-width: 540px;
    min-width: 320px;
    animation: fadeInUp 0.8s;
    position: relative;
    z-index: 1;
    overflow: hidden;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px);}
    to { opacity: 1; transform: none;}
}
.edit-drug-header {
    text-align: center;
    margin-bottom: 16px;
}
.edit-drug-header h2 {
    color: #36d1c4;
    font-weight: 700;
    margin-bottom: 6px;
    font-size: 1.5em;
    letter-spacing: 1px;
    animation: popIn 1s;
}
@keyframes popIn {
    0% { opacity: 0; transform: scale(0.8);}
    80% { opacity: 1; transform: scale(1.05);}
    100% { opacity: 1; transform: scale(1);}
}
.edit-drug-greeting {
    color: #6c757d;
    font-size: 1.08em;
    margin-top: 5px;
    animation: fadeIn 1.2s;
}
.seller-name {
    color: #36d1c4;
    font-weight: 700;
}
.greeting-msg {
    margin-left: 6px;
    font-size: 0.97em;
    color: #5b86e5;
    font-weight: 500;
}
.alert-success {
    color: #1a7f37;
    background: #e6f4ea;
    padding: 10px 16px;
    border-radius: 7px;
    margin-bottom: 18px;
    border-left: 5px solid #36d1c4;
    font-weight: 500;
    animation: fadeIn 0.8s;
}
.alert-error {
    background: #ffeaea;
    color: #e53935;
    border-left: 4px solid #e53935;
    border-radius: 7px;
    padding: 10px 16px;
    margin-bottom: 18px;
    font-size: 1em;
    animation: fadeIn 0.7s;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(18px);}
    to { opacity: 1; transform: none;}
}
.edit-drug-form {
    margin-top: 10px;
}
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px 22px;
}
.form-row {
    display: flex;
    flex-direction: column;
    animation: fadeIn 0.8s;
}
.form-row-full {
    grid-column: 1 / span 2;
}
.edit-drug-form label {
    font-weight: 600;
    color: #2a3b4c;
    margin-bottom: 5px;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 1em;
}
.edit-drug-form input,
.edit-drug-form textarea {
    border: 2px solid #e0e6ed;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 1em;
    transition: border 0.2s, box-shadow 0.2s, background 0.18s;
    outline: none;
    background: #f6fafd;
    color: #2a3b4c;
    box-shadow: 0 1px 2px rgba(54, 209, 196, 0.05);
}
.edit-drug-form input:focus,
.edit-drug-form textarea:focus {
    border-color: #36d1c4;
    box-shadow: 0 0 0 2px #36d1c455;
    background: #fff;
}
.edit-drug-form textarea {
    resize: vertical;
    min-height: 40px;
    max-height: 110px;
}
.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 26px;
    gap: 12px;
}
.btn {
    border: none;
    border-radius: 7px;
    padding: 10px 22px;
    font-weight: 600;
    font-size: 1em;
    cursor: pointer;
    transition: background 0.18s, box-shadow 0.18s, transform 0.11s;
    box-shadow: 0 2px 8px rgba(54, 209, 196, 0.07);
    display: inline-flex;
    align-items: center;
    gap: 7px;
}
.btn-update {
    background: linear-gradient(90deg, #36d1c4 0%, #5b86e5 100%);
    color: #fff;
}
.btn-update:hover {
    background: linear-gradient(90deg, #5b86e5 0%, #36d1c4 100%);
    transform: translateY(-2px) scale(1.04);
}
.btn-back {
    background: #f0f4f8;
    color: #36d1c4;
    border: 1.5px solid #36d1c4;
}
.btn-back:hover {
    background: #36d1c4;
    color: #fff;
    border-color: #36d1c4;
    transform: translateY(-2px) scale(1.04);
}
@media (max-width: 900px) {
    .edit-drug-card { max-width: 99vw; }
}
@media (max-width: 700px) {
    .dashboard-logo { top: 8px; left: 8px; }
    .logo-img { height: 38px; }
    .edit-drug-card { padding: 18px 8px 14px 8px; }
    .form-grid { grid-template-columns: 1fr; }
    .form-row-full { grid-column: 1; }
}
</style>

<div class="edit-drug-bg-wrapper">
    <!-- Background and overlay, always behind content and footer -->
    <div class="edit-drug-bg"></div>
    <div class="edit-drug-bg-overlay"></div>

    <!-- Logo top left for branding -->
    <div class="dashboard-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
    </div>

    <!-- Main content -->
    <div class="edit-drug-container">
        <div class="edit-drug-animated-border"></div>
        <div class="edit-drug-card">
            <div class="edit-drug-header">
                <h2><i class="fa fa-capsules"></i> Edit Drug</h2>
                <div class="edit-drug-greeting">
                    <i class="fa fa-user-md"></i>
                    Hello, <span class="seller-name">{{ Auth::user()->name ?? 'Seller' }}</span>!
                    <span class="greeting-msg">Update your inventory below.</span>
                </div>
            </div>
            @if(session('success'))
                <div class="alert-success"><i class="fa fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-error">
                    <i class="fa fa-exclamation-triangle"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('seller.drugs.update', $drug) }}" class="edit-drug-form">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-row">
                        <label for="name"><i class="fa fa-capsules"></i> Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $drug->name) }}" required>
                    </div>
                    <div class="form-row">
                        <label for="brand"><i class="fa fa-tag"></i> Brand</label>
                        <input type="text" name="brand" id="brand" value="{{ old('brand', $drug->brand) }}" required>
                    </div>
                    <div class="form-row">
                        <label for="category"><i class="fa fa-th-list"></i> Category</label>
                        <input type="text" name="category" id="category" value="{{ old('category', $drug->category) }}" required>
                    </div>
                    <div class="form-row">
                        <label for="dosage_form"><i class="fa fa-pills"></i> Dosage Form</label>
                        <input type="text" name="dosage_form" id="dosage_form" value="{{ old('dosage_form', $drug->dosage_form) }}" required>
                    </div>
                    <div class="form-row">
                        <label for="strength"><i class="fa fa-vial"></i> Strength</label>
                        <input type="text" name="strength" id="strength" value="{{ old('strength', $drug->strength) }}" required>
                    </div>
                    <div class="form-row">
                        <label for="quantity"><i class="fa fa-boxes-stacked"></i> Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $drug->quantity) }}" required min="1">
                    </div>
                    <div class="form-row">
                        <label for="price"><i class="fa fa-money-bill-wave"></i> Price (ETB)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $drug->price) }}" required min="0">
                    </div>
                    <div class="form-row">
                        <label for="expiry_date"><i class="fa fa-calendar-alt"></i> Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date', $drug->expiry_date) }}" required>
                    </div>
                    <div class="form-row form-row-full">
                        <label for="description"><i class="fa fa-info-circle"></i> Description</label>
                        <textarea name="description" id="description" rows="2">{{ old('description', $drug->description) }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-update">
                        <i class="fa fa-save"></i> Update Drug
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

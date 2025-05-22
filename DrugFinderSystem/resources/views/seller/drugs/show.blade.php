@extends('layouts.sellers')

@section('content')
<style>
.background-overlay {
    position: absolute;
    inset: 0;
    z-index: 0;
    background: linear-gradient(120deg, #f8fafc 60%, #e0e7ff 100%);
    animation: fadeInDrugBg 0.8s;
    min-height: 100vh;
    width: 100%;
}
@keyframes fadeInDrugBg {
    from { opacity: 0; }
    to { opacity: 1; }
}
.orbit-border {
    position: absolute;
    top: 10%; left: 80%;
    width: 180px; height: 180px;
    background: radial-gradient(circle, #ffb34733 60%, transparent 100%);
    border-radius: 50%;
    z-index: 0;
    filter: blur(16px);
    animation: orbitMoveDrug 9s linear infinite alternate;
}
@keyframes orbitMoveDrug {
    0% { transform: translate(-30px, 0);}
    100% { transform: translate(20px, 30px);}
}
.drug-details-outer {
    position: relative;
    z-index: 1;
    max-width: 700px;
    margin: 0 auto;
    padding: 110px 1rem 50px 1rem;
    min-height: 60vh;
}
.drug-details-card {
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 8px 32px rgba(32, 56, 112, 0.13), 0 1.5px 4px rgba(80, 80, 120, 0.08);
    padding: 2.5rem 2rem 2rem 2rem;
    position: relative;
    animation: fadeInDrugCard 0.8s;
    overflow: hidden;
}
@keyframes fadeInDrugCard {
    from { opacity: 0; transform: translateY(30px);}
    to { opacity: 1; transform: translateY(0);}
}
.drug-details-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2575fc;
    letter-spacing: 1px;
    text-align: center;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.7rem;
    z-index: 2;
    position: relative;
    animation: popInDrugTitle 0.7s;
}
@keyframes popInDrugTitle {
    from { opacity: 0; transform: scale(0.95);}
    to { opacity: 1; transform: scale(1);}
}
.drug-details-icon {
    color: #ffb347;
    font-size: 1.3em;
    animation: iconBounceDrug 1.2s infinite alternate;
}
@keyframes iconBounceDrug {
    0% { transform: translateY(0);}
    100% { transform: translateY(-6px);}
}
.drug-details-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 0.7rem 1.2rem;
    margin-bottom: 2rem;
}
@media (max-width: 700px) {
    .drug-details-grid { grid-template-columns: 1fr; }
}
.drug-details-label {
    font-weight: 600;
    color: #2575fc;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.08rem;
    background: #f7faff;
    border-radius: 8px;
    padding: 0.5rem 0.8rem;
    margin-bottom: 2px;
}
.drug-details-value {
    color: #444;
    font-size: 1.08rem;
    background: #f7faff;
    border-radius: 8px;
    padding: 0.5rem 0.8rem;
    margin-bottom: 2px;
    word-break: break-word;
}
.icon-img-anim {
    width: 18px;
    height: 18px;
    vertical-align: middle;
    margin-right: 4px;
    animation: iconPulseDrug 1.5s infinite alternate;
}
@keyframes iconPulseDrug {
    0% { opacity: 1; transform: scale(1);}
    100% { opacity: 0.7; transform: scale(1.13);}
}
.drug-details-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 2rem;
}
.drug-details-actions .btn {
    background: #e0e7ff;
    color: #2575fc;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    padding: 0.7rem 1.7rem;
    font-size: 1.05rem;
    box-shadow: 0 2px 8px rgba(37,117,252,0.09);
    transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
    text-decoration: none;
    display: inline-block;
}
.drug-details-actions .btn:hover {
    background: #2575fc;
    color: #fff;
    box-shadow: 0 4px 16px rgba(37,117,252,0.13);
    transform: translateY(-2px) scale(1.03);
}
</style>

<div style="position:relative; min-height:60vh;">
    <div class="background-overlay"></div>
    <div class="orbit-border"></div>

    <div class="drug-details-outer">
        <div class="drug-details-card" role="region" aria-label="Drug Details Card">
            <h2 class="drug-details-title">
                <span class="drug-details-icon"><i class="fa fa-capsules"></i></span>
                Drug Details
            </h2>
            <div class="drug-details-grid">
                <div class="drug-details-label"><i class="fa fa-capsules"></i> Name</div>
                <div class="drug-details-value">{{ $drug->name }}</div>
                <div class="drug-details-label"><i class="fa fa-tag"></i> Brand</div>
                <div class="drug-details-value">{{ $drug->brand }}</div>
                <div class="drug-details-label"><i class="fa fa-th-list"></i> Category</div>
                <div class="drug-details-value">{{ $drug->category }}</div>
                <div class="drug-details-label"><i class="fa fa-pills"></i> Dosage Form</div>
                <div class="drug-details-value">{{ $drug->dosage_form }}</div>
                <div class="drug-details-label">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="icon-img-anim" alt="Strength Icon">
                    Strength
                </div>
                <div class="drug-details-value">{{ $drug->strength }}</div>
                <div class="drug-details-label"><i class="fa fa-boxes-stacked"></i> Quantity</div>
                <div class="drug-details-value">{{ $drug->quantity }}</div>
                <div class="drug-details-label">
                    <img src="https://cdn-icons-png.flaticon.com/512/1048/1048953.png" class="icon-img-anim" alt="Price Icon">
                    Price
                </div>
                <div class="drug-details-value">ETB {{ $drug->price }}</div>
                <div class="drug-details-label"><i class="fa fa-calendar-alt"></i> Expiry Date</div>
                <div class="drug-details-value">{{ $drug->expiry_date }}</div>
                <div class="drug-details-label"><i class="fa fa-info-circle"></i> Description</div>
                <div class="drug-details-value">{{ $drug->description }}</div>
                <div class="drug-details-label">
                    <img src="https://cdn-icons-png.flaticon.com/512/2921/2921822.png" class="icon-img-anim" alt="Added Icon">
                    Added At
                </div>
                <div class="drug-details-value">{{ $drug->created_at }}</div>
            </div>
            <div class="drug-details-actions">
                <a href="{{ route('seller.drugs.index') }}" class="btn">
                    <i class="fa fa-arrow-left"></i> Back to Drugs List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
.drug-details-bg {
    background: linear-gradient(rgba(37,117,252,0.08), rgba(106,17,203,0.10)),
        url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
    padding: 2.2rem 1rem 1.5rem 1rem;
    border-radius: 18px;
    box-shadow: 0 8px 36px rgba(37,117,252,0.13);
    animation: fadeInUp 0.8s cubic-bezier(.4,2,.6,1) both;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px);}
    to { opacity: 1; transform: translateY(0);}
}
.drug-details-table {
    width: 100%;
    background: rgba(255,255,255,0.97);
    border-radius: 12px;
    box-shadow: 0 2px 16px #2575fc22;
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0 0.5rem;
}
.drug-details-cell {
    padding: 1.1rem 0.7rem;
    text-align: center;
    border-radius: 12px;
    background: linear-gradient(90deg, #f5faff 0%, #e3eefd 100%);
    box-shadow: 0 1px 8px #6a11cb11;
    min-width: 130px;
}
.drug-details-icon {
    font-size: 1.5rem;
    color: #2575fc;
    filter: drop-shadow(0 0 6px #6a11cb44);
    margin-bottom: 0.2rem;
    display: block;
}
.drug-details-label {
    font-size: 0.97rem;
    color: #6a11cb;
    font-weight: 600;
    margin-bottom: 0.15rem;
    letter-spacing: 0.01em;
}
.drug-details-value {
    font-size: 1.15rem;
    color: #2575fc;
    font-weight: 700;
    text-shadow: 0 2px 6px #6a11cb22;
}
.drug-details-desc-row td {
    background: #f7fafd;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 1px 8px #2575fc11;
    padding-top: 1.2rem;
}
.seller-details-badge {
    background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 0.4rem 1.2rem;
    margin-bottom: 1rem;
    display: inline-block;
    box-shadow: 0 2px 8px #2575fc33;
    font-size: 1.08rem;
    letter-spacing: 0.01em;
}
.seller-details-icon {
    color: #25fc75;
    margin-right: 0.6em;
}
@media (max-width: 767px) {
    .drug-details-table, .drug-details-cell {
        font-size: 0.95rem;
        padding: 0.5rem 0.2rem;
    }
}
</style>

<div class="drug-details-bg">
    <div class="text-center mb-3">
        <span class="seller-details-badge">
            <i class="fas fa-store seller-details-icon"></i>
            {{ $drug->seller->shop_name ?? $drug->seller->name ?? 'N/A' }}
            <span style="font-size:0.95em; color:#e3eefd;">
                ({{ $drug->seller->city ?? $drug->seller->address ?? 'N/A' }})
            </span>
        </span>
    </div>
    <table class="drug-details-table">
        <tr>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-capsules"></i></span>
                <div class="drug-details-label">Drug Name</div>
                <div class="drug-details-value">{{ $drug->name }}</div>
            </td>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-copyright"></i></span>
                <div class="drug-details-label">Brand</div>
                <div class="drug-details-value">{{ $drug->brand ?? 'N/A' }}</div>
            </td>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-layer-group"></i></span>
                <div class="drug-details-label">Category</div>
                <div class="drug-details-value">{{ $drug->category ?? 'N/A' }}</div>
            </td>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-pills"></i></span>
                <div class="drug-details-label">Dosage Form</div>
                <div class="drug-details-value">{{ $drug->dosage_form ?? 'N/A' }}</div>
            </td>
        </tr>
        <tr>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-vial"></i></span>
                <div class="drug-details-label">Strength</div>
                <div class="drug-details-value">{{ $drug->strength ?? 'N/A' }}</div>
            </td>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-boxes"></i></span>
                <div class="drug-details-label">Quantity</div>
                <div class="drug-details-value">{{ $drug->quantity ?? 'N/A' }}</div>
            </td>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-money-bill-wave"></i></span>
                <div class="drug-details-label">Price</div>
                <div class="drug-details-value">{{ number_format($drug->price, 2) }} ETB</div>
            </td>
            <td class="drug-details-cell">
                <span class="drug-details-icon"><i class="fas fa-calendar-alt"></i></span>
                <div class="drug-details-label">Expiry Date</div>
                <div class="drug-details-value">{{ $drug->expiry_date ?? 'N/A' }}</div>
            </td>
        </tr>
        <tr class="drug-details-desc-row">
            <td colspan="4">
                <div class="drug-details-label mb-1"><i class="fas fa-info-circle"></i> Description</div>
                <div>{{ $drug->description ?? 'No description provided.' }}</div>
            </td>
        </tr>
    </table>
    <div class="mt-4 text-center">
        <span class="badge badge-info" style="background:#25fc75;color:#2575fc;font-weight:700;">
            <i class="fas fa-phone-alt"></i> Contact: {{ $drug->seller->contact_number ?? $drug->seller->phone ?? 'N/A' }}
        </span>
        @if($drug->seller->website)
            <a href="{{ $drug->seller->website }}" class="badge badge-primary ml-2" target="_blank" style="background:#2575fc;">
                <i class="fas fa-globe"></i> Website
            </a>
        @endif
    </div>
</div>

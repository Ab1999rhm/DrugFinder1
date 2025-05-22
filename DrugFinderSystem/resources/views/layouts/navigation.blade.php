<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<nav class="bg-white border-b border-gray-100 pharmacy-nav" style="position: relative; z-index: 10;">
    <div class="pharmacy-nav-bg"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center">

            <!-- Back and Forward Buttons -->
            <div class="pharmacy-nav-controls" style="display:flex; justify-content:center; gap:1.5em; margin-top:10px;">
                <button type="button" class="btn btn-light" onclick="window.history.back()" title="Back">
                    <i class="fa fa-arrow-left"></i> Back
                </button>
                <button type="button" class="btn btn-light" onclick="window.history.forward()" title="Forward">
                    Forward <i class="fa fa-arrow-right"></i>
                </button>
            </div>

            <!-- Animated Drug Store Images & Icons -->
            <div class="pharmacy-icons-row">
                <!-- Hospital Image -->
                <span class="icon-animate">
                    <img src="/images/hospital.jpg"
                         alt="Hospital" title="Hospital" class="pharmacy-img">
                </span>
                <!-- Doctor Image -->
                <span class="icon-animate">
                    <img src="https://images.unsplash.com/photo-1550831107-1553da8c8464?auto=format&fit=crop&w=80&q=80"
                         alt="Doctor" title="Doctor" class="pharmacy-img">
                </span>
                <!-- Pharmacist Icon -->
                <span class="icon-animate">
                    <img src="/images/Doctor.jpg"
                         alt="Pharmacist" title="Pharmacist" class="pharmacy-img">
                </span>
                <!-- Microscope Icon -->
                <span class="icon-animate">
                    <img src="/images/mic.jpg"
                         alt="Microscope" title="Microscope" class="pharmacy-img">
                </span>
                <!-- Drug/Pills Icon -->
                <span class="icon-animate">
                    <img src="/images/drugs.jpg"
                         alt="Pills" title="Drugs" class="pharmacy-img">
                </span>
                <!-- Prescription Bottle Icon -->
                <span class="icon-animate">
                    <i class="fa fa-prescription-bottle-alt fa-2x text-blue-500"></i>
                </span>
                <!-- Stethoscope Icon -->
                <span class="icon-animate">
                    <i class="fa fa-stethoscope fa-2x text-green-500"></i>
                </span>
            </div>
        </div>
    </div>
</nav>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
@endpush

<style>
.pharmacy-nav {
    box-shadow: 0 2px 16px 0 rgba(54, 209, 196, 0.09);
    overflow: visible;
    position: relative;
}
.pharmacy-nav-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    background: linear-gradient(90deg,rgb(44, 166, 89) 0%, #f0f4f8 100%);
    opacity: 0.93;
    pointer-events: none;
}
.pharmacy-icons-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 48px;
    margin: 18px 0 10px 0;
    width: 100%;
}
.pharmacy-icons-row span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    animation: iconPop 2.8s cubic-bezier(.5,1.6,.5,1) infinite;
    margin-right: 0.1em;
    filter: drop-shadow(0 2px 8px rgba(54,209,196,0.07));
    transition: transform 0.18s;
}
.pharmacy-icons-row span:hover {
    transform: scale(1.16) rotate(-8deg);
    filter: drop-shadow(0 4px 16px rgba(91,134,229,0.18));
}
.pharmacy-icons-row span:nth-child(2) { animation-delay: 0.3s; }
.pharmacy-icons-row span:nth-child(3) { animation-delay: 0.6s; }
.pharmacy-icons-row span:nth-child(4) { animation-delay: 0.9s; }
.pharmacy-icons-row span:nth-child(5) { animation-delay: 1.2s; }
.pharmacy-icons-row span:nth-child(6) { animation-delay: 1.5s; }
.pharmacy-icons-row span:nth-child(7) { animation-delay: 1.8s; }
.pharmacy-img {
    width: 130px;
    height: 140px;
    border-radius: 14px;
    object-fit: cover;
    box-shadow: 0 1px 6px rgba(44,62,80,0.09);
    border: 2.5px solid #e0f7fa;
    background: #fff;
    transition: transform 0.18s;
}
@media (max-width: 700px) {
    .pharmacy-icons-row { gap: 18px; }
    .pharmacy-img { width: 56px; height: 56px; }
}

@keyframes iconPop {
    0%, 100% { transform: translateY(0) scale(1);}
    10% { transform: translateY(-6px) scale(1.09);}
    20% { transform: translateY(0) scale(1);}
}
@media (max-width: 700px) {
    .pharmacy-icons-row { gap: 18px; }
    .pharmacy-img { width: 50px; height: 50px; }
}
</style>

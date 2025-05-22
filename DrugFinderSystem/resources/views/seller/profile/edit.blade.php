@extends('layouts.sellers')

@section('content')
<!-- Seller Profile Edit Page -->
<style>
/* Seller Profile Edit - Consistent with Dashboard Theme */
.seller-profile-bg {
    background: linear-gradient(120deg, #f8fafc 60%, #e0e7ff 100%);
    min-height: 100vh;
    position: relative;
    z-index: 1;
    padding: 60px 0 40px 0;
}
.seller-profile-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(120deg, #6a11cb33 0%, #2575fc22 100%);
    z-index: 2;
    pointer-events: none;
}
.seller-profile-orbit {
    position: absolute;
    top: 10%; left: 80%;
    width: 180px; height: 180px;
    background: radial-gradient(circle, #ffb34722 50%, transparent 100%);
    border-radius: 50%;
    z-index: 2;
    filter: blur(12px);
    animation: seller-orbit-move 9s linear infinite alternate;
}
@keyframes seller-orbit-move {
    0% { transform: translate(-30px, 0);}
    100% { transform: translate(20px, 30px);}
}
.seller-profile-container {
    position: relative;
    z-index: 3;
    max-width: 700px;
    margin: 0 auto;
    padding: 0 1rem;
}
.seller-profile-card {
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 8px 32px rgba(32, 56, 112, 0.13), 0 1.5px 4px rgba(80, 80, 120, 0.08);
    padding: 2.5rem 2rem 2rem 2rem;
    margin-top: 40px;
    position: relative;
    animation: seller-profile-fadeIn 0.8s;
}
@keyframes seller-profile-fadeIn {
    0% { opacity: 0; transform: translateY(30px);}
    100% { opacity: 1; transform: translateY(0);}
}
.profile-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2575fc;
    margin-bottom: 1.5rem;
    letter-spacing: 1px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.7rem;
}
.icon-bounce {
    display: inline-block;
    animation: seller-profile-bounce 1.2s infinite alternate;
}
@keyframes seller-profile-bounce {
    0% { transform: translateY(0);}
    100% { transform: translateY(-6px);}
}
.animate-pop {
    animation: seller-profile-popIn 0.7s;
}
@keyframes seller-profile-popIn {
    0% { opacity: 0; transform: scale(0.95);}
    100% { opacity: 1; transform: scale(1);}
}
.profile-success, .profile-error {
    padding: 0.8rem 1.2rem;
    border-radius: 12px;
    margin-bottom: 1rem;
    font-weight: 500;
    font-size: 1rem;
    text-align: center;
    box-shadow: 0 2px 10px rgba(67,206,162,0.10);
}
.profile-success {
    background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
    color: #fff;
}
.profile-error {
    background: linear-gradient(90deg, #ff5858 0%, #ffb347 100%);
    color: #fff;
}
.profile-form {
    margin-top: 1.5rem;
}
.profile-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.3rem 1.5rem;
}
@media (max-width: 700px) {
    .profile-grid { grid-template-columns: 1fr; }
}
.profile-field {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
    position: relative;
}
.profile-field label {
    font-weight: 600;
    color: #2575fc;
    font-size: 1.03rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.2rem;
}
.icon-pulse {
    display: inline-block;
    color: #ffb347;
    animation: seller-profile-pulse 1.5s infinite alternate;
}
@keyframes seller-profile-pulse {
    0% { opacity: 1; transform: scale(1);}
    100% { opacity: 0.7; transform: scale(1.13);}
}
.profile-field input[type="text"],
.profile-field input[type="url"],
.profile-field input[type="date"],
.profile-field input[type="file"],
.profile-field textarea {
    padding: 0.55rem 0.9rem;
    border: 1.5px solid #e0e7ff;
    border-radius: 8px;
    font-size: 1rem;
    background: #f7faff;
    color: #222;
    transition: border-color 0.2s, box-shadow 0.2s;
    font-family: inherit;
    box-shadow: 0 1.5px 6px rgba(37,117,252,0.05);
}
.profile-field input[type="file"] {
    background: #fff;
}
.profile-field input:focus,
.profile-field textarea:focus {
    border-color: #2575fc;
    outline: none;
    box-shadow: 0 0 0 2px #2575fc22;
}
.profile-field textarea {
    min-height: 80px;
    resize: vertical;
}
.profile-bio {
    grid-column: 1 / -1;
}
.profile-img-preview {
    margin-top: 0.5rem;
    max-width: 120px;
    max-height: 120px;
    border-radius: 50%;
    border: 2.5px solid #2575fc22;
    box-shadow: 0 2px 8px rgba(37,117,252,0.09);
    display: block;
    animation: seller-profile-popIn 0.7s;
}
.btn-profile-update {
    margin-top: 2rem;
    background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
    color: #fff;
    font-weight: 700;
    border: none;
    border-radius: 10px;
    padding: 0.8rem 2.2rem;
    font-size: 1.13rem;
    box-shadow: 0 4px 16px rgba(37,117,252,0.13);
    transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.btn-profile-update:hover {
    background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
    box-shadow: 0 8px 24px rgba(37,117,252,0.23);
    transform: translateY(-2px) scale(1.06);
}
</style>
<!-- Seller Profile Edit Page -->
<div class="seller-profile-bg">
    <div class="seller-profile-overlay"></div>
    <div class="seller-profile-orbit"></div>
    <div class="seller-profile-container">
        <div class="seller-profile-card">
            <h2 class="profile-title animate-pop">
                <span class="icon-bounce"><i class="fa fa-user-edit"></i></span> Edit Profile
            </h2>
            @if(session('success'))
                <div class="profile-success animate-pop">
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="profile-error animate-pop">
                    <i class="fa fa-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="{{ route('seller.profile.update') }}" enctype="multipart/form-data" class="profile-form">
                @csrf
                <div class="profile-grid">
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-user"></i></span>
                            <span>Name</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $seller->name) }}" required>
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-phone"></i></span>
                            <span>Phone</span>
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', $seller->phone) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-map-marker-alt"></i></span>
                            <span>Address</span>
                        </label>
                        <input type="text" name="address" value="{{ old('address', $seller->address) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-building"></i></span>
                            <span>Company Name</span>
                        </label>
                        <input type="text" name="company_name" value="{{ old('company_name', $seller->company_name) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-globe"></i></span>
                            <span>Website</span>
                        </label>
                        <input type="url" name="website" value="{{ old('website', $seller->website) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-image"></i></span>
                            <span>Profile Image</span>
                        </label>
                        <input type="file" name="profile_image" accept="image/*">
                        @if($seller->profile_image)
                            <img src="{{ asset('storage/'.$seller->profile_image) }}" alt="Profile Image" class="profile-img-preview animate-pop">
                        @endif
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-university"></i></span>
                            <span>Bank Account</span>
                        </label>
                        <input type="text" name="bank_account" value="{{ old('bank_account', $seller->bank_account) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-id-card"></i></span>
                            <span>Tax ID</span>
                        </label>
                        <input type="text" name="tax_id" value="{{ old('tax_id', $seller->tax_id) }}">
                    </div>
                    <div class="profile-field profile-bio">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-info-circle"></i></span>
                            <span>Bio</span>
                        </label>
                        <textarea name="bio">{{ old('bio', $seller->bio) }}</textarea>
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-birthday-cake"></i></span>
                            <span>Date of Birth</span>
                        </label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $seller->date_of_birth) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-city"></i></span>
                            <span>City</span>
                        </label>
                        <input type="text" name="city" value="{{ old('city', $seller->city) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-flag"></i></span>
                            <span>State</span>
                        </label>
                        <input type="text" name="state" value="{{ old('state', $seller->state) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-globe-africa"></i></span>
                            <span>Country</span>
                        </label>
                        <input type="text" name="country" value="{{ old('country', $seller->country) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-mail-bulk"></i></span>
                            <span>Postal Code</span>
                        </label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $seller->postal_code) }}">
                    </div>
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-user-shield"></i></span>
                            <span>Emergency Contact</span>
                        </label>
                        <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $seller->emergency_contact) }}">
                    </div>
                    <!-- FIXED: Longitude field -->
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-map-marker-alt"></i></span>
                            <span>Longitude of your address</span>
                        </label>
                        <input type="text" name="longitude" value="{{ old('longitude', $seller->longitude) }}">
                    </div>
                    <!-- FIXED: Latitude field -->
                    <div class="profile-field">
                        <label>
                            <span class="icon-pulse"><i class="fa fa-map-marker-alt"></i></span>
                            <span>Latitude of your address</span>
                        </label>
                        <input type="text" name="latitude" value="{{ old('latitude', $seller->latitude) }}">
                    </div>
                </div>
                <button type="submit" class="btn-profile-update animate-pop">
                    <i class="fa fa-save"></i> Update Profile
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

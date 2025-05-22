@extends('layouts.sellers')

@section('title', 'index Drug')

@section('content')
<div class="drug-bg">
    <!-- Glassy overlay for glassmorphism effect -->
    <div class="drug-bg-glass"></div>
    <!-- Top-left logo branding -->
    <div class="dashboard-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img" title="Your Pharmacy">
    </div>
    <!-- Orbiting border animation -->
    <div class="orbit-border"></div>

    <div class="drug-container">
        <div class="drug-header">
            <h2>
                <img src="https://cdn-icons-png.flaticon.com/512/2921/2921822.png" style="width:36px;vertical-align:middle;margin-right:8px;">
                Your Drugs Inventory
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" style="width:28px;vertical-align:middle;margin-left:8px;">
            </h2>
            <div class="top-actions">
                
                <a href="{{ route('seller.drugs.create') }}" class="btn btn-add" title="Add New Drug">
                    <img src="https://cdn-icons-png.flaticon.com/512/1048/1048953.png" style="width:19px;vertical-align:middle;margin-right:5px;">
                    Add New Drug
                </a>
                @if($drugs->count())
                    @php $lastDrug = $drugs->last(); @endphp
                    <a href="{{ route('seller.drugs.show', $lastDrug) }}" class="btn btn-view" title="View Last Drug">
                        <i class="fa fa-eye"></i>
                        View
                    </a>
                    <a href="{{ route('seller.drugs.edit', $lastDrug) }}" class="btn btn-edit" title="Edit Last Drug">
                        <i class="fa fa-edit"></i>
                        Edit
                    </a>
                    <form action="{{ route('seller.drugs.destroy', $lastDrug) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this drug?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" title="Delete Last Drug">
                            <i class="fa fa-trash"></i>
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @if(session('success'))
            <div class="alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($drugs->count())
            <table class="drug-table">
                <thead>
                    <tr>
                        <th><i class="fa fa-capsules"></i> Name</th>
                        <th><i class="fa fa-tag"></i> Brand</th>
                        <th><i class="fa fa-th-list"></i> Category</th>
                        <th><i class="fa fa-pills"></i> Dosage</th>
                        <th>
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" style="width:16px;vertical-align:middle;"> Strength
                        </th>
                        <th><i class="fa fa-boxes-stacked"></i> Qty</th>
                        <th><i class="fa fa-money-bill-wave"></i> Price</th>
                        <th><i class="fa fa-calendar-alt"></i> Expiry</th>
                        <th><i class="fa fa-info-circle"></i> Description</th>
                        <th><i class="fa fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drugs as $drug)
                    <tr class="fade-in">
                        <td>
                            <img src="https://cdn-icons-png.flaticon.com/512/1048/1048953.png" style="width:16px;vertical-align:middle;margin-right:3px;">
                            {{ $drug->name }}
                        </td>
                        <td>{{ $drug->brand }}</td>
                        <td>{{ $drug->category }}</td>
                        <td>{{ $drug->dosage_form }}</td>
                        <td>
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" style="width:14px;vertical-align:middle;margin-right:2px;">
                            {{ $drug->strength }}
                        </td>
                        <td>
                            <span class="quantity-badge {{ $drug->quantity < 5 ? 'low' : '' }}">
                                {{ $drug->quantity }}
                            </span>
                        </td>
                        <td>
                            <i class="fa fa-ethereum" style="color:#36d1c4;"></i>
                            ETB {{ number_format($drug->price, 2) }}
                        </td>
                        <td>
                            <span class="expiry {{ \Carbon\Carbon::parse($drug->expiry_date)->isPast() ? 'expired' : '' }}">
                                {{ $drug->expiry_date }}
                            </span>
                        </td>
                        <td>
                            <span title="{{ $drug->description }}">
                                {{ \Illuminate\Support\Str::limit($drug->description, 30) }}
                            </span>
                        </td>
                        <td>
                            
                            <a href="{{ route('seller.drugs.show', $drug) }}" class="btn btn-view" title="View">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('seller.drugs.edit', $drug) }}" class="btn btn-edit" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('seller.drugs.destroy', $drug) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this drug?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="No drugs" width="80">
                <p>
                    <img src="https://cdn-icons-png.flaticon.com/512/2921/2921822.png" style="width:22px;vertical-align:middle;">
                    No drugs found in your inventory.<br>
                    <a href="{{ route('seller.drugs.create') }}" class="btn btn-add">
                        <img src="https://cdn-icons-png.flaticon.com/512/1048/1048953.png" style="width:17px;vertical-align:middle;margin-right:4px;">
                        Add your first drug!
                    </a>
                </p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
@endpush

<style>
:root {
  /* Modern, cool palette for inventory management */
  --primary: #2c8cfb;
  --primary-light: #5cacfa;
  --secondary: #2c4c71;
  --accent: #446285;
  --muted: #a5b8cc;
  --grey: #5c6468;
  --success: #4caf50;
  --danger: #e53935;
  --warning: #ffc107;
  --bg-glass: rgba(255,255,255,0.88);
  --table-head: #f0f4f8;
  --table-border: #e0e6ed;
  --white: #fff;
  --shadow: 0 8px 32px rgba(44, 62, 80, 0.18), 0 2px 8px rgba(44, 140, 251, 0.13);
}

body {
  background: linear-gradient(135deg, var(--primary-light) 0%, var(--muted) 100%);
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}

.drug-bg {
  min-height: 100vh;
  width: 100vw;
  background: url('https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?auto=format&fit=crop&w=1500&q=80') center center / cover no-repeat;
  position: relative;
  overflow-x: hidden;
}

.drug-bg-glass {
  position: absolute;
  inset: 0;
  width: 100vw; height: 100%;
  background: var(--bg-glass);
  backdrop-filter: blur(10px) saturate(120%);
  -webkit-backdrop-filter: blur(10px) saturate(120%);
  z-index: 1;
  pointer-events: none;
  animation: fadeInGlass 1.2s;
}

@keyframes fadeInGlass {
  from { opacity: 0; }
  to { opacity: 1; }
}

.dashboard-logo {
  position: absolute;
  top: 24px;
  left: 38px;
  z-index: 10;
  animation: fadeIn 1s;
}

.logo-img {
  height: 54px;
  width: auto;
  border-radius: 10px;
  box-shadow: 0 2px 8px var(--primary-light);
  transition: box-shadow 0.18s, transform 0.18s;
}
.logo-img:hover {
  box-shadow: 0 6px 18px var(--primary);
  transform: scale(1.05) rotate(-2deg);
}

.orbit-border {
  pointer-events: none;
  position: absolute;
  top: 50%; left: 50%;
  width: 670px; height: 670px;
  transform: translate(-50%, -50%);
  border-radius: 50%;
  z-index: 2;
  background: conic-gradient(from 0deg, var(--primary) 0%, var(--primary-light) 60%, var(--primary) 100%);
  opacity: 0.25;
  filter: blur(18px);
  animation: orbitSpin 7s linear infinite;
}
@keyframes orbitSpin {
  0% { transform: translate(-50%, -50%) rotate(0deg);}
  100% { transform: translate(-50%, -50%) rotate(360deg);}
}

.drug-container {
  max-width: 1200px;
  margin: 64px auto 36px auto;
  background: var(--bg-glass);
  border-radius: 24px;
  box-shadow: var(--shadow);
  padding: 42px 40px;
  animation: fadeInUp 0.9s;
  position: relative;
  z-index: 5;
  overflow-x: auto;
  backdrop-filter: blur(7px) saturate(130%);
  -webkit-backdrop-filter: blur(7px) saturate(130%);
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.drug-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 22px;
  flex-wrap: wrap;
  gap: 12px;
}

.top-actions {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

h2 {
  margin: 0;
  font-weight: 700;
  color: var(--secondary);
  letter-spacing: 1px;
  font-size: 2em;
  display: flex;
  align-items: center;
  gap: 8px;
  animation: colorPulse 4s infinite alternate;
}

@keyframes colorPulse {
  0% { color: var(--secondary);}
  100% { color: var(--primary);}
}

.btn {
  border: none;
  border-radius: 7px;
  padding: 9px 20px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  margin: 2px 0;
  transition: background 0.2s, box-shadow 0.2s, transform 0.12s;
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 1.08em;
  box-shadow: 0 2px 8px var(--primary-light);
  outline: none;
}
.btn-add {
  background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
  color: #fff;
  font-size: 1.08em;
  box-shadow: 0 2px 8px var(--primary-light);
  animation: btnGlow 2.5s infinite alternate;
}
@keyframes btnGlow {
  0% { box-shadow: 0 2px 8px var(--primary-light);}
  100% { box-shadow: 0 4px 16px var(--primary);}
}
.btn-add:hover, .btn-add:focus {
  background: linear-gradient(90deg, var(--primary-light) 0%, var(--primary) 100%);
  transform: translateY(-2px) scale(1.06);
}

.btn-view {
  background: var(--success);
  color: #fff;
}
.btn-view:hover, .btn-view:focus { background: #388e3c; }

.btn-edit {
  background: var(--warning);
  color: #222;
}
.btn-edit:hover, .btn-edit:focus { background: #ffb300; }

.btn-delete {
  background: var(--danger);
  color: #fff;
  animation: shake 2.5s infinite alternate;
}
.btn-delete:hover, .btn-delete:focus { background: #b71c1c; }

@keyframes shake {
  0%, 100% { transform: translateX(0);}
  20% { transform: translateX(-2px);}
  40% { transform: translateX(2px);}
  60% { transform: translateX(-2px);}
  80% { transform: translateX(2px);}
}

.alert-success {
  background: #e6f4ea;
  color: var(--success);
  border-left: 5px solid var(--primary);
  padding: 10px 18px;
  border-radius: 7px;
  margin-bottom: 18px;
  font-weight: 500;
  animation: fadeIn 0.7s;
}

.drug-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  background: var(--white);
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 1px 4px var(--muted);
  font-size: 1em;
}

.drug-table th, .drug-table td {
  padding: 12px 10px;
  text-align: left;
  vertical-align: middle;
}

.drug-table th {
  background: var(--table-head);
  color: var(--secondary);
  font-weight: 700;
  border-bottom: 2px solid var(--table-border);
}

.drug-table tr {
  transition: background 0.2s;
}

.drug-table tr:hover {
  background: var(--muted);
  color: var(--primary);
  animation: rowHighlight 0.3s;
}

@keyframes rowHighlight {
  from { background: var(--white);}
  to { background: var(--muted);}
}

.quantity-badge {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 18px;
  background: #e3fcec;
  color: var(--success);
  font-weight: 700;
  font-size: 1em;
  min-width: 32px;
  text-align: center;
  transition: background 0.2s, color 0.2s;
}
.quantity-badge.low {
  background: #ffeaea;
  color: var(--danger);
  animation: pulse 1.2s infinite;
}
@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(229,57,53, 0.3);}
  70% { box-shadow: 0 0 0 8px rgba(229,57,53, 0);}
  100% { box-shadow: 0 0 0 0 rgba(229,57,53, 0);}
}

.expiry.expired {
  color: var(--danger);
  font-weight: 700;
  text-decoration: line-through;
  animation: blink 1.5s infinite alternate;
}
@keyframes blink {
  0% { opacity: 1;}
  100% { opacity: 0.5;}
}
.expiry {
  color: var(--success);
  font-weight: 600;
}

.empty-state {
  text-align: center;
  color: var(--grey);
  margin: 40px 0;
  animation: fadeIn 0.8s;
}
.empty-state img {
  margin-bottom: 14px;
  opacity: 0.7;
  filter: drop-shadow(0 4px 12px var(--primary-light));
}

.fade-in {
  animation: fadeIn 0.7s;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(18px);}
  to { opacity: 1; transform: none;}
}
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(40px);}
  to { opacity: 1; transform: none;}
}

/* Responsive Design: Flexbox and Card Layout for Mobile */
@media (max-width: 900px) {
  .drug-container { padding: 14px 2px;}
  .drug-header { flex-direction: column; gap: 10px;}
  .drug-table th, .drug-table td { padding: 8px 6px;}
  .orbit-border { width: 400px; height: 400px; }
}
@media (max-width: 700px) {
  .drug-table { display: none; }
  .drug-table + tbody, .drug-table thead { display: none; }
  .drug-container {
    padding: 8px 1px;
    gap: 8px;
  }
  .drug-header h2 { font-size: 1.2em; }
  .dashboard-logo { top: 8px; left: 8px; }
  .logo-img { height: 38px; }
  /* Card layout for each drug row */
  .drug-table, .drug-table th, .drug-table td { display: block; width: 100%; }
  .drug-table tr {
    margin-bottom: 16px;
    border-radius: 10px;
    box-shadow: 0 1px 4px var(--primary-light);
    background: var(--white);
    display: flex;
    flex-direction: column;
    padding: 14px 8px;
    animation: fadeInUp 0.7s;
  }
  .drug-table td {
    padding: 6px 2px;
    border-bottom: 1px solid var(--muted);
  }
  .drug-table td:last-child { border-bottom: none; }
}

@media (max-width: 500px) {
  .drug-card { padding: 10px 5px; }
  .btn { padding: 8px 10px; font-size: 0.98em;}
}

</style>

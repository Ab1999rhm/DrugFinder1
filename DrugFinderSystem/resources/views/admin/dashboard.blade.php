@extends('layouts.admin')

@section('content')
<style>
    /* Container padding */
    .dashboard-container {
        padding: 2rem 1rem;
    }

    /* Dashboard title */
    h2 {
        font-weight: 700;
        color: #4f46e5; /* Indigo-600 */
        margin-bottom: 2rem;
        text-align: center;
        animation: fadeInDown 0.8s ease forwards;
    }

    .dashboard-container {
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding: 1px;
  /* background: #f8f9fa;  */
  border-radius: 8px;
  max-width: 1000px;
  margin: 0 auto;
}

.dashboard-stats {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 15px;
}

.dashboard-actions {
    display: flex;
  
  gap: 20px;
  padding: 1px;
  /* background: #f8f9fa; */
  border-radius: 8px;
  max-width: 1000px;
  margin: 0 auto;
}

/* Style for all buttons */
.dashboard-actions .btn {
  background-color: #007bff;
  color: white;
  border-radius: 5px;
  padding: 10px 15px;
  text-decoration: none;
  transition: background-color 0.3s ease;
  font-weight: 600;
}

.dashboard-actions .btn:hover {
  background-color: #0056b3;
}

/* Add a Save button column */
.dashboard-actions::after {
  
  display: inline-block;
  background-color: #28a745;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  font-weight: 700;
  cursor: pointer;
  margin-left: auto; /* pushes it to the right */
  user-select: none;
  transition: background-color 0.3s ease;
}

.dashboard-actions::after:hover {
  background-color: #1e7e34;
}

    /* Cards container */
    .dashboard-stats .card {
        border-radius: 1rem;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: default;
        animation: fadeInUp 0.8s ease forwards;
    }
    .dashboard-stats .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.5);
    }

    /* Card header */
    .dashboard-stats h5 {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        letter-spacing: 0.05em;
        text-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    /* Large number */
    .dashboard-stats p.display-4 {
        font-weight: 700;
        font-size: 3.5rem;
        letter-spacing: 0.1em;
        text-shadow: 0 2px 6px rgba(0,0,0,0.3);
        margin: 0;
    }

    /* Buttons container */
    .dashboard-actions {
        text-align: center;
        margin-top: 3rem;
        animation: fadeIn 1s ease forwards;
        
    }

    /* Buttons */
    .dashboard-actions .btn {
        background: linear-gradient(135deg, #4f46e5 0%, #8b5cf6 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.75rem 1.8rem;
        margin: 0 0.5rem 1rem 0.5rem;
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.4);
        transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        display: inline-block;
        min-width: 160px;
    }
    .dashboard-actions .btn:hover,
    .dashboard-actions .btn:focus {
        background: linear-gradient(135deg, #8b5cf6 0%, #4f46e5 100%);
        box-shadow: 0 10px 25px rgba(139, 92, 246, 0.7);
        transform: translateY(-4px);
        outline: none;
        text-decoration: none;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .dashboard-stats .col-md-2 {
            margin-bottom: 1.5rem;
        }
        .dashboard-actions .btn {
            min-width: 100%;
            margin-bottom: 1rem;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>

<div class="container dashboard-container">
    <h2>Admin Dashboard</h2>
    <div class="row dashboard-stats text-center">
        <div class="col-md-2 col-6 mx-auto mx-md-0 mb-4 mb-md-0">
            <div class="card p-4">
                <h5>Users</h5>
                <p class="display-4">{{ $userCount }}</p>
            </div>
        </div>
        <div class="col-md-2 col-6 mx-auto mx-md-0 mb-4 mb-md-0">
            <div class="card p-4">
                <h5>Sellers</h5>
                <p class="display-4">{{ $sellerCount }}</p>
            </div>
        </div>
        <!-- <div class="col-md-2 col-6 mx-auto mx-md-0 mb-4 mb-md-0">
            <div class="card p-4">
                <h5>Pharmacies</h5>
                <p class="display-4">{{ $pharmacyCount }}</p>
            </div>
        </div> -->
        <div class="col-md-2 col-6 mx-auto mx-md-0 mb-4 mb-md-0">
            <div class="card p-4">
                <h5>Drugs</h5>
                <p class="display-4">{{ $drugCount }}</p>
            </div>
        </div>
        <div class="col-md-2 col-6 mx-auto mx-md-0">
            <div class="card p-4">
                <h5>Orders</h5>
                <p class="display-4">{{ $orderCount }}</p>
            </div>
        </div>
    </div>

    <div class="dashboard-actions">
    <a href="{{ route('admin.users') }}" class="btn">Manage Users</a>
        <a href="{{ route('admin.sellers') }}" class="btn">Manage Sellers</a>
        <!-- <a href="{{ route('admin.pharmacies') }}" class="btn">Manage Pharmacies</a> -->
        <a href="{{ route('admin.drugs') }}" class="btn">Manage Drugs</a>
        <a href="{{ route('admin.orders') }}" class="btn">Manage Orders</a>
    </div>
</div>
@endsection

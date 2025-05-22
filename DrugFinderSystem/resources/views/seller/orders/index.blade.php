@extends('layouts.sellers')

@section('content')
<style>
/* Orders Page - Consistent with Dashboard Theme */
.orders-bg-animated {
    min-height: 100vh;
    background: linear-gradient(120deg, #f8fafc 60%, #e0e7ff 100%);
    padding: 70px 0 40px 0;
    position: relative;
    z-index: 1;
    animation: fadeInOrdersBg 0.8s;
}
@keyframes fadeInOrdersBg {
    from { opacity: 0; }
    to { opacity: 1; }
}
.order-card-outer {
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}
.order-card-animated-border {
    position: absolute;
    top: -10px; left: -10px; right: -10px; bottom: -10px;
    border-radius: 28px;
    background: linear-gradient(270deg, #ffb347, #2575fc, #6a11cb, #ff5858, #ffb347);
    background-size: 1200% 1200%;
    filter: blur(10px);
    opacity: 0.17;
    z-index: 0;
    animation: borderMove 16s ease infinite;
    pointer-events: none;
}
@keyframes borderMove {
    0% {background-position:0% 50%}
    50% {background-position:100% 50%}
    100% {background-position:0% 50%}
}
.order-card-inner {
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 8px 32px rgba(32, 56, 112, 0.13), 0 1.5px 4px rgba(80, 80, 120, 0.08);
    padding: 2.5rem 2rem 2rem 2rem;
    position: relative;
    z-index: 2;
    animation: fadeInOrderCard 0.8s;
}
@keyframes fadeInOrderCard {
    from { opacity: 0; transform: translateY(40px);}
    to { opacity: 1; transform: translateY(0);}
}
.orders-title {
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
    animation: popInTitle 0.7s;
}
@keyframes popInTitle {
    from { opacity: 0; transform: scale(0.95);}
    to { opacity: 1; transform: scale(1);}
}
.order-table {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 10px rgba(37,117,252,0.05);
    overflow: hidden;
    margin-bottom: 2rem;
    font-size: 1rem;
}
.order-table th, .order-table td {
    vertical-align: middle;
    padding: 0.7rem 0.9rem;
    border-bottom: 1px solid #e0e7ff;
}
.order-table th {
    background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
    color: #fff;
    font-weight: 600;
    border: none;
}
.order-table tr:last-child td {
    border-bottom: none;
}
.order-item {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    font-size: 0.98em;
    margin-bottom: 0.2rem;
}
.item-name {
    color: #2575fc;
    font-weight: 600;
}
.item-qty {
    color: #ff5858;
    font-weight: 600;
}
.item-price {
    color: #43cea2;
    font-weight: 500;
    font-size: 0.95em;
}
.order-status-badge {
    padding: 0.4em 1em;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1em;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(37,117,252,0.09);
}
.badge-success {
    background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%) !important;
    color: #fff !important;
}
.badge-danger {
    background: linear-gradient(90deg, #ff5858 0%, #ffb347 100%) !important;
    color: #fff !important;
}
.badge-primary {
    background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%) !important;
    color: #fff !important;
}
.btn-gradient, .dropdown-toggle.btn-gradient {
    background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
    color: #fff;
    border: none;
    font-weight: 600;
    border-radius: 8px;
    padding: 0.4rem 1.1rem;
    box-shadow: 0 2px 10px rgba(37,117,252,0.09);
    transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
}
.btn-gradient:hover, .dropdown-toggle.btn-gradient:hover {
    background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
    color: #fff;
    box-shadow: 0 4px 16px rgba(37,117,252,0.15);
    transform: translateY(-2px) scale(1.04);
}
.dropdown-toggle::after {
    margin-left: 0.5em;
}
.dropdown-menu {
    min-width: 150px;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(37,117,252,0.09);
    border: none;
    animation: fadeInDropdown 0.2s;
    background-color: #ffb347;
}
@keyframes fadeInDropdown {
    from { opacity: 0; transform: translateY(10px);}
    to { opacity: 1; transform: translateY(0);}
}
.dropdown-item.status-update {
    font-weight: 500;
    color: #2575fc;
    transition: background 0.2s, color 0.2s;
}
.dropdown-item.status-update:hover {
    background:rgba(11, 147, 95, 0.84);
    color:rgb(228, 17, 17);
}
.orders-pagination {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
}
.orders-pagination .pagination {
    --bs-pagination-bg: #fff;
    --bs-pagination-border-color: #e0e7ff;
    --bs-pagination-hover-bg: #e0e7ff;
    --bs-pagination-active-bg: #2575fc;
    --bs-pagination-active-border-color: #2575fc;
    --bs-pagination-active-color: #fff;
    border-radius: 10px;
}
.order-toast {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%);
    color: #fff;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.07rem;
    box-shadow: 0 2px 10px rgba(67,206,162,0.13);
    display: none;
    z-index: 9999;
    animation: fadeInToast 0.5s;
}
@keyframes fadeInToast {
    from { opacity: 0; transform: translateY(30px);}
    to { opacity: 1; transform: translateY(0);}
}
#order-status-loader .loader {
    border: 7px solid #e0e7ff;
    border-top: 7px solid #2575fc;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spinLoader 1s linear infinite;
    margin: auto;
}
@keyframes spinLoader {
    0% { transform: rotate(0deg);}
    100% { transform: rotate(360deg);}
}
@media (max-width: 900px) {
    .order-card-inner { padding: 1.2rem 0.5rem; }
}
@media (max-width: 600px) {
    .order-card-inner { padding: 0.5rem 0.2rem; }
    .orders-title { font-size: 1.3rem; }
    .order-table th, .order-table td { font-size: 0.97em; }
}
</style>

<div class="orders-bg-animated">
    <div class="order-card-outer">
        <div class="order-card-animated-border"></div>
        <div class="order-card-inner">
            <h2 class="orders-title mb-4">
                <i class="fa fa-shopping-basket"></i> Order Management
            </h2>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table order-table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ optional($order->user)->name ?? 'N/A' }}</td>
                                <td>
                                    @foreach ($order->items as $item)
                                    <div class="order-item">
                                        <span class="item-name">{{ optional($item->drug)->name ?? 'Unknown Drug' }}</span>
                                        <span class="item-qty">x{{ $item->quantity }}</span>
                                        <span class="item-price">{{ number_format($item->price, 2) }}</span>
                                    </div>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="order-total">{{ number_format($order->total, 2) }}</span>
                                </td>
                                <td>
                                    <span class="badge order-status-badge
                                        @if($order->status == 'completed') badge-success
                                        @elseif($order->status == 'cancelled') badge-danger
                                        @else badge-primary @endif
                                        ">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-gradient dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="dropdown-text">Change Status</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item status-update" href="#" data-status="pending">Pending</a>
                                            <a class="dropdown-item status-update" href="#" data-status="processing">Processing</a>
                                            <a class="dropdown-item status-update" href="#" data-status="completed">Complete</a>
                                            <a class="dropdown-item status-update" href="#" data-status="cancelled">Cancel</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <i class="fa fa-box-open"></i> No orders found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                </div>
                <div class="orders-pagination">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loader Modal -->
<div id="order-status-loader" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;background:rgba(255,255,255,0.5);align-items:center;justify-content:center;">
    <div class="loader"></div>
</div>
<!-- Toast for status feedback -->
<div id="order-toast" class="order-toast"></div>

<!-- Optional: JS for status update feedback (Toast/Loader) -->
<script>
function showOrderLoader(show = true) {
    document.getElementById('order-status-loader').style.display = show ? 'flex' : 'none';
}
function showOrderToast(msg) {
    var toast = document.getElementById('order-toast');
    toast.textContent = msg;
    toast.style.display = 'block';
    setTimeout(() => { toast.style.display = 'none'; }, 2500);
}
// Example: update status (replace with your AJAX logic)
document.querySelectorAll('.status-update').forEach(function(btn){
    btn.addEventListener('click', function(e){
        e.preventDefault();
        showOrderLoader(true);
        setTimeout(function(){
            showOrderLoader(false);
            showOrderToast('Order status updated!');
        }, 1200);
    });
});
</script>
@endsection

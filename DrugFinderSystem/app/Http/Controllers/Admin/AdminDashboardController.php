<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Seller;
use App\Models\Pharmacy;
use App\Models\Drug;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Dashboard overview counts
    public function index()
    {
        return view('admin.dashboard', [
            'userCount'     => User::count(),
            'sellerCount'   => Seller::count(),
            'pharmacyCount' => Pharmacy::count(),
            'drugCount'     => Drug::count(),
            'orderCount'    => Order::count(),
        ]);
    }

    // Sellers Management
    public function sellers()
    {
        $sellers = Seller::paginate(15);
        return view('admin.sellers.index', compact('sellers'));
    }

    public function editSeller($id)
    {
        $seller = Seller::findOrFail($id);
        return view('admin.sellers.edit', compact('seller'));
    }

    public function updateSeller(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email,'.$seller->id,
        ]);
        $seller->update($request->only(['name', 'email'])); // safer to specify fields explicitly
        return redirect()->route('admin.sellers')->with('success', 'Seller updated successfully.');
    }

    public function deleteSeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
        return redirect()->route('admin.sellers')->with('success', 'Seller deleted successfully.');
    }

    // Approve Seller (make sure 'status' column exists in sellers table)
    public function approveSeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->status = 'approved'; // Ensure 'status' column exists in DB
        $seller->save();

        return redirect()->route('admin.sellers')->with('success', 'Seller approved successfully.');
    }

    // Users Management
    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    // Approve User (make sure 'status' column exists in users table)
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User approved successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User removed successfully.');
    }

    // Pharmacies Management
    public function pharmacies()
    {
        $pharmacies = Pharmacy::paginate(15);
        return view('admin.pharmacies.index', compact('pharmacies'));
    }

    // Drugs Management
    public function drugs()
    {
        $drugs = Drug::paginate(15);
        return view('admin.drugs.index', compact('drugs'));
    }

    // Orders Management
    public function orders()
    {
        // Eager load user, seller, and items with drugs for performance
        $orders = Order::with(['user', 'seller', 'items.drug'])->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }
    public function deleteDrug($id)
{
    $drug = \App\Models\Drug::findOrFail($id);
    $drug->delete();

    return redirect()->route('admin.drugs')->with('success', 'Drug deleted successfully.');
}

}

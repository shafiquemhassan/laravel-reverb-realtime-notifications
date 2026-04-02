<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Notifications\NewProductNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->latest()->get();
        return view('product_form', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ]);

        DB::transaction(function () use ($validated) {
            $product = auth()->user()->products()->create($validated);

            // Notify all other users
            $usersToNotify = User::where('id', '!=', auth()->id())->get();
            Notification::send($usersToNotify, new NewProductNotification($product));
        });

        return redirect()->back()->with('success', 'Product added and notifications sent wirelessly!');
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(10);
        return view('notifications', compact('notifications'));
    }

    public function markRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read');
    }
}

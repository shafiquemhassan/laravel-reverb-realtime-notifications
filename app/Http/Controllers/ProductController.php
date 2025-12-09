<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewProductNotification;

class ProductController extends Controller
{
    public function index()
    {
        return view('product_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $user = User::first();  
        $user->notify(new NewProductNotification($request->name));

        return redirect()->back()->with('success', 'Product added and notification sent');
    }

    public function notifications()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('notifications', compact('notifications'));
    }

    public function markRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}

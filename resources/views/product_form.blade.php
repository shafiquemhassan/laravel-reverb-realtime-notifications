<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm rounded-r-lg mb-6 animate-pulse" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Add Product Form -->
                <div class="md:col-span-1">
                    <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Vector"></path></svg>
                            Add New Product
                        </h3>
                        
                        <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" name="name" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Premium Laptop" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" rows="3" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Describe your product..."></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                                <input type="number" step="0.01" name="price" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="99.99" required>
                            </div>

                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Create Product
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Product List -->
                <div class="md:col-span-2">
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-lg font-bold text-gray-900">Recent Products</h3>
                            <span class="px-3 py-1 text-xs font-semibold text-indigo-600 bg-indigo-50 rounded-full">{{ count($products) }} Total</span>
                        </div>
                        <ul class="divide-y divide-gray-100">
                            @forelse($products as $product)
                                <li class="p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-md font-bold text-gray-900">{{ $product->name }}</h4>
                                            <p class="text-sm text-gray-500 mt-1 line-clamp-1">{{ $product->description }}</p>
                                            <div class="mt-2 flex items-center text-xs text-gray-400">
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                    {{ $product->user->name }}
                                                </span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $product->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-lg font-black text-indigo-600">${{ number_format($product->price, 2) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="p-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20 7-8-4-8 4m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        <p class="text-gray-400 font-medium">No products found yet.</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

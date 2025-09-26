@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
            
            <div class="p-6">
                <h1 class="text-3xl font-bold text-mcd-dark mb-2">{{ $product->name }}</h1>
                
                <div class="flex items-center mb-4">
                    <span class="text-2xl font-bold text-mcd-red">Rp.{{ $product->price }}</span>
                    <span class="ml-4 px-3 py-1 bg-mcd-gray rounded-full text-sm">{{ ucfirst($product->category) }}</span>
                    <span class="ml-4 px-3 py-1 rounded-full text-sm {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->is_active ? 'Available' : 'Not Available' }}
                    </span>
                </div>
                
                <p class="text-gray-700 mb-6">{{ $product->description }}</p>
                
                @auth
                    @if(Auth::user()->isCustomer())
                    <div class="flex items-center">
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-mcd btn-mcd-yellow text-lg px-6 py-3">Add to Cart</button>
                        </form>
                    </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-mcd btn-mcd-yellow text-lg px-6 py-3">Login to Order</a>
                @endauth
                
                @if(Auth::check() && Auth::user()->isAdmin())
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h2 class="text-xl font-semibold text-mcd-dark mb-4">Admin Actions</h2>
                    <div class="flex space-x-4">
                        <a href="{{ route('products.edit', $product) }}" class="btn-mcd btn-mcd-yellow">Edit Product</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-mcd bg-red-600 hover:bg-red-700">Delete Product</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        @if(Auth::check() && Auth::user()->isAdmin())
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="btn-mcd bg-mcd-dark text-center" style="margin-top:20px; color:white;">← Back</a>
        </div>
        @endif
    </div>
</div>
@endsection
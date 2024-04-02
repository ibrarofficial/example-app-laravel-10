<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Product: Laptop</h2>
                    <h3>Price: $15</h3>
                    <form action="{{ route('paypal') }}" method="post">
                        @csrf
                        <input type="hidden" name="price" value="15">
                        <input type="hidden" name="product_name" value="Laptop">
                        <input type="hidden" name="quantity" value="1">
                        <x-primary-button class="ms-3">
                            {{ __('Pay with Paypal') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

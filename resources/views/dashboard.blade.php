<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-6">

<h1 class="text-3xl font-semibold text-gray-100 mb-6 border-b border-gray-700 pb-2">                Dashboard
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Customers -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <h2 class="text-gray-500 text-sm">Total Customers</h2>
                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ $customersCount }}
                    </p>
                </div>

                <!-- Deals -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <h2 class="text-gray-500 text-sm">Total Deals</h2>
                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ $dealsCount }}
                    </p>
                </div>

                <!-- Follow Ups -->
                <div class="bg-white shadow-md rounded-xl p-6">
                    <h2 class="text-gray-500 text-sm">Upcoming Follow-ups</h2>
                    <p class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $followUpsCount }}
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
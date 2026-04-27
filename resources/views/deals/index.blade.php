<x-app-layout>
    <div class="p-6">

        <!-- Title -->
        <h1 class="text-3xl font-semibold text-gray-100 mb-6 border-b border-gray-700 pb-2">
            Deals
        </h1>

        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-4">

            <input 
                type="text" 
                id="search-deals"
                placeholder="Search deals..." 
                class="border border-gray-300 rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-green-500"
            >

            <!-- matched button system -->
            <a href="/deals/create" class="btn btn-primary">
                + Add Deal
            </a>

        </div>

        <!-- List -->
        <div class="bg-white shadow rounded p-4">
            <ul id="deals-list">
                @foreach($deals as $deal)
                    <li class="flex justify-between items-center border-b py-3 hover:bg-gray-50 transition">

                        <!-- Left -->
                        <div>
                            <p class="font-semibold">{{ $deal->title }}</p>

                            <p class="text-sm text-gray-500">
                                {{ $deal->customer->name }} • 

                                <span class="
                                    px-2 py-1 rounded text-xs
                                    {{ $deal->status == 'done' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $deal->status == 'in_progress' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $deal->status == 'new' ? 'bg-blue-100 text-blue-700' : '' }}
                                ">
                                    {{ $deal->status }}
                                </span>
                            </p>
                        </div>

                        <!-- Right -->
                        <div class="flex gap-3 items-center">

                            <span class="text-lg font-bold text-green-600">
                                {{ $deal->price ? '$' . $deal->price : '-' }}
                            </span>

                            <!-- matched button system -->
                            <a href="/deals/{{ $deal->id }}/edit" class="btn btn-secondary">
                                Edit
                            </a>

                            <form action="/deals/{{ $deal->id }}" method="POST"
                                  onsubmit="return confirm('Delete this deal?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</x-app-layout>
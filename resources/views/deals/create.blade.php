<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-2xl font-semibold text-gray-100 mb-4">
            Add Deal
        </h1>

        <form method="POST" action="/deals">
            @csrf

            <!-- Title -->
            <div class="mb-3">
                <input type="text" name="title" placeholder="Deal Title" required
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <!-- Customer -->
            <div class="mb-3">
                <select name="customer_id" required
                    class="w-full p-2 border border-gray-300 rounded-lg">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <select name="status"
                    class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="new">New</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <input type="number" name="price" placeholder="Price"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <!-- Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</x-app-layout>
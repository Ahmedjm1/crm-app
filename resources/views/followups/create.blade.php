<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-2xl font-semibold text-gray-100 mb-4">
            Add Follow Up
        </h1>

        <form method="POST" action="/followups">
            @csrf

            <!-- Customer -->
            <div class="mb-3">
                <select name="customer_id"
                    class="w-full p-2 border border-gray-300 rounded-lg">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Note -->
            <div class="mb-3">
                <textarea name="note" placeholder="Reminder"
                    class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
            </div>

            <!-- Date -->
            <div class="mb-3">
                <input type="datetime-local" name="reminder_date"
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
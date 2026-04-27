<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">

        <h1 class="text-2xl font-semibold text-gray-100 mb-4">
            Edit Deal
        </h1>

        <!-- Update Form -->
        <form method="POST" action="/deals/{{ $deal->id }}">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-3">
                <input type="text" name="title" value="{{ $deal->title }}" required
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <!-- Customer -->
            <div class="mb-3">
                <select name="customer_id"
                    class="w-full p-2 border border-gray-300 rounded-lg">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" 
                            {{ $customer->id == $deal->customer_id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <select name="status"
                    class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="new" {{ $deal->status == 'new' ? 'selected' : '' }}>New</option>
                    <option value="in_progress" {{ $deal->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $deal->status == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <input type="number" name="price" value="{{ $deal->price }}"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <!-- Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Delete -->
        <form method="POST" action="/deals/{{ $deal->id }}"
              onsubmit="return confirm('Are you sure you want to delete this deal?')"
              class="mt-4">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Delete Deal
            </button>

        </form>

    </div>
</x-app-layout>
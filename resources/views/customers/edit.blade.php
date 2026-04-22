<x-app-layout>
    <div style="padding:20px;">
        <h1>Edit Customer</h1>

        <form method="POST" action="/customers/{{ $customer->id }}">
            @csrf
            @method('PUT')

            <div>
                <input type="text" name="name" value="{{ $customer->name }}" required>
            </div>

            <div>
                <input type="text" name="phone" value="{{ $customer->phone }}" required>
            </div>

            <div>
                <textarea name="notes">{{ $customer->notes }}</textarea>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>
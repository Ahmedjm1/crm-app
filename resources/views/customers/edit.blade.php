```html
<x-app-layout>
    <div style="padding:20px; max-width:500px; margin:auto;">
        <h1 style="font-size:22px; margin-bottom:15px;">Edit Customer</h1>

        <!-- Update Form -->
        <form method="POST" action="/customers/{{ $customer->id }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:10px;">
                <input type="text" name="name" value="{{ $customer->name }}" required
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
            </div>

            <div style="margin-bottom:10px;">
                <input type="text" name="phone" value="{{ $customer->phone }}" required
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
            </div>

            <div style="margin-bottom:10px;">
                <textarea name="notes"
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">{{ $customer->notes }}</textarea>
            </div>

            <!-- 🔥 Update + Cancel -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </form>

        <!-- ❌ Delete Button (separate form) -->
        <form method="POST" action="/customers/{{ $customer->id }}"
              onsubmit="return confirm('Are you sure you want to delete this customer?')"
              style="margin-top:15px;">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Delete Customer
            </button>
        </form>
    </div>
</x-app-layout>
```

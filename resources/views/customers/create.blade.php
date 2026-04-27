<x-app-layout>
    <div style="padding:20px; max-width:500px; margin:auto;">
        <h1 style="font-size:22px; margin-bottom:15px;">Add Customer</h1>

        <form method="POST" action="/customers">
            @csrf

            <div style="margin-bottom:10px;">
                <input type="text" name="name" placeholder="Name" required
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
            </div>

            <div style="margin-bottom:10px;">
                <input type="text" name="phone" placeholder="Phone" required
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;">
            </div>

            <div style="margin-bottom:10px;">
                <textarea name="notes" placeholder="Notes"
                    style="width:100%; padding:10px; border-radius:8px; border:1px solid #ccc;"></textarea>
            </div>

            <!-- 🔥 Buttons -->
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
```

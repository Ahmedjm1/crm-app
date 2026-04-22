<x-app-layout>
    <div style="padding:20px;">
        <h1>Add Customer</h1>

        <form method="POST" action="/customers">
            @csrf

            <div>
                <input type="text" name="name" placeholder="Name" required>
            </div>

            <div>
                <input type="text" name="phone" placeholder="Phone" required>
            </div>

            <div>
                <textarea name="notes" placeholder="Notes"></textarea>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-app-layout>
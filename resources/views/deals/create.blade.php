<x-app-layout>
    <div style="padding:20px;">
        <h1>Add Deal</h1>

        <form method="POST" action="/deals">
            @csrf

            <div>
                <input type="text" name="title" placeholder="Deal Title" required>
            </div>

            <div>
                <select name="customer_id" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name="status">
                    <option value="new">New</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div>
                <input type="number" name="price" placeholder="Price">
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</x-app-layout>
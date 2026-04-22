<x-app-layout>
    <div style="padding:20px;">
        <h1>Add Follow Up</h1>

        <form method="POST" action="/followups">
            @csrf

            <select name="customer_id">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>

            <textarea name="note" placeholder="Reminder"></textarea>

            <input type="datetime-local" name="reminder_date">

            <button type="submit">Save</button>
        </form>
    </div>
</x-app-layout>
<x-app-layout>
    <div style="padding:20px;">
        <h1>Edit Deal</h1>

        <form method="POST" action="/deals/{{ $deal->id }}">
            @csrf
            @method('PUT')

            <div>
                <input type="text" name="title" value="{{ $deal->title }}" required>
            </div>

            <div>
                <select name="customer_id">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" 
                            {{ $customer->id == $deal->customer_id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name="status">
                    <option value="new" {{ $deal->status == 'new' ? 'selected' : '' }}>New</option>
                    <option value="in_progress" {{ $deal->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $deal->status == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div>
                <input type="number" name="price" value="{{ $deal->price }}">
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="p-6">
        
        <!-- Title -->
        <h1 class="text-3xl font-semibold text-gray-100 mb-6 border-b border-gray-700 pb-2">
            Customers
        </h1>

        <!-- Top Section -->
        <div class="flex justify-between items-center mb-4">
            
            <!-- Search -->
            <div class="flex gap-2">
                <input 
                    type="text" 
                    id="search"
                    placeholder="Search customers..." 
                    class="border border-gray-300 rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <!-- 🔥 Add Button (gradient) -->
            <a href="/customers/create" class="btn btn-primary">
                + Add Customer
            </a>

        </div>

        <!-- Customers List -->
        <div class="bg-white shadow-md rounded-xl p-5">
            <ul id="customers-list">
                @foreach($customers as $customer)
                    <li class="flex justify-between items-center border-b py-3 hover:bg-gray-50 transition">
                        
                        <div>
                            <p class="font-semibold">{{ $customer->name }}</p>
                            <p class="text-sm text-gray-500">{{ $customer->phone }}</p>
                        </div>

                        <!-- 🔥 Actions -->
                        <div class="flex items-center gap-2">

                            <!-- Edit -->
                            <a href="/customers/{{ $customer->id }}/edit" class="btn btn-secondary">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="/customers/{{ $customer->id }}" method="POST"
                                  onsubmit="return confirm('Delete this customer?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</x-app-layout>

<!-- Live Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let timeout;
    const searchInput = document.getElementById('search');

    if (!searchInput) return;

    searchInput.addEventListener('keyup', function () {
        clearTimeout(timeout);

        let query = this.value;

        timeout = setTimeout(() => {
            axios.get('/customers?search=' + query)
                .then(response => {
                    let parser = new DOMParser();
                    let htmlDoc = parser.parseFromString(response.data, 'text/html');
                    let newList = htmlDoc.querySelector('#customers-list').innerHTML;

                    document.getElementById('customers-list').innerHTML = newList;
                });
        }, 300);
    });
});
</script>
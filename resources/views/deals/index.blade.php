<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-semibold text-gray-100 mb-6 border-b border-gray-700 pb-2">    Deals
</h1>
<div class="flex justify-between items-center mb-4">    
    <input 
        type="text" 
        id="search-deals"
        placeholder="Search deals..." 
        class="border border-gray-300 rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-green-500"
    >
    <a href="/deals/create" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">
                + Add Deal
            </a>
</div>
        
            
      

        <div class="bg-white shadow rounded p-4">
            <ul id="deals-list">
                @foreach($deals as $deal)
                    <li class="flex justify-between items-center border-b py-3 hover:bg-gray-50 transition">
                        <div>
                            <p class="font-semibold">{{ $deal->title }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $deal->customer->name }} • <span class="
    px-2 py-1 rounded text-xs
    {{ $deal->status == 'done' ? 'bg-green-100 text-green-700' : '' }}
    {{ $deal->status == 'in_progress' ? 'bg-yellow-100 text-yellow-700' : '' }}
    {{ $deal->status == 'new' ? 'bg-blue-100 text-blue-700' : '' }}
">
    {{ $deal->status }}
</span>
                            </p>
                        </div>

                        <div class="flex gap-3 items-center">
                            <span class="text-lg font-bold text-green-600">
    {{ $deal->price ? '$' . $deal->price : '-' }}
</span>

                            <a href="/deals/{{ $deal->id }}/edit" class="text-blue-500">
                                Edit
                            </a>

                            <form action="/deals/{{ $deal->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let timeout;
    const searchInput = document.getElementById('search-deals');

    if (!searchInput) return;

    searchInput.addEventListener('keyup', function () {
        clearTimeout(timeout);

        let query = this.value;

        timeout = setTimeout(() => {
            axios.get('/deals?search=' + query)
                .then(response => {
                    let parser = new DOMParser();
                    let htmlDoc = parser.parseFromString(response.data, 'text/html');
                    let newList = htmlDoc.querySelector('#deals-list').innerHTML;

                    document.getElementById('deals-list').innerHTML = newList;
                });
        }, 300);
    });
});
</script>
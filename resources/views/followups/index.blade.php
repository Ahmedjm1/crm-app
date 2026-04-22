<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
<h1 class="text-3xl font-semibold text-gray-100 mb-6 border-b border-gray-700 pb-2">    Follow Ups
</h1>            <a href="/followups/create" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded transition">
                + Add Follow Up
            </a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <ul>
                @foreach($followUps as $f)
                    <li class="flex justify-between items-center border-b py-3 transition 
    {{ \Carbon\Carbon::parse($f->reminder_date)->isPast() ? 'bg-red-50' : 'hover:bg-gray-50' }}">
                        <div>
                            <p class="font-semibold">{{ $f->note }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $f->customer->name }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-gray-500">Reminder</p>
                            <p class="font-bold">
                                {{ \Carbon\Carbon::parse($f->reminder_date)->format('Y-m-d H:i') }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
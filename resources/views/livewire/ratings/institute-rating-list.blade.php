<div>
<div class="space-y-3">
    @forelse ($ratings as $r)
        <div class="bg-gray-50 border p-3 rounded shadow-sm">
            <div class="flex justify-between items-center text-sm text-gray-700">
                <span>{{ $r->user->name }}</span>
                <span>{{ optional($r->created_at)->diffForHumans() }}</span>
            </div>
            <div class="text-yellow-400 text-sm">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="{{ $i <= $r->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                @endfor
            </div>
            <p class="text-sm text-gray-800 mt-1">{{ $r->review }}</p>
        </div>
    @empty
        <p class="text-gray-500 text-sm text-center">No ratings yet.</p>
    @endforelse

    <div class="mt-2">
        {{ $ratings->links() }}
    </div>
</div>
</div>

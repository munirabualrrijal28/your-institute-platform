<div class="px-4 sm:px-6 lg:px-8">
    <!-- Instructors Tab -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 py-4">
        @forelse ($instructors as $instructor)
            <div class="bg-white rounded-2xl shadow p-4 flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-4 transition hover:shadow-lg">

                <!-- Photo Column -->
                <div class="flex-shrink-0 text-center sm:text-left">
                    <img src="{{ $instructor->photo ? asset('storage/' . $instructor->photo) : asset('/images/profile/user_ic.svg') }}"
                        class="w-24 h-24 rounded-xl object-cover border shadow mx-auto sm:mx-0" alt="{{ $instructor->name }}" />
                    <h3 class="text-lg font-bold text-gray-900 mt-2 truncate">{{ $instructor->name }}</h3>
                    @if ($instructor->email)
                        <p class="text-gray-500 text-xs truncate">{{ $instructor->email }}</p>
                    @endif
                </div>

                <!-- Info Column -->
                <div class="flex-1 space-y-2 text-center sm:text-right w-full">
                    <p class="text-gray-600 text-sm break-words line-clamp-3">{{ $instructor->bio }}</p>
                </div>

            </div>
        @empty
            <p class="text-center text-gray-500 col-span-full">لا يوجد مدربين حالياً.</p>
        @endforelse

        {{-- Pagination --}}
        {{-- <div class="col-span-full mt-6 flex justify-center">
            {!! $instructors->withQueryString()->links() !!}
        </div> --}}
    </div>
</div>

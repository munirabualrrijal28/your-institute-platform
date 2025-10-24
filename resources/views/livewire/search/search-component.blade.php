<div class="w-full">
    <!-- Search Bar Row -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 py-4">



        <!-- Search Input with Icon -->
        <div class="w-full sm:flex-grow relative">
            <input type="text" wire:model.debounce.300ms="query" placeholder="Search courses or institutes..."
                class="w-full h-14 text-base sm:text-lg px-6 pr-14 py-3 border-2 border-teal-500 rounded-full
                       focus:outline-none focus:ring-2 focus:ring-teal-400 placeholder:text-gray-500" />
            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-teal-500 pointer-events-none">
                <i data-feather="search" class="w-5 h-5"></i>
            </div>
        </div>

        {{--  --}}
        @error('query')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
        @enderror
        <div class="text-sm text-gray-500 px-6">You typed: "{{ $query }}"</div>

        <div class="text-sm text-teal-500 px-6">
            Institutes: {{ $institutes->count() }},
            Courses: {{ $courses->count() }},
            Ads: {{ $ads->count() }}
        </div>

        {{--  --}}

    </div>

    <!-- Search Results -->
    <div class="w-full px-4 sm:px-6 max-w-7xl mx-auto space-y-6">
        @if ($query)
            {{-- Institutes --}}
            @if ($institutes->count())
                <div>
                    <h2 class="text-xl font-bold text-teal-600 mb-2">Institutes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($institutes as $institute)
                            <div class="bg-white rounded-xl border shadow p-4">
                                <h3 class="text-lg font-semibold">{{ $institute->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $institute->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Courses --}}
            @if ($courses->count())
                <div>
                    <h2 class="text-xl font-bold text-teal-600 mb-2">Courses</h2>
                    @foreach ($courses as $course)
                        <div class="bg-white shadow rounded-lg p-4 mb-3 border-l-4 border-teal-400">
                            <h3 class="text-lg font-bold">{{ $course->course_adv_name }}</h3>
                            <p class="text-sm text-gray-700">{{ $course->course_adv_description }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Advertisements --}}
            @if ($ads->count())
                <div>
                    <h2 class="text-xl font-bold text-teal-600 mb-2">Advertisements</h2>
                    @foreach ($ads as $ad)
                        <div class="bg-white shadow rounded-lg p-4 mb-3 border-l-4 border-blue-400">
                            <p class="text-sm text-gray-800">{{ $ad->content }}</p>
                            <span class="text-xs text-gray-400">{{ $ad->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- No results --}}
            @if (!$institutes->count() && !$courses->count() && !$ads->count())
                <div class="text-center text-gray-500 text-sm">
                    No results found for "<strong>{{ $query }}</strong>"
                </div>
            @endif
        @endif
    </div>

    <!-- Feather Icons -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
        document.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', () => feather.replace());
        });
    </script>
</div>

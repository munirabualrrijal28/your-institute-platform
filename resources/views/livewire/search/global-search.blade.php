<div class="relative w-full z-50">

    {{-- Search Input --}}
    <div class="relative">
        <input
            type="text"
            wire:model.debounce.300ms="query"
            wire:keydown.enter.prevent="search"
            placeholder="ابحث عن معهد، دورة أو إعلان..."
            class="w-full pl-10 pr-10 py-2 text-sm border border-teal-500 rounded-full focus:ring-2 focus:ring-teal-500 placeholder:text-gray-400"
            autocomplete="off"
        />
                {{-- <pre class="text-xs text-gray-400 bg-gray-100 p-2">Livewire Update Test: {{ now() }}</pre> --}}


        {{-- Spinner --}}
        <div wire:loading.delay wire:target="query" class="absolute right-3 top-1/2 -translate-y-1/2">
            <svg class="animate-spin h-4 w-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z" />
            </svg>
        </div>

        {{-- Search Icon (click to full search) --}}
        <button wire:click="search" type="button"
            class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-600">
            <x-heroicon-s-magnifying-glass class="w-5 h-5" />
        </button>
    </div>

    {{-- Suggestions Dropdown --}}
    @if(strlen($query) >= 2)
        <div class="absolute w-full mt-2 bg-white border border-gray-200 rounded-md shadow-lg z-50 max-h-80 overflow-y-auto text-sm">

            @php
                $hasResults = count($results['institutes']) || count($results['courses']) || count($results['ads']);
            @endphp

            @if(!$hasResults)
                <div class="px-4 py-3 text-center text-gray-500 text-sm">
                    ❌ لا توجد نتائج
                </div>
            @endif

            @if(!empty($results['institutes']))
                <p class="px-3 pt-2 text-xs text-gray-500">🏫 معاهد</p>
                @foreach($results['institutes'] as $ins)
                    <a href="{{ route('user.ins_page', $ins->id) }}" class="block px-4 py-1 hover:bg-teal-50">
                        {{ $ins->ins_name }}
                    </a>
                @endforeach
            @endif

            @if(!empty($results['courses']))
                <p class="px-3 pt-2 text-xs text-gray-500">📘 دورات</p>
                @foreach($results['courses'] as $course)
                    <a href="{{ route('course.show', $course->id) }}" class="block px-4 py-1 hover:bg-teal-50">
                        {{ $course->course_name }}
                    </a>
                @endforeach
            @endif

            @if(!empty($results['ads']))
                <p class="px-3 pt-2 text-xs text-gray-500">📢 إعلانات</p>
                @foreach($results['ads'] as $ad)
                    <a href="{{ route('advertisement.show', $ad->id) }}" class="block px-4 py-1 hover:bg-teal-50">
                        {{ $ad->title }}
                    </a>
                @endforeach
            @endif

        </div>
    @endif
</div>
{{-- <div class="relative w-full z-50">
    <div class="relative">
        <button
            wire:click="search"
            type="button"
            class="absolute left-3 top-2 text-gray-400 hover:text-teal-600"
            title="ابحث">
            <x-heroicon-s-magnifying-glass class="w-5 h-5" />
        </button>

        <input
            type="text"
            wire:model.debounce.300ms="query"
            wire:keydown.enter.prevent="search"
            placeholder="ابحث عن معهد، دورة أو إعلان..."
            class="w-full pl-10 pr-10 py-2 text-sm border border-teal-500 rounded-full focus:ring-2 focus:ring-teal-500 placeholder:text-gray-400"
            autocomplete="off"
        />

        {{-- <pre class="text-xs text-gray-400 bg-gray-100 p-2">Livewire Update Test: {{ now() }}</pre> --}}


        {{-- <div wire:loading.delay wire:target="query" class="absolute right-3 top-1/2 -translate-y-1/2">
            <svg class="animate-spin h-4 w-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
    </div> --}}

    {{-- Live Dropdown --}}
    {{-- @if(strlen($query) >= 2)
        <div class="absolute w-full mt-2 bg-white border border-gray-200 rounded-md shadow-lg z-[999] max-h-80 overflow-y-auto text-sm">

            @php
                $hasResults = count($results['institutes']) || count($results['courses']) || count($results['ads']);
            @endphp

            @if(!$hasResults)
                <div class="px-4 py-3 text-center text-gray-500 text-sm">
                    ❌ لا توجد نتائج مطابقة
                </div>
            @endif

            @if(!empty($results['institutes']))
                <p class="px-3 pt-2 text-xs text-gray-500">🏫 معاهد</p>
                @foreach($results['institutes'] as $ins)
                    <a href="{{ route('search.page', $ins->id) }}" class="block px-4 py-1 hover:bg-teal-50">
                        {{ $ins->ins_name }}
                    </a>
                @endforeach
            @endif

            @if(!empty($results['courses']))
                <p class="px-3 pt-2 text-xs text-gray-500">📘 دورات</p>
                @foreach($results['courses'] as $course)
                    <a href="{{ route('course.show', $course->id) }}" class="block px-4 py-1 hover:bg-teal-50">
                        {{ $course->course_name }}
                    </a>
                @endforeach
            @endif

            @if(!empty($results['ads']))
                <p class="px-3 pt-2 text-xs text-gray-500">📢 إعلانات</p>
                @foreach($results['ads'] as $ad)
                    <a href="{{ route('advertisement.show', $ad->id) }}" class="block px-4 py-1 hover:bg-teal-50">
                        {{ $ad->title }}
                    </a>
                @endforeach
            @endif
        </div>
    @endif
</div> --}}

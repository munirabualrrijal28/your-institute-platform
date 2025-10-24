<div class="px-[70px]">


<div class="bg-teal-600 text-white px-4 py-2 flex flex-wrap gap-3 justify-center">
    @foreach (['instructors' => '👨‍🏫الكادر', 'courses' => '📘الكورسات', 'categories' => '🏷️الأقسام', 'ads' => '📢الإعلانات'] as $tab => $label)
        <button wire:click="setTab('{{ $tab }}')"
            class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200
                {{ $activeTab === $tab ? 'bg-white text-teal-600' : 'hover:bg-teal-700' }}">
            {{ $label }}
        </button>
    @endforeach
</div>

<div class="mt-4">
    @if ($activeTab === 'instructors')
        <livewire:student-tabs.instructors-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'courses')
        <livewire:student-tabs.courses-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'categories')
        <livewire:student-tabs.categories-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'ads')
        <livewire:student-tabs.ads-tab :institute-id="$instituteId" />
    @endif
</div>

@push('scripts')
    <script>
        Livewire.hook('message.processed', () => {
            if (window.feather) feather.replace();
        });

        document.addEventListener('livewire:load', () => {
            if (window.Alpine && Alpine.initTree) Alpine.initTree(document.body);
        });
    </script>
@endpush




</div>
{{-- ✅ Root closed --}}

{{-- <div class="space-y-8">

    <!-- Tabs Navigation -->
    <div class="flex justify-center gap-6 text-base font-semibold border-b pb-2">
        <button wire:click="setTab('courses')"
            class="{{ $activeTab === 'courses' ? 'text-teal-600 border-b-2 border-teal-500' : 'text-gray-500 hover:text-teal-500' }}">📘
            الدورات</button>
        <button wire:click="setTab('categories')"
            class="{{ $activeTab === 'categories' ? 'text-teal-600 border-b-2 border-teal-500' : 'text-gray-500 hover:text-teal-500' }}">🏷️
            التصنيفات</button>
        <button wire:click="setTab('instructors')"
            class="{{ $activeTab === 'instructors' ? 'text-teal-600 border-b-2 border-teal-500' : 'text-gray-500 hover:text-teal-500' }}">👨‍🏫
            المدرّبين</button>
        <button wire:click="setTab('ads')"
            class="{{ $activeTab === 'ads' ? 'text-teal-600 border-b-2 border-teal-500' : 'text-gray-500 hover:text-teal-500' }}">📢
            الإعلانات</button>
    </div>

    <div class="px-4 mt-4">

        <!-- Courses Tab -->
        @if ($activeTab === 'courses')
            <livewire:student-tabs.courses-tab :institute-id="$instituteId" />{{--  --}}
            {{--  --}}
        {{-- @endif --}}

        <!-- Categories Tab -->
        {{-- @if ($activeTab === 'categories')
            <livewire:student-tabs.categories-tab :institute-id="$instituteId" />{{--  --}}
        {{-- @endif --}}

        <!-- Instructors Tab -->
        {{-- @if ($activeTab === 'instructors')
            <livewire:student-tabs.instructors-tab :institute-id="$instituteId" />
        @endif --}}

        <!-- Advertisements Tab -->
        {{-- @if ($activeTab === 'ads')
            <livewire:student-tabs.ads-tab :institute-id="$instituteId" />
        @endif
    </div>
    <script>
        window.courseMap = @json($courses->keyBy('id'));
    </script>
</div> --}}

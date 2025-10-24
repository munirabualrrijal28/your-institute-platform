<div class="px-[70px]">


<div class="bg-teal-600 text-white px-6 py-2 flex flex-wrap gap-3 justify-center">
    @foreach (['instructors' => 'الكادر', 'courses' => 'الكورسات', 'categories' => 'الأقسام', 'ads' => 'الإعلانات'] as $tab => $label)
        <button wire:click="setTab('{{ $tab }}')"
            class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200
                {{ $activeTab === $tab ? 'bg-white text-teal-600' : 'hover:bg-teal-700' }}">
            {{ $label }}
        </button>
    @endforeach
</div>

<div class="mt-4">
    @if ($activeTab === 'instructors')
        <livewire:institute-tabs.instructors-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'courses')
        <livewire:institute-tabs.courses-tab :institute-id="$instituteId " />

    @elseif ($activeTab === 'categories')
        <livewire:institute-tabs.categories-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'ads')
        <livewire:institute-tabs.ads-tab :institute-id="$instituteId" />
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

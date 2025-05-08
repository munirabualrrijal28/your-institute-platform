<div class="w-full">
    <!-- Tabs -->
    <div class="bg-teal-600 text-white px-6 py-2 flex flex-wrap gap-3 justify-center">
        @foreach([
            'instructors' => 'الكادر',
            'courses' => 'الكورسات',
            'categories' => 'الأقسام',
            'ads' => 'الإعلانات'
        ] as $tab => $label)
            <button wire:click="$set('activeTab', '{{ $tab }}')"
                class="px-4 py-2 rounded-full font-semibold shadow transition-all duration-200
                {{ $activeTab === $tab ? 'bg-white text-teal-600' : 'hover:bg-teal-700' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Tab Content -->
    <div class="container mx-auto px-6 py-8">
        @if($activeTab === 'instructors')
            <livewire:institute-tabs.instructors-tab />
        @elseif($activeTab === 'courses')
            <livewire:institute-tabs.courses-tab />
        @elseif($activeTab === 'categories')
            <livewire:institute-tabs.categories-tab />
        @elseif($activeTab === 'ads')
            <livewire:institute-tabs.ads-tab />
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("livewire:load", () => {
        Livewire.hook('message.processed', () => {
            feather.replace();
        });
    });
</script>
@endpush

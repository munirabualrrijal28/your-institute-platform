<div>
    {{-- Tab Navigation --}}
  <div class="flex justify-center space-x-4 mb-6 px-4">
    @foreach (['instructors' => 'المدربين', 'categories' => 'الفئات', 'courses' => 'الدورات', 'advertisements' => 'الإعلانات'] as $tab => $label)
        <button
            wire:click="setTab('{{ $tab }}')"
            class="px-4 py-2 rounded-xl transition font-semibold
            {{ $activeTab === $tab ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800' }}">
            {{ $label }}
        </button>
    @endforeach
</div>

<div class="px-4 mt-4">
    @if ($activeTab === 'instructors')
        <livewire:institute-tabs.instructors-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'categories')
        <livewire:institute-tabs.categories-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'courses')
        <livewire:institute-tabs.courses-tab :institute-id="$instituteId" />
    @elseif ($activeTab === 'advertisements')
        <livewire:institute-tabs.advertisements-tab :institute-id="$instituteId" />
    @endif
</div>

</div>


<div>
<div class="space-y-4">
    <div class="flex gap-4 text-center">
        <button wire:click="setTab('courses')" class="{{ $activeTab === 'courses' ? 'font-bold text-teal-600' : '' }}">الدورات</button>
        <button wire:click="setTab('following')" class="{{ $activeTab === 'following' ? 'font-bold text-teal-600' : '' }}">المعاهد المتابعة</button>
        <button wire:click="setTab('notifications')" class="{{ $activeTab === 'notifications' ? 'font-bold text-teal-600' : '' }}">الإشعارات</button>
    </div>

    @if ($activeTab === 'courses')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($courses as $course)
                <div class="bg-white rounded-xl shadow p-4">
                    <h3 class="font-bold">{{ $course->course_name }}</h3>
                    <p class="text-sm text-gray-600">{{ $course->course_description }}</p>
                </div>
            @endforeach
        </div>
        {{ $courses->links() }}
    @elseif ($activeTab === 'following')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($following as $f)
                <div class="bg-white rounded-xl shadow p-4 text-center">
                    <img src="{{ asset($f->institute->logo ?? '/images/default-institute.png') }}" class="w-16 h-16 mx-auto rounded-full">
                    <h4 class="mt-2 font-bold">{{ $f->institute->name }}</h4>
                </div>
            @endforeach
        </div>
    @elseif ($activeTab === 'notifications')
        <ul class="list-disc space-y-2">
            @foreach ($notifications as $note)
                <li>{{ $note->data['message'] ?? $note->content }}</li>
            @endforeach
        </ul>
    @endif
</div>
</div>

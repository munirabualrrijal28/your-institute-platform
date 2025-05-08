<div>
<div class="space-y-6">
    @if ($editInstructor)
        @include('profile_parts.institute_tabs.instructor._edit-form', ['instructor' => $editInstructor])
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($instructors as $instructor)
            @include('profile_parts.institute_tabs.instructor._instructor-card', ['instructor' => $instructor])
        @empty
            <p class="text-center text-gray-500 col-span-full">لا يوجد أعضاء هيئة تدريس</p>
        @endforelse
    </div>
</div>
</div>

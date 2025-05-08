<div>
<div class="space-y-6">
    @if ($editCate)
        @include('profile_parts.institute_tabs.course._edit-form', ['course' => $editCourse])
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($courses as $course)
            @include('profile_parts.institute_tabs.course._course-card', ['course' => $course])
        @empty
            <p class="text-center text-gray-500 col-span-full">لا توجد كورسات</p>
        @endforelse
    </div>
</div>
</div>

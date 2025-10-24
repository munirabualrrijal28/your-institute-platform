@php
    use App\Models\Institute;

    $user = auth()->user();
    $institute = Institute::where('user_id_fk', $user->id)->first();

    $photoUrl = $institute && $institute->ins_profile_photo
        ? asset('storage/' . $institute->ins_profile_photo)
        : asset('/images/profile/user_ic.svg');
@endphp
@extends('institute.layouts.layout')

@section('institute_layout')


<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Courses in {{ $category->category_name }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($courses as $course)
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $course->course_name }}</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $course->course_description }}</p>

                @if($course->media->isNotEmpty())
                    <img src="{{ asset('storage/' . $course->media->first()->url) }}" class="mt-3 w-full h-40 object-cover rounded" />
                @endif
            </div>
        @empty
            <p class="text-gray-600">No courses found for this category.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $courses->links('vendor.pagination.tailwind') }}
    </div>
</div>



        <script>
            Livewire.hook('message.processed', () => {
                feather.replace(); // for feather icons
            });
        </script>
    </div>
@endsection

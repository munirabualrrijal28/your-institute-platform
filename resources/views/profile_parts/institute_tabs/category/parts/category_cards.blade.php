
@extends('profile_parts.lib')

@section('lib_layout')

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
    @foreach ($categories as $cat)
        <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
            <!-- Image -->
            <img src="{{ asset('storage/' . $cat->category_photo) }}"
                 alt="Category Image"
                 class="w-full h-40 object-cover">

            <!-- Content -->
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="text-center text-lg font-bold text-gray-800 mb-1">{{ $cat->category_name }}</h3>
                <p class="text-center text-sm text-gray-600">{{ $cat->category_des ?? 'No description' }}</p>

                <!-- Actions -->
                <div class="mt-auto flex justify-center gap-3 pt-4 border-t" x-data="{ open: false }">
                    <!-- Edit -->
                    <a href="{{ route('institute.edit_category', $cat->id) }}"
                       class="text-blue-500 hover:text-blue-700" title="Edit">
                        <i data-feather="edit" class="w-5 h-5"></i>
                    </a>

                    <!-- Delete -->
                    <button type="button" @click="open = true"
                            class="text-red-600 hover:text-red-800" title="Delete">
                        <i data-feather="trash-2" class="w-5 h-5"></i>
                    </button>

                    <!-- Delete Confirmation Modal -->
                    <div x-show="open" x-cloak x-transition
                         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                        <div class="bg-white rounded-lg p-6 w-80 shadow-lg">
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">Are you sure?</h2>
                            <p class="text-sm text-gray-600 mb-4">Every Course related to this Category will be deleted too!</p>

                            <div class="flex justify-end gap-3">
                                <button @click="open = false"
                                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                    Cancel
                                </button>

                                <form method="POST" action="{{ route('institute.category.delete', $cat->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                        Yes, Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Tailwind Pagination -->
<div class="mt-6 flex justify-center">
    {!! $categories->withQueryString()->links() !!}
</div>

{{-- {{ $categories->appends(['activeTab' => 'courses'])->links('vendor.pagination.tailwind') }} --}}


@endsection


<div>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 py-8">
        @foreach ($categories as $category)

    <a href="{{ route('categories_courses', $category->id) }}" target="_blank" class="block">

            <div wire:key="category-{{ $category->id }}"
                class="bg-white rounded-xl shadow p-4 transition hover:shadow-lg overflow-hidden flex flex-col">
                <!-- Image -->
                <div class="w-full h-40 mb-4 overflow-hidden rounded-xl">
                    <img src="{{ $category->category_photo ? asset('storage/' . $category->category_photo) : asset('/images/default-category.jpg') }}"
                        class="w-full h-full object-cover" alt="{{ $category->category_name }}" />
                </div>

                <!-- Info -->
                <div class="flex-1 space-y-1 text-right overflow-hidden">
                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $category->category_name }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 overflow-hidden">{{ $category->category_des }}</p>
                </div>

            </div>
    </a>


        @endforeach

        {{-- <div class="mt-6 flex justify-center">
            {!! $categories->withQueryString()->links() !!}
        </div> --}}
    </div>



</div>

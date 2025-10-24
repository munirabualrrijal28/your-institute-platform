<div class="bg-white border border-gray-200 rounded-xl shadow p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Institute Profile Overview</h2>

    <div class="flex items-center gap-6">
        <!-- Profile Photo -->
        <img src="{{ $institute->ins_profile_photo ? asset($institute->ins_profile_photo) : asset('images/default-avatar.png') }}"
             class="w-24 h-24 rounded-full border-2 border-teal-400 object-cover">

        <!-- Toggle Reject -->
        <div x-data="{ allow: false }" class="flex-1">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="allow" class="form-checkbox text-teal-600">
                <span class="ml-2 text-sm text-gray-600">Enable reject profile photo</span>
            </label>

            <form method="POST"
                  {{-- action="{{ route('admin.reject.profile.photo', $institute->id) }}" --}}
                  action=""
                  class="mt-3"
                  x-show="allow"
                  x-transition>
                @csrf
                @method('PUT')
                <button type="submit"
                        class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition">
                    Reject Profile Photo
                </button>
            </form>
        </div>
    </div>

    <!-- Institute Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6 text-sm text-gray-800">
        <div class="bg-gray-50 px-4 py-3 rounded-lg shadow-sm flex justify-between">
            <span>Courses</span> <strong>{{ $institute->courses_count }}</strong>
        </div>
        <div class="bg-gray-50 px-4 py-3 rounded-lg shadow-sm flex justify-between">
            <span>Advertisements</span> <strong>{{ $institute->advertisements_count }}</strong>
        </div>
        <div class="bg-gray-50 px-4 py-3 rounded-lg shadow-sm flex justify-between">
            <span>Categories</span> <strong>{{ $institute->categories_count }}</strong>
        </div>
        <div class="bg-gray-50 px-4 py-3 rounded-lg shadow-sm flex justify-between">
            <span>Instructors</span> <strong>{{ $institute->instructors_count }}</strong>
        </div>
        <div class="bg-gray-50 px-4 py-3 rounded-lg shadow-sm flex justify-between col-span-1 sm:col-span-2 lg:col-span-3">
            <span>Followers</span> <strong>{{ $institute->followers_count }}</strong>
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>

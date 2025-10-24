{{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($verifiedInstitutes as $institute)

        <div class="bg-white rounded-2xl border border-gray-200 shadow hover:shadow-md p-6 text-center">
            <img src="{{ $institute->ins_profile_photo ? asset('storage/' . $institute->ins_profile_photo) : asset('images/default-avatar.png') }}"
                class="w-20 h-20 mx-auto rounded-full object-cover border-2 border-yellow-300 mb-3">
            <h2 class="text-lg font-bold text-gray-800">{{ $institute->ins_name }}</h2>
            <p class="text-sm text-gray-500">{{ Str::limit($institute->ins_description, 100) }}</p> --}}

            {{-- <form method="POST" action="" class="mt-4">
                @csrf
                <button class="px-4 py-2 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600 transition">
                    Restrict
                </button>
            </form> --}}
            {{-- <form method="POST" action="{{ route('admin.restrict.institute', $institute->id) }}" class="mt-4">
                @csrf
                <button class="px-4 py-2 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600 transition">
                    Restrict
                </button>
            </form>

            <form method="POST" action="" class="mt-2" onsubmit="return confirm('Are you sure you want to delete this institute?')">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
                    Delete
                </button>
            </form> --}}
            {{-- <form method="POST" action="{{ route('admin.delete.institute', $institute->id) }}" class="mt-2" onsubmit="return confirm('Are you sure you want to delete this institute?')">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
                    Delete
                </button>
            </form> --}}
        {{-- </div>
    @empty
        <p class="text-gray-600">No active verified institutes found.</p>
    @endforelse
</div> --}}

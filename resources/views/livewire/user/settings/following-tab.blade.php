<div>
    <div class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            @forelse ($followedInstitutes as $institute)
                <div
                    class="bg-white rounded-2xl shadow hover:shadow-md transition-all duration-300 p-5 flex flex-col items-center text-center">
                    <img src="{{ asset($institute->ins_profile_photo ?? 'images/icons/profile/user_ic.svg.svg') }}"
                        alt="{{ $institute->ins_name }}"
                        class="w-20 h-20 rounded-full object-cover border-2 border-teal-500 mb-3">

                    <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $institute->ins_name }}</h3>

                    <a href="{{ route('user.user_ins_profile', $institute->id) }}"
                        class="text-sm text-teal-600 hover:underline mb-3">
                        عرض الملف
                    </a>

                    <livewire:follow.follow-button :institute="$institute" />

                </div>
            @empty
                <div class="text-center text-gray-500">
                    You are not following any institutes yet.
                </div>
            @endforelse
        </div>
    </div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
</div>

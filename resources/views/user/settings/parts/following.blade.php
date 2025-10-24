<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">المعاهد التي تتابعها</h2>
    {{-- @php
dd("This is the following institutes section.");
@endphp --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse (Auth::user()->student->followedInstitutes as $institute)
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

                {{-- <livewire:follow.follow-button :institute="$institute" /> --}}
       <div x-data="{
isFollowing: {{ Auth::user()->student->followedInstitutes->contains($institute->id) ? 'true' : 'false' }},
    toggleFollow() {
        // Send a fetch request to toggle follow
        fetch('{{ route('toggle_follow', $institute->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
        }).then(res => {
            if (res.ok) {
                this.isFollowing = !this.isFollowing;
            } else {
                alert('❌ Failed to toggle follow status.');
            }
        }).catch(err => {
            console.error(err);
            alert('❌ Something went wrong.');
        });
    }
}" class="text-center">
    <button
        @click="toggleFollow"
        :class="isFollowing
            ? 'bg-red-600 hover:bg-red-700'
            : 'bg-teal-500 hover:bg-teal-600'"
        class="w-[150px] h-full rounded-xl text-white font-semibold px-4 py-2 transition">
        <span x-text="isFollowing ? 'إلغاء المتابعة' : 'متابعة'"></span>
    </button>
</div>




            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">
                لا تتابع أي معهد حالياً.
            </div>
        @endforelse
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
  @foreach ($followers as $follower)
    @php
      $student = optional($follower)->student;
      $user = optional($student)->user;
    @endphp

    @if($user && isset($user->name))
      <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 p-6 flex flex-col items-center text-center">
        <img src="{{ asset($user->profile_photo ?? '/images/profile/user_ic.svg') }}"
             alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-teal-500">
        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $user->name }}</h3>
        <p class="text-sm text-gray-500 mb-3">{{ $user->email }}</p>
        {{-- <form method="POST" action="{{ route('institute.unfollow.institute', $follower->id) }}">
          @csrf
          @method('DELETE')
          <button class="bg-red-500 hover:bg-red-600 transition-colors duration-300 text-white rounded-full px-6 py-2 text-sm font-semibold shadow">
            إلغاء المتابعة
          </button>
        </form> --}}
      </div>
    @endif
  @endforeach
</div>

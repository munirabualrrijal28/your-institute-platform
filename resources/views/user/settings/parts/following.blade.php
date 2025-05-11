<!-- followers.blade.php -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">



    <h2 class="text-xl font-bold mb-4">المعاهد التي تتابعها</h2>
    <ul class="space-y-2">
        @foreach (Auth::user()->student->followedInstitutes as $institute)
            <li class="bg-white shadow p-3 rounded-lg flex justify-between items-center">
                <a href="{{ route('user.user_ins_profile', $institute->id) }}" class="text-teal-700 font-semibold">
                    {{ $institute->ins_name }}
                </a>
                {{-- <form method="POST" action="{{ route('user.unfollow_institute', $institute->id) }}">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:text-red-800 font-semibold">إلغاء المتابعة</button>
            </form> --}}
                {{-- <livewire:follow.follow-button :institute="$institute" /> --}}
                <livewire:follow.follow-button :institute="$institute" />
            </li>
        @endforeach
    </ul>

    {{-- @foreach ($following as $followin)
    <div class="bg-white rounded-xl shadow p-5 flex flex-col items-center">
      <img src="{{ asset($followin->logo ?? '/images/default-institute.png') }}" alt="{{ $followin->name }}" class="w-20 h-20 rounded-full object-cover mb-2">
      <h3 class="text-lg font-bold mb-1">{{ $followin->name }}</h3>
      <form method="POST" action="{{ route('unfollow.institute', $followin->id) }}">
        @csrf
        @method('DELETE')
        <button class="bg-teal-600 text-white rounded-full px-4 py-1 text-sm hover:bg-teal-700">إلغاء المتابعة</button>
      </form>
    </div>
    {{--  --}}


    {{--  --}}
    {{-- @endforeach --}}
    <!-- Instructors Section -->
    {{-- <div class="container mx-auto px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- FAKE STATIC INSTRUCTORS -->
      <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
        <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب" class="rounded-full w-16 h-16 object-cover" />
        <div class="text-right">
          <h3 class="text-lg font-bold">محمد سليمان الرياني</h3>
          <p class="text-gray-600">مختص في دورات الجرافيكس</p>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
        <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب" class="rounded-full w-16 h-16 object-cover" />
        <div class="text-right">
          <h3 class="text-lg font-bold">مصطفى فهمي المغتربي</h3>
          <p class="text-gray-600">مختص في دورات اللغة الهندية</p>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow hover:shadow-lg p-5 flex items-center space-x-4">
        <img src="{{ asset('/images/profile/user_ic.svg') }}" alt="صورة المدرب" class="rounded-full w-16 h-16 object-cover" />
        <div class="text-right">
          <h3 class="text-lg font-bold">منير نعمان أبو الرجال</h3>
          <p class="text-gray-600">مختص في دورات اللغة الإنجليزية</p>
        </div>
      </div> --}}
</div>

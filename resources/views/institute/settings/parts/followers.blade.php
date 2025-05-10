<!-- followers.blade.php -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  @foreach ($followers as $follower)
    <div class="bg-white rounded-xl shadow p-5 flex flex-col items-center">
      <img src="{{ asset($follower->logo ?? '/images/default-institute.png') }}" alt="{{ $follower->name }}" class="w-20 h-20 rounded-full object-cover mb-2">
      <h3 class="text-lg font-bold mb-1">{{ $follower->name }}</h3>
      <form method="POST" action="{{ route('unfollow.institute', $follower->id) }}">
        @csrf
        @method('DELETE')
        <button class="bg-teal-600 text-white rounded-full px-4 py-1 text-sm hover:bg-teal-700">إلغاء المتابعة</button>
      </form>
    </div>
  @endforeach
</div>

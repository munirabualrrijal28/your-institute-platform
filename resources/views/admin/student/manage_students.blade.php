@extends('admin.layouts.layout')
@section('admin_page_title')
Dashboard - Admin Panel
@endsection
@section('content')



<div class="p-6 space-y-6 animate-fade-in" x-data="{ showConfirm: false, formId: null }">
    <h1 class="text-2xl font-extrabold text-gray-800">Manage Students</h1>

    <!-- Filter/Search Card -->
    <div class="bg-gradient-to-tr from-indigo-50 to-indigo-100 border border-indigo-200 rounded-2xl shadow p-5">
        <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="flex-grow">
                <input type="text" name="search" placeholder="Search by name or email"
                    value="{{ request('search') }}"
                    class="w-full sm:w-64 border border-indigo-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-indigo-300">
            </div>
            <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">
                Search
            </button>
        </form>
    </div>

    <!-- Students Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($students as $student)
            <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-lg transition-all duration-300 p-6 flex flex-col justify-between group">
                <div class="flex flex-col items-center text-center">
                    <img src="{{ $student->media->first()?->url ? asset( $student->media->first()->url) : asset('images/profile/user_ic.svg') }}"
                         class="w-20 h-20 mb-2 rounded-full object-cover border-2 border-indigo-200 group-hover:border-indigo-400" alt="Student Photo">
                    <h2 class="text-lg font-bold text-gray-900">{{ $student->user->name ?? 'N/A' }}</h2>
                    <p class="text-sm text-gray-600 break-all w-full">{{ $student->user->email ?? 'No email' }}</p>
                </div>

                <form id="delete-form-{{ $student->id }}" method="POST" action="{{ route('admin.delete_student', $student->id) }}" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="showConfirm = true; formId = 'delete-form-{{ $student->id }}'"
                        class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
                        Delete
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-600">No students found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pt-4">
        {{ $students->links() }}
    </div>

    <!-- Confirmation Modal -->
    <div x-show="showConfirm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-sm text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Are you sure?</h2>
            <p class="text-sm text-gray-600 mb-6">This student account will be permanently removed.</p>
            <div class="flex justify-center gap-4">
                <button @click="showConfirm = false"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                <button @click="document.getElementById(formId).submit()"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.5s ease-out both;
}
</style>
<script>feather.replace()</script>



@endsection

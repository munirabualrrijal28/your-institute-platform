@extends('admin.layouts.layout')

@section('content')
<div class="space-y-6 animate-fade-in">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>


                              {{-- <livewire:notifications.notify /> --}}



    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Students Card -->
        <div class="bg-white rounded-2xl shadow border border-gray-200 p-6 transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm text-gray-500">Total Students</h2>
                    <p class="text-3xl font-bold text-brand">{{ $studentCount }}</p>
                </div>
                <div class="bg-teal-100 text-brand p-3 rounded-xl">
                    <i data-feather="user" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Verified Institutes -->
        <div class="bg-white rounded-2xl shadow border border-gray-200 p-6 transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm text-gray-500">Verified Institutes</h2>
                    <p class="text-3xl font-bold text-brand">{{ $verifiedCount }}</p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-xl">
                    <i data-feather="check-circle" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Unverified Institutes -->
        <div class="bg-white rounded-2xl shadow border border-gray-200 p-6 transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm text-gray-500">Pending Institutes</h2>
                    <p class="text-3xl font-bold text-brand">{{ $unverifiedCount }}</p>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
                    <i data-feather="clock" class="w-6 h-6"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.4s ease-out both;
}
</style>
<script>feather.replace()</script>
@endsection

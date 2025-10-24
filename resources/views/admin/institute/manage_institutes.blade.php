@extends('admin.layouts.layout')

@section('content')

    <div class="h-[90vh] flex flex-col space-y-6">

        <!-- 🔍 Search & Filter -->
        {{-- <form method="GET" class="flex flex-wrap items-center justify-between gap-4 bg-white p-4 border rounded-xl shadow"> --}}

        <form method="GET" class="flex flex-wrap items-center justify-between gap-4 bg-white p-4 border rounded-xl shadow">

            <!-- Search input -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by institute name..."
                class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring focus:ring-teal-300">

            <!-- Filter dropdown -->
            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <option value="">All Statuses</option>
                <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                <option value="unverified" {{ request('status') === 'unverified' ? 'selected' : '' }}>Unverified</option>
            </select>

            <div class="flex gap-2">
                <!-- Submit -->
                <button type="submit"
                    class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-teal-700 transition">
                    Apply
                </button>

                <!-- Reset -->
                <a href="{{ route('admin.manage.institutes') }}"
                    class="px-4 py-2 bg-gray-200 text-sm rounded-lg hover:bg-gray-300 text-gray-800 transition">
                    Reset
                </a>
            </div>
        </form>


        <!-- Top Section: Institute Table -->
        <div class="bg-white shadow rounded-xl overflow-auto max-h-[50vh] border border-gray-200">
            <table class="w-full text-sm text-left min-w-[800px]">
                <thead class="sticky top-0 bg-gray-100 text-gray-700 z-10">
                    <tr>
                        <th class="w-20"></th>
                        <th>Select</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Courses</th>
                        <th>Ads</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($institutes as $inst)
                        @php $isActive = request('active') == $inst->id; @endphp
                        <tr
                            class="transition-all group {{ $isActive ? 'bg-teal-50 scale-[1.01] ring-2 ring-teal-400' : 'hover:bg-gray-50' }}">
                            <!-- Pointer Icon -->
                            <td class="py-2 px-3 text-center">
                                @if ($isActive)
                                    <span class="text-teal-600 font-bold">▶</span>
                                @endif
                            </td>

                            <!-- Manage Button -->
                            <td class="py-2 px-3">
                                <a href="?active={{ $inst->id }}"
                                    class="flex items-center gap-1 px-3 py-1 text-xs rounded text-black
                      {{ $isActive ? 'bg-teal-600' : 'bg-teal-500 hover:bg-teal-600' }}">
                                    @if ($isActive)
                                        <i data-feather="check-circle" class="w-4 h-4"></i>
                                    @else
                                        <i data-feather="edit" class="w-4 h-4"></i>
                                    @endif
                                    Manage
                                </a>
                            </td>

                            <td class="py-2 px-3">

                                <img src="{{ $inst->ins_profile_photo ? asset($inst->ins_profile_photo) : asset('images/profile/user_ic.svg') }}"
                                    class="w-10 h-10 rounded-full border">


                                {{-- <img src="{{ $inst->ins_profile_photo ? asset('storage/' . $inst->ins_profile_photo) : asset('/images/profile/user_ic.svg') }}"
                            alt="{{ $inst->ins_name }} Logo"
                            class="w-[150px] h-[140px] object-over bg-white shadow-md rounded-xl overflow-hidden flex items-center justify-center border border-gray-200" /> --}}


                            </td>
                            <td class="py-2 px-3">{{ $inst->ins_name }}</td>
                            <td class="py-2 px-3">
                                @if ($inst->ins_is_verified)
                                    <span class="text-green-600 font-semibold">Verified</span>
                                @else
                                    <span class="text-yellow-500 font-semibold">Unverified</span>
                                @endif
                            </td>
                            <td class="py-2 px-3">{{ $inst->courses_count }}</td>
                            <td class="py-2 px-3">{{ $inst->advertisements_count }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>


        @if ($active)
            <div x-data="{ tab: 'verify' }" class="flex-1 space-y-6 overflow-y-auto border-t pt-4">

                <!-- Tabs Navigation -->
                <div class="flex items-center justify-between gap-4 border-b pb-2">

                    <!-- Left: Tabs -->
                    <div class="flex gap-4">
                        @foreach ([
            'verify' => '✅ Verify',
            'courses' => '📘 Courses',
            'ads' => '📢 Advertisements',
            'profile' => '🏛️ Institute Profile',
        ] as $key => $label)
                            <button @click="tab = '{{ $key }}'"
                                :class="tab === '{{ $key }}' ? 'text-teal-600 border-b-2 border-teal-600' :
                                    'text-gray-600'"
                                class="pb-1 text-sm font-semibold">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Right: Actions -->
                    <div class="flex gap-2">
                        @if ($active->ins_is_verified)
                            <form method="POST" action="{{ route('admin.restrict.institute', $active->id) }}">
                                @csrf
                                <button
                                    class="bg-yellow-500 text-white px-3 py-1 text-sm rounded hover:bg-yellow-600 transition">
                                    Restrict Institute
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.delete.institute', $active->id) }}"
                            onsubmit="return confirm('Are you sure you want to delete this institute?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600 transition">
                                Delete Institute
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tabs Content -->
                <div x-show="tab === 'verify'">
                    @include('admin.institute.tabs.verify', ['institute' => $active])
                </div>

                {{-- <div x-show="tab === 'restrict'">
                    @include('admin.institute.tabs.restrict', ['institute' => $active])
                </div> --}}

                <div x-show="tab === 'courses'">
                    @include('admin.institute.tabs.courses', ['institute' => $active])
                </div>

                <div x-show="tab === 'ads'">
                    @include('admin.institute.tabs.ads', ['institute' => $active])
                </div>

                <div x-show="tab === 'profile'">
                    @include('admin.institute.tabs.profile', ['institute' => $active])
                </div>
            </div>
        @else
            <div class="text-gray-500 text-center py-10">Select an institute from the table above to activate tab view.
            </div>
        @endif
    </div>


    </div>




    <script>
        document.querySelectorAll('.toggle-edit').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const id = this.dataset.id;
                const form = document.querySelector(`.reject-photo-form[data-id='${id}']`);
                const fileInput = form.querySelector('.file-upload');
                const rejectBtn = form.querySelector('.reject-btn');

                if (this.checked) {
                    fileInput.classList.remove('hidden');
                    fileInput.removeAttribute('disabled');
                    rejectBtn.removeAttribute('disabled');
                } else {
                    fileInput.classList.add('hidden');
                    fileInput.setAttribute('disabled', 'disabled');
                    rejectBtn.setAttribute('disabled', 'disabled');
                }
            });
        });
    </script>

    <div class="mt-4 px-2">
        {{ $institutes->links('pagination::tailwind') }}
    </div>

    <!-- Feather Icons + Alpine -->
    <script>
        feather.replace();
    </script>
@endsection

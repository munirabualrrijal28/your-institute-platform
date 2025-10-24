@extends('admin.layouts.layout')

@section('content')
    <div class="h-[90vh] flex flex-col space-y-6">
        @php

            use App\Models\Institute;

        @endphp
        <!-- Top Section: Filters + Table -->
        <div class="bg-white p-4 rounded-xl shadow border border-gray-200 max-h-[50vh] overflow-auto">
            <!-- Filters -->
            <form method="GET" class="flex flex-wrap gap-4 mb-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search reason..."
                    class="px-4 py-2 rounded-lg border border-gray-300 text-sm w-52">

                <select name="status" class="px-4 py-2 rounded-lg border border-gray-300 text-sm w-40">
                    <option value="">-- Status --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                </select>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    Filter
                </button>

                <a href="{{ route('admin.manage.reports') }}"
                    class="text-sm text-gray-500 hover:underline mt-2 sm:mt-0">Reset</a>
            </form>

            <!-- Table -->
            <table class="w-full text-sm text-left min-w-[800px]">
                <thead class="bg-gray-100 text-gray-700 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-2">Select</th>
                        <th>Reporter</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $r)
                        <tr
                            class="transition-all {{ request('active') == $r->id ? 'bg-teal-50 ring-1 ring-teal-400' : 'hover:bg-gray-50' }}">
                            <td class="px-4 py-2">
                                <a href="?active={{ $r->id }}" class="text-sm text-teal-600 hover:underline">
                                    @if (request('active') == $r->id)
                                        <i data-feather="check-circle" class="w-4 h-4 text-green-600"></i>
                                    @else
                                        View
                                    @endif
                                </a>
                            </td>
                            <td>{{ $r->reporter->name ?? 'N/A' }}</td>
                            <td>{{ class_basename($r->reportable_type) }}</td>
                            <td>{{ ucfirst($r->reason) }}</td>
                            <td>
                                <span
                                    class="text-xs px-2 py-1 rounded-full
                                {{ $r->status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : ($r->status === 'reviewed'
                                        ? 'bg-blue-100 text-blue-700'
                                        : 'bg-green-100 text-green-700') }}">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>
                            <td>{{ $r->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        </div>

        <!-- Bottom Section: Selected Report Details -->
        @if (request('active'))
            @php
                $selected = $reports->firstWhere('id', request('active'));
            @endphp

            @if ($selected)
                <!-- Inside selected report card -->
                <div class="mt-6 border-t pt-4">
                    {{-- Show preview if the reportable is a comment --}}
                    @if ($selected->reportable_type === \App\Models\Comments::class)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Comment Preview</h4>
                            <p class="text-gray-800 italic">
                                "{{ $selected->reportable->content ?? 'Deleted or unavailable.' }}"</p>
                        </div>
                    @endif
                </div>
                {{--  --}}
                {{--  --}}
                {{--  --}}
                {{-- 👤 User Info Card --}}
                @if ($selected->reportable_type === \App\Models\Comments::class && $selected->reportable && $selected->reportable->user)
                    @php
                        $reportedUser = $selected->reportable->user;
                        if ($reportedUser->role === 1) {
                            // Institute user
                            $institute = Institute::where('user_id_fk', $reportedUser->id)->first();
                            $profileUrl =
                                $institute && $institute->ins_profile_photo
                                    ? asset($institute->ins_profile_photo)
                                    : asset('images/profile/user_ic.svg');
                        } else {
                            // Regular user with media
                            $profile = $reportedUser->media->firstWhere('type', 'profile_photo');
                            $profileUrl = $profile
                                ? asset('storage/' . $profile->url)
                                : asset('images/profile/user_ic.svg');
                        }
                    @endphp

                    <div class="mt-6 bg-white border border-gray-200 rounded-lg p-5 shadow">
                        <h3 class="text-base font-semibold text-gray-800 mb-3">👤 Reported User Details</h3>

                        <div class="flex items-center gap-4">
                            <img src="{{ $profileUrl ? asset($profileUrl) : asset('images/profile/user_ic.svg') }}"
                                class="w-14 h-14 rounded-full border object-cover" alt="User Profile">

                            <div class="text-sm text-gray-700">
                                <p><strong>Name:</strong> {{ $reportedUser->name }}</p>
                                <p><strong>Email:</strong> {{ $reportedUser->email }}</p>
                                <p><strong>Role:</strong>
                                    @switch($reportedUser->role)
                                        @case(1)
                                            Institute
                                        @break

                                        @case(2)
                                            Student
                                        @break

                                        @default
                                            Unknown
                                    @endswitch
                                </p>
                            </div>
                        </div>

                        {{-- <form method="POST" action="{{ route('admin.report.deleteUser', $reportedUser->id) }}"
                            onsubmit="return confirm('Are you sure you want to delete this user and all their content?')"
                            class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm transition">
                                ❌ Delete This User
                            </button>
                        </form> --}}
                    </div>
                @endif






                {{--  --}}
                {{--  --}}
                {{--  --}}
                <div class="mt-6 space-x-3 flex flex-wrap">
                    {{-- Notify Button --}}
                    {{-- <form method="POST" action="{{ route('admin.report.notify', $selected->id) }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
                            Notify Reporter
                        </button>
                    </form> --}}

                    {{-- Delete Reported Content --}}
                    <form method="POST" action="{{ route('admin.report.deleteContent', $selected->id) }}"
                        onsubmit="return confirm('Are you sure you want to delete the reported content?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">
                            Delete Reported Content
                        </button>
                    </form>

                    {{-- Resolve Without Deleting --}}
                    <form method="POST" action="{{ route('admin.report.resolve', $selected->id) }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600">
                            ✅ Mark as Resolved
                        </button>
                    </form>

                    {{-- Delete User Who Wrote the Content --}}
                    @php
                        $contentOwner = $selected->reportable->user ?? null;
                    @endphp

                    @if ($contentOwner)
                        <form method="POST" action="{{ route('admin.report.deleteUser', $contentOwner->id) }}"
                            onsubmit="return confirm('Delete this user and all their data?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-900">
                                Delete User
                            </button>
                        </form>
                    @endif
                </div>



                {{--  --}}
                {{--  --}}
                {{--  --}}
                <div class="flex-1 overflow-y-auto border-t pt-4 space-y-4">

                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Report Details</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                            <div><strong>Reporter:</strong> {{ $selected->reporter->name ?? 'N/A' }}</div>
                            <div><strong>Email:</strong> {{ $selected->reporter->email ?? 'N/A' }}</div>
                            <div><strong>Reported Type:</strong> {{ class_basename($selected->reportable_type) }}</div>
                            <div><strong>Reason:</strong> {{ ucfirst($selected->reason) }}</div>
                            <div class="col-span-2"><strong>Description:</strong> {{ $selected->description ?? 'N/A' }}
                            </div>
                            <div><strong>Created at:</strong> {{ $selected->created_at->format('Y-m-d H:i') }}</div>
                        </div>

                        <div class="mt-6 space-x-3">
                            {{-- <form method="POST" action="{{ route('admin.report.notify', $selected->id) }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
                                    Notify Reporter
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.report.deleteContent', $selected->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete the reported content?')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">
                                    Delete Reported Content
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-gray-500 text-center py-10">Invalid report selected.</div>
            @endif
        @else
            <div class="text-gray-500 text-center py-10">Select a report from the table above to view details.</div>
        @endif
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        feather.replace();
    </script>
@endsection

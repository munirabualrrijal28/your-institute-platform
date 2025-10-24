<div class="bg-white border border-gray-200 rounded-xl shadow p-5 max-w-3xl mx-auto">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Verification Status</h2>

    <!-- Profile Info -->
    <div class="flex items-center gap-4 mb-5">
        <img src="{{ $institute->ins_profile_photo ? asset($institute->ins_profile_photo) : asset('images/profile/user_ic.svg') }}"
            class="w-16 h-16 rounded-full border border-teal-300 object-cover">
        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-800">{{ $institute->ins_name }}</h3>
            <p class="text-sm text-gray-500 mt-1">
                Status:
                @if ($institute->ins_is_verified)
                    <span class="text-green-600 font-semibold">Verified</span>
                @else
                    <span class="text-yellow-500 font-semibold">Pending</span>
                @endif
            </p>
        </div>
    </div>

    <!-- License Viewer & Rejection -->
    @if ($institute->ins_lic_photo)
        <div x-data="{ open: false, reject: false }" class="space-y-4">
            <!-- View License Button -->
            <button @click="open = true" class="text-sm text-blue-600 underline hover:text-blue-800 transition">
                View License Document
            </button>

            <!-- Modal Preview -->
            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
                <div class="bg-white rounded-lg shadow-xl p-6 relative max-w-xl w-full animate-fade-in">
                    <button @click="open = false" class="absolute top-3 right-3 text-gray-400 hover:text-red-600">
                        <i data-feather="x" class="w-5 h-5"></i>
                    </button>
                    <h4 class="text-lg font-semibold mb-4">Uploaded License</h4>
                    <img src="{{ asset('storage/' . $institute->ins_lic_photo) }}"
                        class="w-full h-auto rounded-lg shadow border">
                </div>
            </div>

            <!-- Reject License Toggle -->
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="reject" class="form-checkbox text-red-600">
                <span class="ml-2 text-sm text-gray-600">Enable reject license photo</span>
            </label>
            @if (session('message'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                    class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow">
                    {{ session('message') }}
                </div>
            @endif
            <!-- Reject Form -->
            <form method="POST" action="{{ route('admin.reject_license', $institute->id) }}" x-show="reject"
                x-transition onsubmit="return confirm('Reject license photo? This will remove the uploaded image.')">
                @csrf
                @method('PUT')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    ❌ Reject License Photo
                </button>
            </form>
        </div>
    @else
        <p class="text-sm text-gray-500">No license uploaded by this institute.</p>
    @endif

    <!-- Actions -->
    <div class="mt-6 flex gap-4">
        @unless ($institute->ins_is_verified)
            <!-- Verify Button -->
            {{-- <form action="{{ route('admin.verify.institute', $institute->id) }}" method="POST"> --}}
            <form method="POST" action="{{ route('admin.verify.institute', $institute->id) }}"
                onsubmit="return confirm('Are you sure you want to verify this institute? This action will notify them.')">
                @csrf
                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    ✅ Approve & Verify
                </button>
            </form>
        @else
            <!-- Restrict Button -->
            {{-- <form method="POST" action="{{ route('admin.restrict.institute', $institute->id) }}"> --}}
            <form method="POST" action="{{ route('admin.restrict.institute', $institute->id) }}"
                onsubmit="return confirm('Are you sure you want to restrict this institute? This will prevent them from posting courses or ads.')">
                @csrf
                <button type="submit" class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                    ⚠️ Restrict Institute
                </button>
            </form>
        @endunless
    </div>
</div>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.4s ease-out both;
    }
</style>

<div x-data="{ enableReset: false, showConfirm: false, showPassword: false, showSuccess: false, password: '' }">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">



        {{--  --}}
        {{--  --}}
        {{--  --}}
        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> --}}

        <form action="{{ route('settings_updateUserName') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col justify-between">

                <!-- Name Update Card -->
                <div class="bg-white p-6 rounded-2xl shadow-md space-y-4">
                    <h3 class="text-xl font-bold text-gray-800">👤 Update Your Name</h3>

                    <div>
                        <label for="name" class="block font-semibold text-sm text-gray-600 mb-1">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full border px-4 py-2 rounded-xl focus:ring-teal-500 focus:outline-none"
                            value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Profile Photo Card -->
                <div class="bg-white p-6 rounded-2xl shadow-md space-y-4">
                    <h3 class="text-xl font-bold text-gray-800">📷 Profile Photo</h3>

                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                        <img id="preview"
                            src="{{ auth()->user()->profilePhoto()?->url ? asset('storage/' . auth()->user()->profilePhoto()->url) : '/images/profile/user_ic.svg' }}"
                            class="w-20 h-20 rounded-full object-cover border shadow" />

                        <input type="file" name="photo" id="photoInput" accept="image/*"
                            class="w-full border px-4 py-2 rounded-xl focus:outline-none focus:ring-teal-500">
                    </div>
                    @error('photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Submit Button Row -->
                <div class="text-center">
                    <button type="submit" id="submitBtn"
                        class="mt-4 bg-teal-600 text-white px-5 py-2 rounded-xl hover:bg-teal-700 transition w-full disabled:opacity-50 disabled:cursor-not-allowed">
                        Save Changes
                    </button>
                </div>
            </div>


        </form>

        <!-- Optional JS Preview Script -->
        <script>
            document.getElementById('photoInput')?.addEventListener('change', function(e) {
                const [file] = e.target.files;
                if (file) {
                    document.getElementById('preview').src = URL.createObjectURL(file);
                }
            });
        </script>

        {{-- </div> --}}

        <script>
            const photoInput = document.getElementById('photoInput');
            const preview = document.getElementById('preview');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('profileForm');

            photoInput.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);

                    // Simulate upload wait — disable the button
                    submitBtn.disabled = true;
                    submitBtn.innerText = 'Uploading...';

                    // Simulated delay — 1 second
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerText = 'Save Changes';
                    }, 1000);
                }
            });
        </script>




        {{--  --}}
        {{--  --}}
        {{--  --}}

        <!-- Reset Password Card -->
        <!-- Reset Password Card -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                    class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-xl text-sm shadow">
                    {{ session('success') }}
                </div>
            @endif

            <h3 class="text-xl font-bold mb-4">🔐 Reset Password</h3>

            <div class="flex items-center mb-4">
                <input type="checkbox" id="enable-reset" class="mr-2" @change="enableReset = $event.target.checked">
                <label for="enable-reset" class="text-gray-700 font-medium">Enable Password Reset</label>
            </div>

            <form method="POST" action="{{ route('settings_updatePassword') }}" x-show="enableReset"
                class="space-y-4 mt-2">
                @csrf
                @method('PUT')

                <!-- Old Password -->
                <div class="relative">
                    <label for="old-password" class="block text-gray-700 font-medium mb-1">Old Password</label>
                    <input type="password" name="old_password" id="old-password"
                        class="w-full px-4 py-2 pr-10 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
                        required>
                    <i onclick="togglePassword('old-password')"
                        class="feather-eye absolute top-9 right-3 cursor-pointer text-gray-500"></i>
                    @error('old_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="relative">
                    <label for="new-password" class="block text-gray-700 font-medium mb-1">New Password</label>
                    <input type="password" name="new_password" id="new-password"
                        class="w-full px-4 py-2 pr-10 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
                        required>
                    <i onclick="togglePassword('new-password')"
                        class="feather-eye absolute top-9 right-3 cursor-pointer text-gray-500"></i>
                    @error('new_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div class="relative">
                    <label for="confirm-password" class="block text-gray-700 font-medium mb-1">Confirm New
                        Password</label>
                    <input type="password" name="new_password_confirmation" id="confirm-password"
                        class="w-full px-4 py-2 pr-10 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
                        required>
                    <i onclick="togglePassword('confirm-password')"
                        class="feather-eye absolute top-9 right-3 cursor-pointer text-gray-500"></i>
                </div>

                <button type="submit"
                    class="mt-4 bg-teal-600 text-white px-5 py-2 rounded-xl hover:bg-teal-700 transition w-full disabled:opacity-50 disabled:cursor-not-allowed">
                    Reset Password
                </button>
            </form>
        </div>


        {{--  --}}

        @if (session('success'))
            <div class="fixed top-6 right-6 bg-green-100 text-green-800 px-6 py-3 rounded shadow z-50">
                {{ session('success') }}
            </div>
        @endif


        <!-- Delete Account Card -->
        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col justify-between">
            <h3 class="text-xl font-bold mb-4 text-red-600 text-center">Delete Account</h3>
            <p class="text-gray-600 mb-6">This action is irreversible. All your data will be permanently deleted.</p>
            <div class="text-center">
                <button @click="showConfirm = true"
                    class="bg-red-500 text-white px-6 py-2 rounded-xl font-semibold hover:bg-red-600 transition shadow">
                    Delete Account <i data-feather="trash" class="inline w-5 h-5 ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Dialog 1: Confirm Delete -->
        <div x-show="showConfirm" x-cloak
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-sm animate-scale-in">
                <h3 class="text-xl font-bold text-red-600 mb-4">Are you sure?</h3>
                <p class="text-gray-700 mb-6">Do you really want to delete your account?</p>
                <div class="flex justify-end gap-4">
                    <button @click="showConfirm = false" class="bg-gray-200 px-4 py-2 rounded-xl">Cancel</button>
                    <button @click="showConfirm = false; showPassword = true"
                        class="bg-red-600 text-white px-4 py-2 rounded-xl">Yes, Delete</button>
                </div>
            </div>
        </div>

        <!-- Dialog 2: Enter Password -->
        <div x-show="showPassword" x-cloak
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-sm animate-scale-in">
                <h3 class="text-xl font-bold text-red-600 mb-4">Enter Password</h3>

                <form method="POST" action="{{ route('settings_deleteAccount') }}">
                    @csrf
                    @method('DELETE')

                    <input type="password" name="confirm_password" x-model="password"
                        class="w-full mb-4 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-500"
                        placeholder="Password">

                    <div class="flex justify-end gap-4">
                        <button @click="showPassword = false" type="button"
                            class="bg-gray-200 px-4 py-2 rounded-xl">Cancel</button>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700">
                            Confirm Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>


        {{--  --}}

<div>
    <!-- resources/views/user/settings/account-edit.blade.php -->
    <form action="{{ route('settings_updateUserName') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            <!-- Name -->
            <div class="bg-white p-6 rounded-2xl shadow-md mb-6">

                <h3 class="dialog-title text-gray-800">Update Your Name</h3>
                <label for="name" class="block font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded-xl"
                    value="{{ old('name', auth()->user()->name) }}">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Photo -->
            <div class="bg-white p-6 rounded-2xl shadow-md mb-6">
                <label class="block font-bold mb-2">Profile Photo</label>
                <img id="preview"
                    src="{{ auth()->user()->profilePhoto()?->url ? asset('storage/' . auth()->user()->profilePhoto()->url) : '/images/profile/user_ic.svg' }}"
                    class="w-20 h-20 rounded-full object-cover border mb-2">

                <input type="file" name="photo" id="photoInput" accept="image/*"
                    class="w-full border px-4 py-2 rounded-xl">
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <button type="submit" id="submitBtn"
                    class="bg-teal-600 text-white px-6 py-2 rounded-xl hover:bg-teal-700">
                    Save Changes
                </button>
            </div>
        </div>




    </form>

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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div>
            {{-- Name Section --}}
            <div class="bg-white p-6 rounded-2xl shadow-md mb-6">
                <h3 class="text-xl font-bold mb-4 flex justify-between items-center">
                    Name
                    <button wire:click="$emit('openNameModal')" class="text-blue-600 text-sm hover:underline">✏️
                        Edit</button>
                </h3>
                <p class="text-gray-700">{{ $name }}</p>
            </div>

            {{-- Profile Photo Section --}}
            <div class="bg-white p-6 rounded-2xl shadow-md mb-6">
                <h3 class="text-xl font-bold mb-4 flex justify-between items-center">
                    Profile Photo
                    <button wire:click="$emit('openPhotoModal')" class="text-blue-600 text-sm hover:underline">📤
                        Change</button>
                </h3>
                <img src="{{ $photoUrl }}" class="w-20 h-20 rounded-full object-cover border" />
            </div>



        </div>
    </div>
</div>

<!-- account.blade.php -->
<!-- Reset Password and Delete Account Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Reset Password Card -->
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <h3 class="text-xl font-bold mb-4">Reset Password</h3>
        <div class="flex items-center mb-4">
            <input type="checkbox" id="enable-reset" class="mr-2"
                onchange="document.querySelectorAll('.reset-input').forEach(input => input.disabled = !this.checked)">
            <label for="enable-reset" class="text-gray-700 font-medium">Enable Password Reset</label>
        </div>
        <div class="space-y-4">
            <div class="relative">
                <label class="block text-gray-700 font-medium mb-1">Old Password</label>
                <input type="password" id="old-password"
                    class="reset-input w-full px-4 py-2 pr-10 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
                    disabled>
                <i onclick="togglePassword('old-password')"
                    class="feather-eye absolute top-9 right-3 cursor-pointer text-gray-500"></i>
            </div>
            <div class="relative">
                <label class="block text-gray-700 font-medium mb-1">New Password</label>
                <input type="password" id="new-password"
                    class="reset-input w-full px-4 py-2 pr-10 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
                    disabled>
                <i onclick="togglePassword('new-password')"
                    class="feather-eye absolute top-9 right-3 cursor-pointer text-gray-500"></i>
            </div>
            <div class="relative">
                <label class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
                <input type="password" id="confirm-password"
                    class="reset-input w-full px-4 py-2 pr-10 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
                    disabled>
                <i onclick="togglePassword('confirm-password')"
                    class="feather-eye absolute top-9 right-3 cursor-pointer text-gray-500"></i>
            </div>
            <button id="reset-btn"
                class="reset-input mt-4 bg-teal-600 text-white px-5 py-2 rounded-xl hover:bg-teal-700 transition w-full"
                disabled>Reset</button>
        </div>
    </div>

    <!-- Delete Account Card -->
    <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col justify-between">
        <h3 class="text-xl font-bold mb-4 text-red-600 text-center">Delete Account</h3>
        <p class="text-gray-600 mb-6">This action is irreversible. All your data will be permanently deleted.</p>
        {{-- <button id="delete-btn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-xl transition shadow">Delete Account <i data-feather="trash" class="inline w-5 h-5 ml-2"></i></button> --}}
        <div class="text-center">
            {{-- <button @click="showConfirm = true"
                class="bg-red-500 text-white px-6 py-2 rounded-xl font-semibold hover:bg-red-600 transition">Delete
                Account <i data-feather="trash" class="inline w-5 h-5 ml-2"></i></button> --}}
            <button @click="showConfirm = true"
                class="bg-red-500 text-white px-6 py-2 rounded-xl font-semibold hover:bg-red-600 transition-all duration-300 shadow">Delete
                Account <i data-feather="trash" class="inline w-5 h-5 ml-2"></i></button>

        </div>
    </div>
</div>
</div>

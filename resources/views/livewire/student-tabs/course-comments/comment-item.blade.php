<div>
    <div>


        <div class="bg-white rounded-xl shadow p-4 space-y-2 text-sm text-gray-800">
            @php
                use App\Models\Institute;
                $user = $comment->user;
                if ($user->role === 1) {
                    // Institute user
                    $institute = Institute::where('user_id_fk', $user->id)->first();
                    $profileUrl =
                        $institute && $institute->ins_profile_photo
                            ? asset($institute->ins_profile_photo)
                            : asset('images/profile/user_ic.svg');
                } else {
                    // Regular user with media
                    $profile = $user->media->firstWhere('type', 'profile_photo');
                    $profileUrl = $profile ? asset('storage/' . $profile->url) : asset('images/profile/user_ic.svg');
                }
            @endphp

            <div class="flex items-start gap-3">
                <!-- User Avatar -->
                <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-300 shadow-sm">
                    <img src="{{ $profileUrl }}" alt="Profile" class="w-full h-full object-cover" />
                </div>

                <!-- Comment Content -->
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-teal-700">{{ $user->name }}</p>
                            <span class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>

                        @if ($comment->user_id_fk === auth()->id())
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="text-gray-500 hover:text-gray-700 transition">⋮</button>
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow z-10">
                                    {{-- <button wire:click="startEdit"
                                        class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">✏️
                                        Edit</button> --}}
                                    <button wire:click="confirmDelete"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">🗑️
                                        Delete</button>
                                        {{--  --}}



                                        {{--  --}}
                                </div>
                            </div>
                        @endif
                    </div>
                        <p class="mt-2 text-gray-700">{{ $comment->content }}</p>

                    {{-- @if ($isEditing)
                        <form wire:submit.prevent="updateComment" class="mt-2 space-y-2">
                            <textarea wire:model="editContent" rows="2"
                                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-teal-400"></textarea>
                            @error('editContent')
                                <div class="text-red-500 text-xs">{{ $message }}</div>
                            @enderror
                            <div class="flex gap-2">
                                <button type="submit"
                                    class="px-4 py-1 bg-teal-600 text-white rounded hover:bg-teal-700 transition">Save</button>
                                <button type="button" wire:click="cancelEdit"
                                    class="px-3 py-1 text-gray-600 hover:underline">Cancel</button>
                            </div>
                        </form>
                    @else
                        <p class="mt-2 text-gray-700">{{ $comment->content }}</p>
                    @endif --}}
{{-- Report  --}}
@if ($comment->user_id_fk !== auth()->id())
    <div x-data="{ showReport: false }" class="mt-3">
        <button @click="showReport = true" class="text-xs text-red-500 hover:underline">🚨 Report</button>

        <!-- Report Modal -->
        <div x-show="showReport" @click.away="showReport = false"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm space-y-4 animate-fade-in">
                <h3 class="text-lg font-semibold text-gray-800">Report Comment</h3>
                <form method="POST" action="{{ route('reports_store') }}">
                    @csrf
                    <input type="hidden" name="reportable_type" value="App\Models\Comments">
                    <input type="hidden" name="reportable_id" value="{{ $comment->id }}">

                    <label class="block text-sm text-gray-700 font-medium mb-1">Reason</label>
                    <select name="reason" required class="w-full border rounded px-3 py-2 text-sm">
                        <option value="spam">Spam</option>
                        <option value="abuse">Abusive Language</option>
                        <option value="scam">Scam or Fraud</option>
                        <option value="other">Other</option>
                    </select>

                    <label class="block text-sm text-gray-700 font-medium mt-3 mb-1">Additional Notes</label>
                    <textarea name="description" rows="2" class="w-full border rounded px-3 py-2 text-sm"></textarea>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="showReport = false"
                            class="px-3 py-1 rounded text-gray-600 hover:underline">Cancel</button>
                        <button type="submit"
                            class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif



                    {{--  --}}
                    @if ($confirmingDelete)
                        {{-- <div class="mt-3 bg-yellow-50 border border-yellow-300 p-3 rounded">
                    <p class="text-sm text-yellow-800 font-medium">Are you sure you want to delete this comment?</p>
                    <div class="mt-2 flex gap-2">
                        <button wire:click="deleteComment" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">Yes, Delete</button>
                        <button wire:click="cancelDelete" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">Cancel</button>
                    </div>
                </div> --}}
                        <div class="mt-3 bg-yellow-50 border border-yellow-300 p-3 rounded">
                            <p class="text-sm text-yellow-800 font-medium">Are you sure you want to delete this comment?
                            </p>
                            <div class="mt-2 flex gap-2">
                                <button wire:click="deleteComment" wire:loading.attr="disabled"
                                    wire:target="deleteComment"
                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    <span wire:loading.remove wire:target="deleteComment">Yes, Delete</span>
                                    <span wire:loading wire:target="deleteComment">Deleting...</span>
                                </button>
                                <button wire:click="cancelDelete"
                                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Animations -->
        <style>
            @keyframes fade-in-item {
                from {
                    opacity: 0;
                    transform: translateY(6px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in-item {
                animation: fade-in-item 0.4s ease-out;
            }
        </style>
    </div>
</div>

<div dir="ltr"> {{-- ✅ ROOT WRAPPER START --}}

    @php
        use App\Models\Institute;
        $user = Auth::user();
        // dd($user->id);
        // $institute = Institute::where('user_id_fk', $user->id)->first();
        $institute = Institute::where('id', $instituteId)->first();
        // dd($institute);
        $blocked = !$institute || !$institute->ins_is_verified || $institute->is_restricted;
        // dd($blocked);
    @endphp

    <div class="space-y-6 ltr" dir="ltr">
        <!-- ✅ Course Form -->
        <div class="bg-white rounded-2xl p-6 shadow-md space-y-4 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ $editing ? 'تعديل الدورة' : 'إضافة دورة جديد' }}
            </h2>

            @if (session('message'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                    class="bg-green-100 text-green-800 p-3 rounded-lg shadow">
                    {{ session('message') }}
                </div>
            @endif
            {{--  --}}


            @if ($blocked)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-xl">
                    <p class="font-semibold">⚠ لا يمكنك إضافة أو تعديل الدورات حالياً.</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @if (!$institute->ins_is_verified)
                            <li>المعهد غير موثق. الرجاء انتظار التوثيق من قبل الإدارة.</li>
                        @elseif ($institute->is_restricted)
                            <li>تم تقييد المعهد من قبل الإدارة. يرجى التواصل مع الدعم.</li>
                        @endif
                    </ul>
                </div>
            @else
                <form wire:submit.prevent="saveCourse" wire:key="form-{{ $formKey }}" class="space-y-4"
                    x-data="{ isUploading: false }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false">

                    <!-- Name -->
                    <div>
                        <label class="block font-medium text-sm mb-1">اسم الدورة</label>
                        <input type="text" wire:model.defer="course_name"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            required />
                        @error('course_name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-medium text-sm mb-1">وصف الدورة</label>
                        <textarea wire:model.defer="course_description"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            required></textarea>
                        @error('course_description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block font-medium text-sm mb-1">الفئة</label>
                        <select wire:model.defer="category_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <option value="">اختر فئة</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Images -->
                    <div>
                        <label class="block font-medium text-sm mb-1">صور الدورة</label>
                        <input type="file" wire:model="images" multiple class="w-full" />
                        @error('images.*')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <div class="mt-2 flex gap-2">
                            @if ($images)
                                @foreach ($images as $image)
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="w-20 h-20 object-cover rounded border shadow" />
                                @endforeach
                            @elseif ($existingImage)
                                <img src="{{ asset('storage/' . $existingImage) }}"
                                    class="w-20 h-20 object-cover rounded border shadow" />
                            @endif
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-all"
                            x-bind:disabled="isUploading">
                            <span x-show="!isUploading">{{ $editing ? 'تحديث' : 'إضافة' }}</span>
                            <span x-show="isUploading" class="flex items-center">
                                <svg class="animate-spin h-5 w-5 text-white mr-2" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                                </svg>
                                جاري رفع الصور...
                            </span>
                        </button>

                        @if ($editing)
                            <button type="button" wire:click="resetForm"
                                class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg font-semibold">
                                إلغاء
                            </button>
                        @endif
                    </div>
                </form>

            @endif


            {{--  --}}


            {{--  --}}
        </div>

        <!-- ✅ Course List in Two Rows and 4 Columns -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 px-6">
            @foreach ($courses as $course)
                @php
                    $imageUrl = $course->media->first()
                        ? asset('storage/' . $course->media->first()->url)
                        : asset('images/profile/user_ic.svg');
                @endphp

                <div x-data="{ showComments: false }" class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                    <img src="{{ $imageUrl }}" alt="Course Image" class="w-full h-40 object-cover">

                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-center text-lg font-bold text-gray-800 mb-1">{{ $course->course_name }}</h3>
                        <p class="text-center text-sm text-gray-600 mb-2">
                            {{ Str::limit($course->course_description, 80) }}</p>
                        <p class="text-center text-xs text-gray-400 mb-2">📅 {{ $course->created_at->diffForHumans() }}
                        </p>

                        {{-- comments --}}
                        <div x-data="{ showComments: false }">
                            <!-- Trigger button -->
                            <button @click="showComments = true; $wire.loadComments({{ $course->id }})"
                                class="text-blue-600 hover:underline text-sm">
                                💬 التعليقات ({{ $course->comments->count() }})
                            </button>

                            <!-- Modal -->
                            <div x-show="showComments"
                                class="fixed inset-0 bg-black bg-opacity-40 z-40 flex flex-col md:flex-row"
                                @click.self="showComments = false" x-transition>

                                <!-- Left Side -->
                                <div
                                    class="w-full md:w-1/2 bg-gray-200 text-white flex flex-col justify-center items-center p-6 space-y-6">
                                    <div class="text-lg text-black font-semibold text-center">
                                        {{ $course->course_description }}</div>
                                    <img src="{{ $imageUrl ?? 'images/profile/user_ic.svg' }}" alt="Course Image"
                                        class="rounded-xl w-full max-h-64 md:max-h-72 object-cover">
                                </div>

                                <!-- Right Side -->
                                <div class="w-full md:w-1/2 h-full bg-white shadow-xl p-4 overflow-y-auto"
                                    dir="ltr">
                                    <div class="flex justify-between items-center border-b pb-2 mb-4">
                                        <h2 class="text-lg font-bold">التعليقات</h2>
                                        <button @click="showComments = false"
                                            class="text-gray-500 hover:text-red-500 text-xl">✖</button>
                                    </div>

                                    <!-- Comments -->
                                    <div class="space-y-2 max-h-96 overflow-y-auto">
                                        <!-- Comment with Replies -->
                                        <!-- Comment with Replies -->
                                        <!-- Loading Indicator -->
                                        <div wire:loading wire:target="loadComments"
                                            class="text-center text-sm text-gray-500 py-2">
                                            ⏳ جارٍ تحميل التعليقات...
                                        </div>
                                        @foreach ($comments[$course->id] ?? [] as $comment)
                                            {{--  --}}
                                            @php
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
                                                    $profileUrl = $profile
                                                        ? asset('storage/' . $profile->url)
                                                        : asset('images/profile/user_ic.svg');
                                                }
                                            @endphp

                                            {{--  --}}
                                            <div
                                                class="bg-white border border-gray-200 rounded-xl p-4 space-y-3 shadow-sm">
                                                <!-- Main Comment -->
                                                <div class="flex items-start gap-3">
                                                    <!-- Avatar -->
                                                    <img src="{{ $profileUrl ?? asset('images/profile/user_ic.svg') }}"
                                                        class="w-9 h-9 rounded-full object-cover" alt="avatar">

                                                    <div class="flex-1 text-left">
                                                        <div class="text-sm font-semibold text-gray-800">
                                                            {{ $comment->user->name }}</div>
                                                        <div class="text-sm text-gray-700">{{ $comment->content }}
                                                        </div>
                                                        {{-- code down here for editing  --}}
                                                        {{-- @if (!($editingComments[$comment->id] ?? false))
                                                            <div class="text-sm text-gray-700">{{ $comment->content }}
                                                            </div>
                                                        @else --}}
                                                        {{-- <textarea wire:model.defer="commentEditContents.{{ $comment->id }}"
                                                                wire:key="comment-edit-{{ $comment->id }}-{{ now()->timestamp }}"
                                                                class="w-full border rounded px-2 py-1 text-sm mb-1" rows="2"></textarea>

                                                            <div class="flex gap-2 text-xs mt-1">
                                                                <button
                                                                    wire:click="updateComment({{ $comment->id }}, {{ $course->id }})"
                                                                    class="text-green-600 hover:underline">حفظ</button>
                                                                <button
                                                                    wire:click="$set('editingComments.{{ $comment->id }}', false)"
                                                                    class="text-gray-500 hover:underline">إلغاء</button>
                                                            </div>
                                                        @endif --}}

                                                        {{--  --}}
                                                        <div class="text-xs text-gray-400 mt-1">
                                                            {{ $comment->created_at->diffForHumans() }}</div>
                                                    </div>
                                                    {{--  --}}
                                                    {{--  --}}
                                                    {{--  --}}
                                                    @if ($comment->user_id_fk === auth()->id())
                                                        <div x-data="{ openMenu: false }"
                                                            class="relative ml-auto text-left">
                                                            <button @click="openMenu = !openMenu"
                                                                class="text-gray-500 hover:text-gray-700">⋮</button>
                                                            <div x-show="openMenu" @click.away="openMenu = false"
                                                                class="absolute z-10 mt-2 right-0 w-28 bg-white border border-gray-200 rounded-md shadow-lg text-sm">
                                                                {{-- <button @click="openMenu = false"
                                                                    wire:click="startEditComment({{ $comment->id }}, '{{ $comment->content }}')"
                                                                    class="block w-full text-right px-4 py-2 hover:bg-gray-100">تعديل</button> --}}

                                                                <button
                                                                    @click="Swal.fire({
    title: 'هل أنت متأكد؟',
    text: 'لا يمكنك التراجع عن هذا الحذف!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'نعم، احذف',
    cancelButtonText: 'إلغاء'
}).then((result) => {
    if (result.isConfirmed) {
        $wire.deleteComment({{ $course->id }}, {{ $comment->id }})
    }
})"
                                                                    class="block w-full text-right px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-800">
                                                                    حذف
                                                                </button>


                                                            </div>
                                                        </div>
                                                        {{--  --}}

                                                        {{--  --}}
                                                    @endif
                                                    @if ($comment->user_id_fk !== Auth::id())
                                                        <button @click="openMenu = false"
                                                            wire:click="openReportModal('comment', {{ $comment->id }})"
                                                            class="block w-full text-right px-4 py-2 hover:bg-gray-100 text-yellow-600">
                                                            🚩 إبلاغ
                                                        </button>
                                                    @endif
                                                    {{--  --}}
                                                    {{--  --}}
                                                    {{--  --}}
                                                </div>

                                                <!-- Replies -->
                                                @if ($comment->replies->isNotEmpty())
                                                    <div class="ml-4 mt-2 space-y-2">
                                                        <!-- Replies -->
                                                        @foreach ($comment->replies as $reply)
                                                            <div
                                                                class="bg-gray-50 border border-gray-200 rounded-lg p-3 flex gap-3">
                                                                <!-- Avatar -->
                                                                <img src="{{ $reply->user->institute
                                                                    ? asset($reply->user->institute->ins_profile_photo)
                                                                    : $reply->user->media->firstWhere('type', 'profile_photo')?->url ?? asset('images/profile/user_ic.svg') }}"
                                                                    class="w-7 h-7 rounded-full object-cover"
                                                                    alt="reply-avatar">

                                                                <div class="flex-1 text-left">
                                                                    <div class="text-sm font-semibold text-gray-800">
                                                                        {{ $reply->user->name }}</div>
                                                                    <div class="text-sm text-gray-700">
                                                                        {{ $reply->content }}</div>
                                                                    <!-- 📝 Toggle between edit mode and view mode -->
                                                                    {{-- @if (!($editingReplies[$reply->id] ?? false))
                                                                        <div class="text-sm text-gray-700">
                                                                            {{ $reply->content }}</div>
                                                                    @else
                                                                        <textarea wire:model.defer="replyEditContents.{{ $reply->id }}"
                                                                            wire:key="reply-edit-{{ $reply->id }}-{{ now()->timestamp }}"
                                                                            class="w-full border rounded px-2 py-1 text-sm mb-1" rows="2"></textarea>

                                                                        <div class="flex gap-2 text-xs mt-1">
                                                                            <button
                                                                                wire:click="updateReply({{ $reply->id }}, {{ $course->id }})"
                                                                                class="text-green-600 hover:underline">حفظ</button>
                                                                            <button
                                                                                wire:click="$set('editingReplies.{{ $reply->id }}', false)"
                                                                                class="text-gray-500 hover:underline">إلغاء</button>
                                                                        </div>
                                                                    @endif --}}


                                                                    {{--  --}}
                                                                    <div class="text-xs text-gray-400 mt-1">
                                                                        {{ $reply->created_at->diffForHumans() }}</div>
                                                                </div>

                                                                @if ($reply->user_id_fk === Auth::id())
                                                                    <div x-data="{ openMenu: false }"
                                                                        class="relative ml-auto text-left">
                                                                        <button @click="openMenu = !openMenu"
                                                                            class="text-gray-500 hover:text-gray-700">⋮</button>
                                                                        <div x-show="openMenu"
                                                                            @click.away="openMenu = false"
                                                                            class="absolute z-10 mt-2 right-0 w-28 bg-white border border-gray-200 rounded-md shadow-lg text-sm">
                                                                            {{-- <button @click="openMenu = false"
                                                                                wire:click="startEditReply({{ $reply->id }}, '{{ $reply->content }}')"
                                                                                class="block w-full text-right px-4 py-2 hover:bg-gray-100">تعديل</button> --}}

                                                                            <button
                                                                                @click="openMenu = false; if (confirm('هل أنت متأكد أنك تريد حذف هذا الرد؟')) { $wire.deleteReply({{ $reply->id }}, {{ $course->id }}) }"
                                                                                class="block w-full text-right px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-800">حذف</button>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                {{--  --}}
                                                                @if ($reply->user_id_fk !== Auth::id())
                                                                    <button @click="openMenu = false"
                                                                        wire:click="openReportModal('reply', {{ $reply->id }})"
                                                                        class="block w-full text-right px-4 py-2 hover:bg-gray-100 text-yellow-600">
                                                                        🚩 إبلاغ
                                                                    </button>
                                                                @endif

                                                                {{--  --}}
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                @endif

                                                <!-- Reply Box -->
                                                <div x-data="{ openReply: false }">
                                                    <div class="text-xs text-blue-600 hover:underline cursor-pointer"
                                                        @click="openReply = !openReply">
                                                        رد
                                                    </div>

                                                    <div x-show="openReply" x-transition
                                                        class="mt-2 flex gap-2 items-start">
                                                        <textarea wire:model.defer="replyInputs.{{ $comment->id }}"
                                                            wire:key="reply-input-{{ $comment->id }}-{{ now()->timestamp }}"
                                                            class="w-full border rounded px-3 py-1 text-sm" placeholder="رد على هذا التعليق..."></textarea>

                                                        <button
                                                            wire:click="addComment({{ $course->id }}, {{ $comment->id }})"
                                                            class="bg-teal-600 text-white px-3 py-1 rounded text-sm hover:bg-teal-700 self-start">
                                                            رد
                                                        </button>
                                                    </div>
                                                </div>

                                                {{--  --}}
                                                {{--  --}}

                                                {{--  --}}
                                                {{--  --}}
                                            </div>
                                        @endforeach



                                        @if (empty($comments[$course->id]))
                                            <p class="text-gray-500 text-sm">لا توجد تعليقات بعد.</p>
                                        @endif
                                    </div>

                                    <!-- New Comment -->
                                    <form wire:submit.prevent="addComment({{ $course->id }})"
                                        class="mt-4 flex gap-2">
                                        <textarea wire:key="new-comment-{{ $course->id }}-{{ now()->timestamp }}"
                                            wire:model.defer="newComments.{{ $course->id }}" class="w-full border rounded px-3 py-1 text-sm"
                                            placeholder="أضف تعليقًا..."></textarea>
                                        <button type="submit"
                                            class="bg-teal-600 text-white px-3 py-1 rounded text-sm hover:bg-teal-700">نشر</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        {{--  --}}
                        <div class="mt-auto flex justify-center gap-3 pt-4 border-t">

                            <!-- Edit -->

                            {{-- <button wire:click.prevent="editCourse({{ $course->id }})"
                                class="text-blue-500 hover:text-blue-700 transition" title="تعديل">
                                <x-heroicon-s-pencil class="w-5 h-5" />
                            </button>


                            <button wire:click.prevent="confirmDelete({{ $course->id }})"
                                class="text-red-600 hover:text-red-800 transition" title="حذف">
                                <x-heroicon-s-trash class="w-5 h-5" />
                            </button> --}}
                            @if (!$blocked)
                                <!-- Edit -->
                                <button wire:click.prevent="editCourse({{ $course->id }})"
                                    class="text-blue-500 hover:text-blue-700 transition" title="تعديل">
                                    <x-heroicon-s-pencil class="w-5 h-5" />
                                </button>

                                <!-- Delete -->
                                <button wire:click.prevent="confirmDelete({{ $course->id }})"
                                    class="text-red-600 hover:text-red-800 transition" title="حذف">
                                    <x-heroicon-s-trash class="w-5 h-5" />
                                </button>
                            @endif


                        </div>

                    </div>


                </div>




                {{--  --}}
                {{--  --}}
                {{--  --}}
            @endforeach
            <!-- Deletion Confirmation Modal -->
            @if ($confirmingDelete)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full text-center">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">هل أنت متأكد؟</h2>
                        <p class="text-gray-600 mb-6">سيتم حذف الدورة نهائيًا، لا يمكن التراجع.</p>
                        <div class="flex justify-center gap-4">
                            <button wire:click="deleteCourse"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">نعم،
                                احذف</button>
                            <button wire:click="$set('confirmingDelete', false)"
                                class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">إلغاء</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{--  --}}
        {{--  --}}
        {{--  --}}
        @if ($showReportModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md text-right space-y-4">
                    <h2 class="text-lg font-bold text-gray-800">إبلاغ عن
                        {{ $reportingType === 'reply' ? 'رد' : 'تعليق' }}</h2>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-600">سبب الإبلاغ</label>
                        <select wire:model="reportReason" class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">اختر السبب</option>
                            <option value="spam">محتوى مزعج</option>
                            <option value="abuse">محتوى مسيء</option>
                            <option value="off-topic">خارج الموضوع</option>
                        </select>
                        @error('reportReason')
                            <span class="text-xs text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-600">تفاصيل إضافية (اختياري)</label>
                        <textarea wire:model.defer="reportDescription" rows="3" class="w-full border rounded px-3 py-2 text-sm"
                            placeholder="اكتب ملاحظاتك هنا..."></textarea>
                    </div>

                    <div class="flex justify-end gap-4">
                        <button wire:click="submitReport"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">إرسال</button>
                        <button wire:click="$set('showReportModal', false)"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">إلغاء</button>
                    </div>
                </div>
            </div>
        @endif


        {{--  --}}
        {{--  --}}
        {{--  --}}
    </div>
    <div class="mt-6 flex justify-center">
        {!! $courses->withQueryString()->links() !!}
    </div>

    {{-- <div class="mt-4 px-2">
    {{ $courses->links('pagination::tailwind') }}
</div> --}}



    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirmCourseDelete', courseId => {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: 'سيتم حذف القسم مع كل الدورات المتعلقة به نهائيًا!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم، احذف',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('confirmDelete', {
                            id: courseId
                        });
                    }
                });
            });
        });
    </script>
    {{-- <div class="mt-4 px-2">
    {{ $institutes->links('pagination::tailwind') }}
</div> --}}


</div> {{-- ✅ ROOT WRAPPER END --}}

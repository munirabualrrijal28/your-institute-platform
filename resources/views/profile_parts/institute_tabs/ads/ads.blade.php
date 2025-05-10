@extends('profile_parts.lib')

@section('lib_layout')
<div>
    @include('profile_parts.institute_tabs.ad.parts.ad_cards', ['ads' => $ads])
</div>


<div x-data="{ showForm: false }" class="bg-white p-6 rounded-xl shadow mb-6">
    <button @click="showForm = !showForm"
            class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl transition-all duration-300">
        + أضف إعلان جديد
    </button>

    <div x-show="showForm" x-transition class="mt-6">
        <form action="{{ route('institute.store_ad') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Content Field -->
            <div class="mb-3">
                <label class="block font-medium mb-1">نص الإعلان</label>
                <textarea name="content" rows="4"
                          class="w-full border-gray-300 rounded-lg px-3 py-2 resize-y"
                          placeholder="اكتب إعلانك هنا">{{ old('content') }}</textarea>
            </div>

            <!-- Media Files -->
            <div class="mb-3">
                <label class="block font-medium mb-1">ملفات الوسائط</label>
                <input type="file" name="ad_files[]" class="w-full border-gray-300 rounded-lg px-3 py-2"
                       accept="image/*,video/*,audio/*" multiple>
            </div>

            <!-- Submit Button -->
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    نشر الإعلان
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

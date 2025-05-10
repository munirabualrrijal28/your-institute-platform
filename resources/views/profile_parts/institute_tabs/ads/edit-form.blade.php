<form method="POST" action="{{ route('institute.update.course', $course->id) }}" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded-xl shadow">
    @csrf
    @method('PUT')

    <h3 class="text-lg font-bold text-gray-800">تعديل الكورس</h3>

    <div>
        <label class="block mb-1 font-semibold">اسم الكورس</label>
        <input type="text" name="course_adv_name" value="{{ old('course_adv_name', $course->course_adv_name) }}" class="w-full rounded border-gray-300">
    </div>

    <div>
        <label class="block mb-1 font-semibold">الوصف</label>
        <textarea name="course_adv_description" rows="3" class="w-full rounded border-gray-300">{{ old('course_adv_description', $course->course_adv_description) }}</textarea>
    </div>

    <div>
        <label class="block mb-1 font-semibold">القسم</label>
        <select name="category_id_fk" class="w-full rounded border-gray-300">
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ $cat->id == $course->category_id_fk ? 'selected' : '' }}>{{ $cat->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 font-semibold">صورة جديدة (اختياري)</label>
        <input type="file" name="media[]" multiple class="w-full">
    </div>

    <div class="flex justify-end gap-3">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">حفظ التعديلات</button>
        <a href="{{ route('institute.profile') }}" class="text-red-600 hover:underline">إلغاء</a>
    </div>
</form>

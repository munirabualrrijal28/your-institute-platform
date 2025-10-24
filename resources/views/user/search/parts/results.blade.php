<div class="bg-white shadow rounded-xl p-4 space-y-3">
    <p class="text-sm text-gray-500">
        {{ $item['type'] === 'course' ? '📘 دورة' : '📢 إعلان' }}
    </p>
    <h4 class="font-bold text-gray-800">
        {{ $item['title'] }}
    </h4>
    <p class="text-sm text-gray-600 line-clamp-3">{{ $item['description'] }}</p>
    <a href="{{ $item['link'] }}" class="text-blue-600 text-sm hover:underline">عرض التفاصيل</a>
</div>

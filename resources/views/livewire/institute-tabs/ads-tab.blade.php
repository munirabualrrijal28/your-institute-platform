<div wire:init="loadAds">
    @if (!$ads)
        <div class="text-center py-6 text-gray-500">
            جاري تحميل الإعلانات...
        </div>
    @else
        @include('profile_parts.institute_tabs.ad.parts.ad_cards', ['ads' => $ads])
    @endif
</div>

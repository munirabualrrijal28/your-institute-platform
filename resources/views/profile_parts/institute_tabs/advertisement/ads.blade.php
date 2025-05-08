@extends('profile_parts.lib')

@section('lib_layout')





{{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Instructor cards here -->
    <div class="bg-white rounded-xl shadow p-5 flex items-center space-x-4">
        <img src="{{ asset('/images/profile/user_ic.svg') }}" class="rounded-full w-16 h-16 object-cover" />
        <div class="text-right">
            <h3 class="text-lg font-bold">محمد سفيان الرياشي</h3>
            <p class="text-gray-600">مختص في دورات الجرافيكس</p>
        </div>
    </div>
    <!-- More cards... -->
    <div class="bg-white rounded-xl shadow p-5 flex items-center space-x-4">
        <img src="{{ asset('/images/profile/user_ic.svg') }}" class="rounded-full w-16 h-16 object-cover" />
        <div class="text-right">
            <h3 class="text-lg font-bold">عبدالله الحاشدي</h3>
            <p class="text-gray-600">مختص في دورات البرمجة</p>
        </div>
    </div>
    <!-- More cards... -->
    <div class="bg-white rounded-xl shadow p-5 flex items-center space-x-4">
        <img src="{{ asset('/images/profile/user_ic.svg') }}" class="rounded-full w-16 h-16 object-cover" />
        <div class="text-right">
            <h3 class="text-lg font-bold">مصطفى  المقطري</h3>
            <p class="text-gray-600">مختص في دورات اللغة الهندية</p>
        </div>
    </div>
    <!-- More cards... -->
    <div class="bg-white rounded-xl shadow p-5 flex items-center space-x-4">
        <img src="{{ asset('/images/profile/user_ic.svg') }}" class="rounded-full w-16 h-16 object-cover" />
        <div class="text-right">
            <h3 class="text-lg font-bold">منير نعمان ابوالرجال</h3>
            <p class="text-gray-600">مختص في دورات اللغة الإنجليزية</p>
        </div>
    </div>
    <!-- More cards... -->
</div> --}}

























<script>
document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (e) {
        if (e.target.closest('.pagination a')) {
            e.preventDefault();
            const url = e.target.closest('a').getAttribute('href');

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                const parser = new DOMParser();
                const html = parser.parseFromString(data, 'text/html');
                const newContent = html.querySelector('#courseAdvCards').innerHTML;

                document.querySelector('#courseAdvCards').innerHTML = newContent;
            });
        }
    });
});
</script>



@endsection

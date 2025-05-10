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


<div class="space-y-6" x-data="instructorsPage">
    <!-- Add Instructor Button + Form -->
    <div class="bg-white p-6 rounded-xl shadow">
      <div x-data="{ showForm: false }">
        <button
          @click="showForm = !showForm"
          class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl transition-all duration-300"
        >
          + أضف مدرب جديد
        </button>

        <div x-show="showForm" x-transition class="mt-6">
          <form method="POST" action="{{ route('institute.instructors_store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-1">
              <label class="block text-gray-700">الاسم الكامل *</label>
              <input type="text" name="name" required class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
            <div class="col-span-1">
              <label class="block text-gray-700">البريد الإلكتروني (اختياري)</label>
              <input type="email" name="email" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>
            <div class="col-span-2">
              <label class="block text-gray-700">نبذة مختصرة</label>
              <textarea name="bio" rows="3" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300"></textarea>
            </div>
            <div class="col-span-2">
              <label class="block text-gray-700">الصورة الشخصية</label>
              <input type="file" name="photo" class="w-full border px-4 py-2 rounded-lg">
            </div>
            <div class="col-span-2 text-left">
              <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition">إضافة</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Grid View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Instructor cards here -->
      <template x-for="instructor in instructors" :key="instructor.id">
        <div class="bg-white rounded-xl shadow p-5 flex items-center space-x-4 transform hover:scale-105 transition-transform duration-300">
          <img :src="instructor.photo || '/images/profile/user_ic.svg'" class="rounded-full w-16 h-16 object-cover" />
          <div class="text-right">
            <h3 class="text-lg font-bold" x-text="instructor.name"></h3>
            <p class="text-gray-600" x-text="instructor.bio"></p>
          </div>
        </div>
      </template>
    </div>

    <!-- Card List with Pagination -->
    {{-- <div class="mt-10">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Instructor Cards with Style -->
        <template x-for="instructor in paginated" :key="instructor.id">
          <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-xl overflow-hidden transform hover:shadow-2xl transition duration-300">
            <img :src="instructor.photo || '/images/profile/user_ic.svg'" class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="font-bold text-lg text-gray-900" x-text="instructor.name"></h3>
              <p class="text-sm text-gray-600" x-text="instructor.bio"></p>
            </div>
          </div>
        </template>
      </div> --}}
      <!-- Pagination Controls -->
      <div class="flex justify-center mt-6 space-x-2">
        <button
          class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded"
          @click="prevPage"
          :disabled="currentPage === 1"
        >السابق</button>
        <button
          class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded"
          @click="nextPage"
          :disabled="currentPage >= totalPages"
        >التالي</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('instructorsPage', () => ({
        instructors: [
          { id: 1, name: 'محمد سفيان الرياشي', bio: 'مختص في دورات الجرافيكس', photo: null },
          { id: 2, name: 'عبدالله الحاشدي', bio: 'مختص في دورات البرمجة', photo: null },
          { id: 3, name: 'مصطفى  المقطري', bio: 'مختص في دورات اللغة الهندية', photo: null },
          { id: 4, name: 'منير نعمان ابوالرجال', bio: 'مختص في دورات اللغة الإنجليزية', photo: null },
          { id: 5, name: 'علي احمد سنان', bio: 'مختص في دورات الهندسة', photo: null },
        ],
        currentPage: 1,
        perPage: 8,
        get paginated() {
          const start = (this.currentPage - 1) * this.perPage;
          return this.instructors.slice(start, start + this.perPage);
        },
        get totalPages() {
          return Math.ceil(this.instructors.length / this.perPage);
        },
        nextPage() {
          if (this.currentPage < this.totalPages) this.currentPage++;
        },
        prevPage() {
          if (this.currentPage > 1) this.currentPage--;
        }
      }))
    })
  </script>

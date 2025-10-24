@extends('admin.layouts.layout')
@section('admin_page_title')
    Dashboard - Admin Panel
@endsection
@section('content')
  <div class="px-6 py-4" x-data="{
    ...adForm(),
    showDelete: false,
    deleteUrl: ''
}">
    <h1 class="text-2xl font-bold mb-6">Manage Advertisements</h1>

    @if (session('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Create/Edit Advertisement Form -->
    <form
        x-bind:action="formMode === 'create' ? '{{ route('admin.store.ads') }}' : updateAction"
        method="POST"
        enctype="multipart/form-data"
        x-on:submit="uploading = true"
        class="bg-white p-6 rounded-xl shadow space-y-4 mb-10"
    >
        @csrf
        <input type="hidden" name="_method" x-show="formMode === 'edit'" :value="formMode === 'edit' ? 'PUT' : ''">

        <div>
            <label class="block font-medium text-sm mb-1">Advertisement Title</label>
            <input type="text" name="title" x-model="formData.title" required class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-medium text-sm mb-1">Advertisement Content</label>
            <textarea name="content" x-model="formData.content" required class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div>
            <label class="block font-medium text-sm mb-1">Upload Images</label>
            <input type="file" name="images[]" multiple class="w-full" @change="handleFiles">
            <div class="flex flex-wrap gap-2 mt-3">
                <template x-for="src in previews" :key="src">
                    <img :src="src" class="w-20 h-20 object-cover rounded border">
                </template>
            </div>
        </div>

        <div>
            <button type="submit" :disabled="uploading" class="bg-blue-600 text-white px-4 py-2 rounded disabled:opacity-50">
                <span x-show="!uploading" x-text="formMode === 'create' ? 'Post Advertisement' : 'Update Advertisement'"></span>
                <span x-show="uploading">Uploading...</span>
            </button>
            <button type="button" x-show="formMode === 'edit'" @click="resetForm" class="ml-2 bg-gray-400 text-white px-4 py-2 rounded">
                Cancel
            </button>
        </div>
    </form>

    <!-- Advertisements Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($advertisements as $ad)
            <div class="bg-white rounded-xl shadow p-4 relative">
                <img src="{{ $ad->media->first() ? asset('storage/' . $ad->media->first()->url) : asset('images/default-ad.jpg') }}"
                    class="w-full h-40 object-cover rounded" alt="Ad Image">

                <div class="mt-4">
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $ad->title }}</h3>
                    <p class="text-sm text-gray-700 mb-2">{{ Str::limit($ad->content, 100) }}</p>
                    <p class="text-xs text-gray-400 mb-2">{{ $ad->created_at->diffForHumans() }}</p>

                    <div class="flex justify-end gap-2 border-t pt-2 mt-2">
                        <button
                            @click="editAd({{ $ad->id }}, '{{ $ad->title }}', `{{ str_replace('`', '\\`', $ad->content) }}`, '{{ route('admin.update.ads', $ad->id) }}')"
                            class="text-blue-600 hover:underline text-sm">
                            Edit
                        </button>

                        <button
                            @click="showDelete = true; deleteUrl = '{{ route('admin.delete.ads', $ad->id) }}'"
                            class="text-red-600 hover:underline text-sm">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $advertisements->links() }}
    </div>

    <!-- Global Delete Confirmation Modal -->
    <div x-show="showDelete"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999]"
        @click.self="showDelete = false"
        style="display: none;">
        <div class="bg-white p-6 rounded-xl shadow-2xl max-w-sm w-full text-center z-[10000]">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Confirm Deletion</h2>
            <p class="text-sm text-gray-600 mb-4">Are you sure you want to delete this advertisement?</p>
            <form :action="deleteUrl" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <div class="flex justify-center gap-3">
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Yes, Delete
                    </button>
                    <button type="button"
                        @click="showDelete = false"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script>
        function adForm() {
            return {
                formMode: 'create',
                updateAction: '',
                uploading: false,
                formData: {
                    title: '',
                    content: ''
                },
                editAd(id, title, content, actionUrl) {
                    this.formData.title = title;
                    this.formData.content = content;
                    this.updateAction = actionUrl; // ✅ FIX: exact string
                    this.formMode = 'edit';
                },
                resetForm() {
                    this.formData.title = '';
                    this.formData.content = '';
                    this.updateAction = '';
                    this.formMode = 'create';
                }
            }
        }
    </script>
@endsection

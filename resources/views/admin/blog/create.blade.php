{{-- resources/views/admin/blog/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create Blog Post')

@section('content')
    <section class="py-16 sm:py-24 bg-white min-h-screen">
        <div class="container max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-12 text-[#083873]">Create New Blog Post</h1>

            <form id="blog-form" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
                @csrf
                <div class="bg-gray-50 rounded-2xl shadow-xl p-10 space-y-8">
                    <div>
                        <label class="block text-lg font-medium mb-3">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-6 py-4 rounded-lg border focus:border-[#083873]">
                        @error('title')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Excerpt (Short Summary)</label>
                        <textarea name="excerpt" rows="4" required
                            class="w-full px-6 py-4 rounded-lg border focus:border-[#083873]">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Body (Full Content)</label>
                        <textarea name="body" id="tinymce-editor" required>{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Featured Image</label>
                        <input type="file" name="featured_image" accept="image/*" class="w-full">
                        @error('featured_image')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }}
                            class="w-6 h-6 text-[#083873]">
                        <label for="published" class="text-lg">Publish immediately</label>
                    </div>

                    <div class="flex gap-6">
                        <button type="submit"
                            class="bg-[#83040b] text-white px-10 py-4 rounded-lg font-bold hover:bg-[#083873] transition">
                            Create Post
                        </button>
                        <a href="{{ route('admin.blog.index') }}"
                            class="px-10 py-4 border-2 border-gray-400 rounded-lg font-bold hover:bg-gray-100 transition">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/pnu1w2pxnhk0g7uw1605gvl9zb9hoxabeqaiuce589cmdve7/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#tinymce-editor',
            height: 600,
            plugins: 'autosave anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | fullscreen preview | restoredraft',
            branding: false,
            toolbar_sticky: true,
            icons: 'thin',
            autosave_restore_when_empty: true,
            content_style: `
                body {
                    background: #fff;
                }

                @media (min-width: 840px) {
                    html {
                        background: #eceef4;
                        min-height: 100%;
                        padding: 0 .5rem
                    }

                    body {
                        background-color: #fff;
                        box-shadow: 0 0 4px rgba(0, 0, 0, .15);
                        box-sizing: border-box;
                        margin: 1rem auto 0;
                        max-width: 820px;
                        min-height: calc(100vh - 1rem);
                        padding:4rem 6rem 6rem 6rem
                    }
                }
            `,
            setup: function (editor) {
                editor.on('change keyup', function () {
                    editor.save();
                });
            }
        });

        document.getElementById('blog-form').addEventListener('submit', function () {
            tinymce.triggerSave();
        });
    </script>
@endpush
{{-- Admin Page Header Component --}}
<div class="bg-white border-b border-gray-200 px-6 lg:px-8 py-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900">{{ $title ?? 'Page Title' }}</h1>
        @if(isset($description))
            <p class="mt-2 text-gray-600">{{ $description }}</p>
        @endif
    </div>
</div>

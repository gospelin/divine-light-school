{{-- Admin Card Component for Content Sections --}}
<div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition duration-200">
    @if(isset($title))
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-900">{{ $title }}</h2>
            @if(isset($subtitle))
                <p class="text-sm text-gray-600 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    
    <div class="px-6 py-4">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $footer }}
        </div>
    @endif
</div>

{{-- Admin Stats Card Component --}}
<div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 hover:shadow-md transition duration-200">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-600">{{ $label ?? 'Stat Label' }}</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $value ?? '0' }}</p>
            @if(isset($change))
                <p class="text-sm mt-2 {{ str_contains($change, '+') ? 'text-green-600' : 'text-red-600' }}">
                    {{ $change }}
                </p>
            @endif
        </div>
        @if(isset($icon))
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                {!! $icon !!}
            </div>
        @endif
    </div>
</div>

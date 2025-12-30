{{-- Modern Button Component --}}
@props([
    'variant' => 'primary', // primary, secondary, danger, success
    'size' => 'md', // sm, md, lg
    'disabled' => false,
    'href' => null,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition duration-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2';

$variantClasses = match($variant) {
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 disabled:bg-gray-400',
    'secondary' => 'bg-gray-200 text-gray-900 hover:bg-gray-300 focus:ring-gray-500 disabled:bg-gray-300',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 disabled:bg-gray-400',
    'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 disabled:bg-gray-400',
};

$sizeClasses = match($size) {
    'sm' => 'px-3 py-2 text-sm gap-2',
    'md' => 'px-4 py-2.5 text-base gap-2',
    'lg' => 'px-6 py-3 text-lg gap-3',
};

$classes = "$baseClasses $variantClasses $sizeClasses";
$classes .= $disabled ? ' opacity-50 cursor-not-allowed' : '';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'disabled' => $disabled]) }}>
        {{ $slot }}
    </button>
@endif

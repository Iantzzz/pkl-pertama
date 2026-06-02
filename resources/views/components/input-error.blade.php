@props(['messages'])
@php
    $messages = (array) (is_string($messages) ? [$messages] : $messages);
@endphp

@foreach ($messages as $message)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-500 dark:text-red-400 mt-1.5']) }}>{{ $message }}</p>
@endforeach

@php
    $current_url = Request::url();
    $newArr = explode('/', $current_url);
    $current = $newArr[3];
@endphp
<img src="{{ asset('image/logo-himatikom.png') }}"
    class="{{ in_array($current, ['login', 'register', 'forgot-password']) ? 'w-[12rem]' : 'w-[3rem]' }}"
    alt="Logo HIMATIKOM">

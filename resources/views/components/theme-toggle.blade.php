@props(['class' => ''])

<button
    x-data="{ dark: document.documentElement.classList.contains('dark') }"
    @click="dark = !dark;
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', dark ? 'dark' : 'light')"
    {{ $attributes->merge(['class' => "text-black dark:text-white rounded {$class}"]) }}
>
    <span x-show="!dark">🌞</span>
    <span x-show="dark">🌙</span>
</button>

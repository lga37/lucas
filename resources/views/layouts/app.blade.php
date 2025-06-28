<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="{ 'dark': localStorage.theme === 'dark' }">

    {{-- <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head> --}}


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'garimpIA') }} – Imóveis de Leilão com Inteligência Artificial</title>
        <meta name="description" content="GarimpIA é uma plataforma inteligente para descobrir imóveis em leilão, com filtros avançados, análise de dados e visualização fácil.">
        <meta name="keywords" content="leilão de imóveis, imóveis baratos, inteligência artificial, garimpia, big data, análise de leilão, judicial, extrajudicial">
        <meta name="author" content="LGA">
    
       

        <!-- Favicon padrão -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">

        <!-- Apple -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

        <!-- Android / PWA -->
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('android-chrome-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('android-chrome-512x512.png') }}">

        <!-- Theme color para mobile -->
        <meta name="theme-color" content="#111827">



    
        <!-- Open Graph -->
        <meta property="og:title" content="GarimpIA – Imóveis de Leilão com IA">
        <meta property="og:description" content="Descubra oportunidades únicas de imóveis em leilão com ajuda da inteligência artificial.">
        <meta property="og:image" content="{{ asset('og-image.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
    
        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="GarimpIA – Inteligência Artificial nos Leilões">
        <meta name="twitter:description" content="Explore imóveis com IA. Encontre oportunidades em leilão com dados confiáveis e interface amigável.">
        <meta name="twitter:image" content="{{ asset('og-image.png') }}">
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
        <!-- Vite Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    
        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    


    <body class="font-sans antialiased bg-white text-gray-900 dark:bg-gray-900 dark:text-white">
        <x-banner />

        <div class="min-h-screen  bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="">
                {{ $slot }}
            </main>
        </div>



        <x-footer />

        @stack('modals')

        @livewireScripts
    </body>
</html>

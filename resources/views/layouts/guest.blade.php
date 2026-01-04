<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InventoryPro') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 dark:bg-black relative overflow-hidden">

        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-gray-50 dark:from-gray-900 dark:via-black dark:to-gray-900 opacity-80">
            </div>
            <svg class="absolute left-[max(50%,25rem)] top-0 h-[64rem] w-[128rem] -translate-x-1/2 stroke-gray-200 [mask-image:radial-gradient(64rem_64rem_at_top,white,transparent)] dark:stroke-gray-700"
                aria-hidden="true">
                <defs>
                    <pattern id="grid-pattern" width="200" height="200" x="50%" y="-1"
                        patternUnits="userSpaceOnUse">
                        <path d="M100 200V.5M.5 .5H200" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern)" />
            </svg>
        </div>

        <div class="mb-6">
            <a href="/" wire:navigate class="flex items-center gap-2">
                <div class="p-2 bg-indigo-600 rounded-lg shadow-lg">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">IMS<span
                        class="text-indigo-600">Lite</span></span>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white dark:bg-zinc-900 shadow-xl overflow-hidden sm:rounded-xl border border-gray-100 dark:border-zinc-800 relative z-10">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} Inventory Management System
        </div>
    </div>
</body>

</html>

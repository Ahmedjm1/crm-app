```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- 🔥 Custom Button Styles -->
        <style>
            .btn {
                padding: 10px 18px;
                border-radius: 10px;
                border: none;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.2s ease;
                display: inline-block;
                text-decoration: none;
            }

            /* Gradient Primary Button */
            .btn-primary {
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                color: white;
                box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                opacity: 0.95;
            }

            /* Secondary Button */
            .btn-secondary {
                background-color: #e5e7eb;
                color: #111827;
            }

            .btn-secondary:hover {
                background-color: #d1d5db;
            }

            /* Danger Button */
            .btn-danger {
                background-color: #ef4444;
                color: white;
            }

            .btn-danger:hover {
                background-color: #dc2626;
            }

            /* Button Group */
            .btn-group {
                display: flex;
                gap: 10px;
                margin-top: 15px;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
```

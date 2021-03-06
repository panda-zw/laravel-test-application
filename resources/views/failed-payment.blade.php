<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Test Application</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .modal a.close-modal[class*="icon-"] {
            top: -10px;
            right: -10px;
            width: 20px;
            height: 20px;
            color: #fff;
            line-height: 1.25;
            text-align: center;
            text-decoration: none;
            text-indent: 0;
            background: red;
            border: 2px solid #fff;
            -webkit-border-radius: 26px;
            -moz-border-radius: 26px;
            -o-border-radius: 26px;
            -ms-border-radius: 26px;
            -moz-box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            -webkit-box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }

        .modal {
            max-width: 60vw;
        }

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .modal {
                max-width: 85vw !important;
            }
        }

    </style>

    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="antialiased">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <img class="block lg:hidden h-8 w-auto bg-white" src="{{ asset('images/logo.png') }}"
                                alt="Workflow">
                            <img class="hidden lg:block h-8 w-auto" src="{{ asset('images/logo.png') }}"
                                alt="Workflow">
                        </a>
                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <a href="{{ route('home') }}" :class="request()->routeIs('home') ? 'bg-gray-900' : ''"
                                class="hover:bg-gray-700 text-white px-3 py-2 rounded-md text-sm font-medium"
                                aria-current="page">All Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                @foreach (App\Models\ProductCategory::all() as $category)
                    <a href="#" :class="request()->segment(2) == {{ $category->slug }} ? 'bg-gray-900' : ''"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        aria-current="page">Category 1</a>
                @endforeach
            </div>
        </div>
    </nav>

    <div class="bg-gradient-to-r from-red-200 to-gray-200">
        <div class="w-9/12 m-auto py-16 min-h-screen flex items-center justify-center">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg pb-8">
                <div class="border-t border-gray-200 text-center pt-8 mx-auto">
                    <img src="{{ asset('images/failed.svg') }}" class="h-20 w-20 mx-auto mb-5 justify-center items-center">

                    <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Payment Failed</h2>
                    <p class="text-2xl pb-8 px-12 font-medium">Failed to complete payment, please email orders@email.com</p>
                    <a href="{{ route('home') }}"
                        class="bg-red-600 border border-transparent rounded-md py-3 px-8 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Go to Home
                    </a>
                </div>
            </div>
        </div>
    </div>


    @livewire('checkout')
    @livewireScripts
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

</body>

</html>

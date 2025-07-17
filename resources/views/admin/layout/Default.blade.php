<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - @yield('title', 'الأدمن')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">


        @livewire('admin.partials.side-bar')

        <div class="flex-1 flex flex-col min-w-0">

            <header class="bg-white/80 backdrop-blur-xl shadow-sm border-b border-gray-200/50 sticky top-0 z-30">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <button @click="sidebarOpen = true"
                                class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h1 class="text-xl font-bold text-gray-900">@yield('title', 'لوحة التحكم')</h1>
                                <p class="text-sm text-gray-500">مرحباً بك في نظام إدارة التوزيع</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 space-x-reverse">

                            <div class="hidden md:block relative">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" placeholder="البحث..."
                                    class="w-64 pl-3 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/50 backdrop-blur-sm">
                            </div>


                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                    <span
                                        class="absolute top-0 left-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                                </button>
                            </div>


                            <div class="flex items-center space-x-2 space-x-reverse">
                                @yield('actions')
                            </div>
                        </div>
                    </div>
                </div>
            </header>


            <main class="flex-1 overflow-auto">
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>


</body>

</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - Super Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-100 font-sans min-h-screen">

    <div class="flex h-screen">

        @livewire('super-admin.partials.side-bar')


        <div class="flex-1 flex flex-col">

            @include('super-admin.partials.header')

            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')



            </main>
        </div>
    </div>

</body>

</html>

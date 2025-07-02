<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">


<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🔐 تسجيل دخول Admin</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">كلمة المرور</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    تسجيل الدخول
                </button>
            </div>
        </form>
    </div>

</body>

</html>

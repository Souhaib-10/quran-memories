<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>تسجيل الدخول</title>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">مرحباً بكم في دورة الفقيه سي بوشتى</h1>
        <h2 class="text-center text-gray-600 mb-6">ادخال معلومات الحساب</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="ادخل بريدك الإلكتروني"
                    value="{{ old('email') }}"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">الرمز السري</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="ادخل الرمز السري"
                    required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="inline-flex items-center">
                  <input type="checkbox"
                    class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-blue-300 checked:bg-blue-800 checked:border-blue-800"
                    name="remember"
                    id="remember"
                    {{old('remember'?'checked':'')}} />
                <label class="cursor-pointer ml-2 px-2 text-slate-600 text-sm font-medium" for="remember">
                  تذكرني
                </label>
              </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                تسجيل الدخول
            </button>
        </form>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>log in</title>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
            <div class="w-full max-w-sm bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-center text-gray-800">Login to Quran Site</h2>
                <p class="text-center text-gray-600 mb-6">Enter your credentials to access the site</p>

                @if (session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full p-2 border border-gray-300 rounded mt-1 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Email Address"
                            value="{{ old('email') }}"
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full p-2 border border-gray-300 rounded mt-1 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Password"
                            required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Login
                    </button>
                </form>

    </div>
</body>
</html>

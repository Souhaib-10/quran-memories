<!-- resources/views/admin/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Edit Admin</title>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-6 w-85">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Admin: {{ $admin->name }}</h1>
        <div class="flex justify-around py-6">
            <button onclick="window.history.back();" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-10 rounded focus:outline-none focus:shadow-outline" type="button">
                Previous
            </button>
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout.quran') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white p-2 rounded">Logout</button>
            </form>


        </div>

        <form action="{{ route('admins.update', $admin->id) }}" method="POST" class="w-full max-w-3xl mx-auto bg-white shadow-md rounded px-4 pt-2 pb-2 mb-4" >
            @csrf
            @method('PUT')

            <div class="space-y-4 ">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" class="w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role Field -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" id="role" class="w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        @if(auth()->user()->role == 'superAdmin')
                            <option value="superAdmin" {{ old('role', $admin->role) == 'superAdmin' ? 'selected' : '' }}>Super Admin</option>
                        @endif
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Update Admin</button>
            </div>
        </form>
    </div>
</body>
</html>

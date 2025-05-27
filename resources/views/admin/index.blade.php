<!-- resources/views/admin/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Manage Admins</h1>

        <div class="flex justify-around">
            <!-- Add Admin Button -->
            <a href="{{ route('admins.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Create New Admin
            </a>

            <!-- Logout Button -->
            <form action="{{ route('logout.quran') }}" method="POST" class="inline-block px-4">
                  @csrf
                  <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>
        <div class="mt-6 overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Role</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm">{{ $admin->name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $admin->email }}</td>
                        <td class="px-4 py-2 text-sm">{{ ucfirst($admin->role) }}</td>
                        <td class="px-4 py-2 text-sm">
                            <!-- Edit and Delete Buttons -->
                            <a href="{{ route('admins.edit', $admin->id) }}" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>

                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="inline-block" method="POST" onsubmit="return confirm('are you sure you want delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline mx-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

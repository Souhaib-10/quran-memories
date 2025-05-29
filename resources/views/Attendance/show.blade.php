<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>عرض الحضور {{ $student->name }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto">
        <div class="flex pt-5 px-5 justify-between">
            <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                <a href="{{ route('attendance.index') }}">
                الرجوع للقائمة الحضور
                </a>
            </button>
        </div>

        <div class="text-gray-900 bg-white-200 min-h-screen p-6">
            <h1 class="text-3xl font-bold text-center mb-6">عرض الحضور {{ $student->name }}</h1>
            <table class="w-full text-md bg-white shadow-md rounded mb-4 text-center">
                <thead>
                    <tr class="border-b bg-gray-200">
                        <th class="p-3 px-5">الحالة</th>
                        <th class="p-3 px-5">تاريخ الحصة</th>
                        <th class="p-3 px-5">التغيير</th>
                        <th class="p-3 px-5">الحذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->attendances as $attendance)
                        <tr class="border-b hover:bg-orange-100 bg-gray-100">
                            <td class="p-3 px-5">{{ $attendance->status }}</td>
                            <td class="p-3 px-5">{{ $attendance->created_at->format('Y-m-d') }}</td>
                            <td class="p-3 px-5">
                                <button type="submit" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                    <a href="{{ route('attendance.edit', $attendance->id) }}">تعديل</a>
                                </button>
                            </td>
                            <td class="p-3 px-5">
                                <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        حذف
                                    </button>
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

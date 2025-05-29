<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>تعديل الحضور الطالب</title>
</head>
<body>
    <div class="container mx-auto">
        <div class="flex pt-5 px-5 justify-between">
            <a  class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" href="{{ route('attendance.index') }}">
                الرجوع للقائمة الحضور الطالب
            </a>
        </div>
    <form  action="{{ route('attendance.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table class="w-full text-md bg-white shadow-md rounded mb-4 text-center">
            <thead class="border-b bg-gray-200">
                <tr class="border-b bg-gray-200">
                    <th class="p-3 px-5">الاسم</th>
                    <th class="p-3 px-5">حاضر</th>
                    <th class="p-3 px-5">غائب</th>
                </tr>
            </thead>
            <tbody>
                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                        <td>{{ $attendance->student->name }}</td>
                        <td><input type="radio" name="status" value="حاضر" {{ $attendance->status == 'حاضر' ? 'checked' : '' }}></td>
                        <td><input type="radio" name="status" value="غائب" {{ $attendance->status == 'غائب' ? 'checked' : '' }}></td>
                    </tr>
            </tbody>
        </table>
        <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">تعديل الحضور</button>
    </form>
    </div>
</body>
</html>

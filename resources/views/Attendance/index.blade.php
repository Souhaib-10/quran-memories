<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>الحضور</title>
</head>
<body>
    <div class="container mx-auto">
        <div class="text-gray-900 bg-white-200 min-h-screen p-6" dir="rtl">
            <div class=" flex pt-5 px-5 justify-between">
                <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <a href="{{route('attendance.create')}}">
                        اضافة حضور جديد
                    </a>
                </button>
                <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    <a href="{{route('students.index')}}">
                الرجوع للقائمة الرئيسيه
                    </a>
                </button>
            </div>
    <h1 class="text-3xl font-bold text-center">
        الحضور
    </h1>
    <div class="max-w-full h-full mx-auto mt-10  rounded shadow-lg pt-4 text-right">
        @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
                    <strong class="font-bold">نجاح!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                <script>
                    // call function from js file: display msg only for 3 second
                    hideAlertAfterDelay('[role="alert"]');
                </script>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
                    <strong class="font-bold">خطأ!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            <script>
                // call function from js file: display msg only for 3 second
                hideAlertAfterDelay('[role="alert"]');
            </script>
            @endif
    <div>
    <div class="overflow-x-auto">
            <table class="w-full text-md bg-white shadow-md rounded mb-4 text-center" >
                <thead>
                <tr class="border-b bg-gray-200">
                <th class="p-3 px-5">الاسم الطالب</th>
                <th class="p-3 px-5">حاضر</th>
                <th class="p-3 px-5">غائب</th>
                <th class="p-3 px-5">التفاصيل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr class ="border-b hover:bg-orange-100 bg-gray-100">
                    <td class="p-3 px-5">{{ $student->name }}</td>
                    <td class="p-3 px-5">{{ $student->present_count }}</td>
                    <td class="p-3 px-5">{{ $student->absent_count }}</td>
                    <td class="p-3 px-5">
                        <button type="submit" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                        <a href="{{ route('attendance.show', $student->id) }}">التفاصيل</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>

</div>
</div>
</body>
</html>

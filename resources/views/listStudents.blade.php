<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>لائحة الطلاب</title>
    <script src="{{asset('js/alert.js')}}" defer></script>
</head>
<body>
    <div class="text-gray-900 bg-white-200 min-h-screen p-6" dir="rtl">
        <div class=" flex pt-5 px-5 justify-between">
            <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                <a href="{{route('students.create')}}">
                    اضافة الطالب الجديد
                </a>
            </button>
            <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                <a href="{{route('memorizes.create')}}">
                    اضافة المحفوظ
                </a>
            </button>
             <!-- Logout Button -->
             <!--<form method="POST" action="{{ route('logout.quran') }}">
                @csrf
                <button type="submit" class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">الخروج</button>
            </form> -->
        </div>

        <h1 class="text-3xl font-bold text-center">
            لائحة الطلبة
        </h1>
        <!-- Filter Form -->
    <div class="flex pt-5 px-5 justify-around mb-4 w-full">
        <form method="GET" action="{{ route('students.index') }}" class="d-flex  w-full max-w-lg">
            <div class="flex items-center space-x-2 space-x-reverse">
                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="البحث عن الطالب"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200"
                >
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    بحث
                </button>
            </div>
           <!--
                    <filter by dat>
            <div class="flex items-center justify-between space-x-4">
                <label for="start_date" class="text-sm font-medium">من تاريخ</label>
                <input type="date" id="start_date" name="start_date" class="py-2 px-3 border border-gray-300 rounded" value="{{ request('start_date') }}">

                <label for="end_date" class="text-sm font-medium">إلى تاريخ</label>
                <input type="date" id="end_date" name="end_date" class="py-2 px-3 border border-gray-300 rounded" value="{{ request('end_date') }}">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">البحث</button>
            </div>
            -->
        </form>
    </div>
        <div class="max-w-full mx-auto  rounded shadow-lg pt-4">
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
        </div>
        <div class="overflow-x-auto"">
            <table class="w-full text-md bg-white shadow-md rounded mb-4 text-center" >
                <thead>
                    <tr class="border-b bg-gray-200">
                        <th class="p-3 px-5">الرقم الترتيبي</th>
                        <th class="p-3 px-5">الاسم الكامل</th>
                        <th class="p-3 px-5">عدد الختمات</th>
                        <th class="p-3 px-5">البداية </th>
                        <th class="p-3 px-5">مجموع الأحزاب الجديدة</th>
                        <th class="p-3 px-5">مجموع الأثمان الجديدة</th>
                        <th class="p-3 px-5">مجموع المراجعة</th>
                        <th class="p-3 px-5">مستوى الطالب  </th>
                        <th class="p-3 px-5">تغيير معلومات الطالب</th>
                        <th class="p-3 px-5">حذف الطالب</th>
                        <th class="p-3 px-5">معلومات اضافية</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($students && $students->count() > 0)
                        @foreach ($students as $student)
                            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                <td class="p-3 px-5">{{ $loop->iteration }}</td>
                                <td class="p-3 px-5">{{ $student->name }}</td>
                                <td class="p-3 px-5">{{ $student->completions }}</td>
                                {{-- it should be label starting hizb but i already do logic with name of surah --}}
                                <td class="p-3 px-5 truncate">{{$student->starting_surah}}</td>
                                <td class="p-3 px-5">{{ $student->adjustedHizb }}</td>
                                <td class="p-3 px-5">{{ $student->adjustedFraction }}</td>
                                <td class="p-3 px-5">{{ $student->adjustedReview}}</td>
                                <td class="p-3 px-5">{{ $student->level }}</td>
                                <td class="p-3 px-5">
                                    <button type="submit" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        <a href="{{route("students.edit",$student->id)}}">
                                          التغيير
                                       </a>
                                   </button>
                                </td>
                                <td class="p-3 px-5">
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('هل انت متأكد من حذف هذا الطالب؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">حذف</button>
                                    </form>
                                </td>
                                <td class="p-3 px-5">
                                    <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                         <a href="{{route("students.show",$student->id)}}">
                                            التفاصيل
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="p-3 px-5 text-center text-gray-500">لا توجد بيانات</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    {{-- <div class="container mx-auto py-8">
    <button class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"><a href="{{route('students.create')}}">New Student</a>
    </button>
    <h1 class="tracking-normal text-center underline decoration-1 capitalize text-5xl ">students</h1>

    @if ($students)
    <ul>
        @foreach ($students as $student)
        <li>{{$student->id}}</li>
        <li>{{$student->name}}</li>
        <li>{{$student->completions}}</li>
        <ul>
        @foreach ($student->memorizes as $memorize)
        <li> {{$memorize->hizb}} :احزاب الجديدة</li>
        <li> {{$memorize->fraction}} :اثمان الجديدة</li>
        <li> {{$memorize->review}} :المراجعة </li>
        <li>{{$memorize->created_at->format('Y-m-d')}} :التاريخ</li>
        @endforeach
        </ul>
    </ul>
    @endforeach
    @else
        <h2>Empty data</h2>
    @endif
</div> --}}

</body>
</html>

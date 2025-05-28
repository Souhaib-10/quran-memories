<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    {{-- <script src="{{asset('js/alert.js')}}" defer></script> --}}
    <title>تفاصيل الطالب</title>
</head>
<body>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded" dir="rtl">
            <h2 class="text-2xl font-bold mb-4 text-center"> تفاصيل الحفظ - {{ $student->name }} </h2>
            <button  class=" mb-3 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <a href="{{route('students.index')}}">الرجوع</a>
            </button>
            <div class="max-w-85  mx-auto  rounded shadow-lg pt-4">
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
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center"  role="alert">
                        <strong class="font-bold">خطأ!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                <script>
                    // call function from js file: display msg only for 3 second
                    hideAlertAfterDelay('[role="alert"]');
                </script>
                @endif
            </div>
            <div class="overflow-x-auto">

                <table class="w-full text-md bg-white shadow-md rounded mb-4 text-center">
                    <thead>
                        <tr class="border-b bg-gray-300">
                            <th class="p-3 px-5">الحزب</th>
                            <th class="p-3 px-5">الجزء من الحزب</th>
                            <th class="p-3 px-5">المراجعة</th>
                            <th class="p-3 px-5">التاريخ</th>
                            <th class="p-3 px-5">تغيير محفوظ</th>
                            <th class="p-3 px-5">حذف محفوظ</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($student->memorizes as $memorize)
                            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                <td class="p-3 px-5">{{ $memorize->hizb }}</td>
                                <td class="p-3 px-5">{{ $memorize->fraction }}</td>
                                <td class="p-3 px-5">{{ $memorize->review }}</td>
                                <td class="p-3 px-5">{{ $memorize->created_at->format('Y-m-d') }}</td>
                                <td class="p-3 px-5">
                                    <button type="submit" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        <a href="{{route("memorizes.edit",$memorize->id)}}">تغيير</a>
                                    </button>
                                </td>
                                <td class="p-3 px-5">
                                    <form action="{{route('memorizes.destroy', $memorize->id)}}" method="POST" onsubmit="return confirm('هل انت متأكد من حذف هذا السجل؟')">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                            حذف السجل
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 px-5 text-gray-500">لا توجد بيانات حفظ</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>

</body>
</html>

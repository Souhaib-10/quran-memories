<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>تصحيح المحفوظ</title>
</head>
<body>
    <div class="w-full max-w-4xl mx-auto mt-10 bg-blue" dir="rtl">
        <h1 class="text-center text-4xl">تغيير محفوظ الطالب</h1>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{route("memorizes.update",$memorize->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2 " for="student_id">اسم الطالب</label>
                <select name="student_id" id="student_id" class="block py-2.5 px-0 w-9/12 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" >
                    <option selected value="{{old("student_id", "$memorize->student_id")}}"> {{$memorize->student->name}}  </option>
                    @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6">
                <label for="hizb" >أحزاب</label>
                <select name="hizb" id="hizb" class="block py-2.5 px-0 w-9/12 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="{{old("hizb","$memorize->hizb")}}" selected> {{$memorize->hizb}}الحزب </option>
                    @for ($i = 0; $i < 61; $i++)
                        <option value="{{$i}}">{{$i}}الحزب </option>
                    @endfor
                </select>
            </div>
            <div class="mb-6">
                <label for="fraction">أثمان</label>
                <select name="fraction" id="fraction" class="block py-2.5 px-0 w-9/12 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="{{old("fraction","$memorize->fraction")}}">الثمن{{$memorize->fraction}}  </option>
                    {{-- @for ($i = 0; $i < 8; $i++) --}}
                        <option value="{{$i}}">{{$i}}الثمن</option>
                    @endfor
                {{-- </select> --}}
            </div>
            <div class="mb-6">
                <label for="review">مراجعة</label>
                <select name="review" id="review" class="block py-2.5 px-0 w-9/12 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="{{old("review","$memorize->review")}}" selected>  {{$memorize->review}}    </option>
                    @for($i = 0; $i <= 60; $i = round($i + 0.1, 1))

                        @php
                            if (round($i - floor($i), 1) >= 0.8) {
                            $i = ceil($i); // Force the next iteration to start at the next integer
                            }
                            $displayValue = number_format($i, 1);

                        @endphp
                        <option value="{{$i}}">{{fmod($i,1) == 0 ? (int)$i : $displayValue}}</option>
                    @endfor
                </select>
            </div>
            <div class="flex items-center justify-around">
                <button class="text-xl bg-blue-500 hover:bg-blue-700 text-white py-1  rounded focus:outline-none focus:shadow-outline px-10" type="submit">حفظ</button>
                <button onclick="window.history.back();"  class="text-xl bg-green-500 hover:bg-green-700 text-white py-1 px-10 rounded focus:outline-none focus:shadow-outline" type="button">
                    الغاء
                </button>
            </div>
        </form>
    </div>
</body>
</html>

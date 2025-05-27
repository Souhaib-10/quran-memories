<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>تصحيح معلومات الطالب</title>
</head>
<body>
    <div class="w-full max-w-3xl mx-auto mt-10 bg-blue text-right">
        <h1 class="text-center text-4xl">تغيير معلومات طالب</h1>
        @if (session('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">رسالة</strong>
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{route("students.update",$student->id)}}"  method="POST">
            @csrf
            @method("PUT")
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 " for="name">
              الاسم الكامل
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="ادخال اسم الطالب كامل" value="{{old("name", "$student->name")}}">
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
              التاريخ
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" name="date" placeholder="تاريخ التسجيل" value="{{old("date", "$student->date")}}">
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2 " for="completions">
                عدد ختمات
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="completions" name="completions" type="number" min="0" value="{{old("completions", "$student->completions")}}">
          </div>
          <div class="mb-6">
            <select class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="starting_surah" name="starting_surah" required>
                <option value="{{old('starting_surah',$student->starting_surah)}}" selected>{{old('starting_surah',$student->starting_surah)}}</option>
                @foreach ($hizbs as $hizb)

                <option value="{{$hizb['head']}}">{{$hizb['head']}}</option>
                @endforeach
            </select>
          </div>
          <div class="flex items-center justify-around">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              حفظ
            </button>
            <button onclick="window.history.back();" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                إلغاء
              </button>
          </div>
        </form>
        <p class="text-center text-gray-500 text-xs">
          &copy;souhaib. All rights reserved.
        </p>
      </div>
    {{-- <form action="{{route("students.store")}}" method="POST">
        @csrf
        <label for="name">nom</label>
        <input type="text" name="name" id="name" required placeholder="saisie le nom d'étudiant">
        <label for="date">date d'inscription</label>
        <input type="date" name="date" id="date">
        <label for="completions">number khatmat</label>
        <input type="number" name="completions" id="completions" required>
        <button type="submit">submit</button>
    </form> --}}
</body>
</html>

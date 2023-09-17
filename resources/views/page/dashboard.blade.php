@extends('layout.success')

@extends('layout.error')

@extends('layout.app')

@section('title')DASHBOARD |@endsection

@section('isikonten')

<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">

    <div class="w-full h-full flex justify-center items-center">
        <h1 id="typewriter" class="text-4xl font-bold text-white"></h1>
    </div>

</div>

<script>
    var words = ["Halo, Selamat Datang "+`{{ $userName }}`+" :)"];
    let i = 0;
    let j = 0;
    let currentWord = "";
    let isDeleting = false;
    
    function type() {
      currentWord = words[i];
      if (isDeleting) {
        document.getElementById("typewriter").textContent = currentWord.substring(0, j-1);
        j--;
        if (j == 0) {
          isDeleting = false;
          i++;
          if (i == words.length) {
            i = 0;
          }
        }
      } else {
        document.getElementById("typewriter").textContent = currentWord.substring(0, j+1);
        j++;
        if (j == currentWord.length) {
          isDeleting = true;
        }
      }
      setTimeout(type, 70);
    }
    
    type();
</script>


@endsection

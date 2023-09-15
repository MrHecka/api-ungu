@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="overflow-y-auto relative flex md:h-screen sm:w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">

  <div class="overflow-y-auto max-[1024px]:h-120 max-[1024px]:py-5  rounded-xl bg-gray-800 bg-opacity-50 px-16 py-5 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">
        <svg width="96px" height="96px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#de17b3"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 14V18" stroke="#82279b" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126" stroke="#82279b" stroke-width="1.5" stroke-linecap="round"></path> <path d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15" stroke="#82279b" stroke-width="1.5" stroke-linecap="round"></path></g></svg>  
      <br>
        <h1 class="mb-2 text-2xl font-bold">Login</h1>
        <span class="text-gray-300">Masukkan Email & Password Terlebih Dahulu!</span>
      </div>

      <form action="{{ route('postlogin') }}" method="POST">
        @csrf
    
        <div class="mb-4 text-lg">
          <label for="email" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path fill-rule="evenodd" d="M5.404 14.596A6.5 6.5 0 1116.5 10a1.25 1.25 0 01-2.5 0 4 4 0 10-.571 2.06A2.75 2.75 0 0018 10a8 8 0 10-2.343 5.657.75.75 0 00-1.06-1.06 6.5 6.5 0 01-9.193 0zM10 7.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" clip-rule="evenodd" />
          </svg>Email</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-16 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="email" value="{{ Session::get('email') }}" name="email" placeholder="emailku@gmail.com" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>

        <div class="mb-4 text-lg">
          <label for="password" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path fill-rule="evenodd" d="M8 7a5 5 0 113.61 4.804l-1.903 1.903A1 1 0 019 14H8v1a1 1 0 01-1 1H6v1a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 01.293-.707L8.196 8.39A5.002 5.002 0 018 7zm5-3a.75.75 0 000 1.5A1.5 1.5 0 0114.5 7 .75.75 0 0016 7a3 3 0 00-3-3z" clip-rule="evenodd" />
          </svg>
          Password</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-16 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="password" name="password" placeholder="*********" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
          <div class="mb-4 text-base pl-2 pt-2 align-bottom items-center justify-center">
            <span><a href="{{ route('lupaPass') }}" class="text-blue-500 hover:underline font-bold hover:font-semibold">Lupa Password</a></span>
          </div>
        </div>

        <div class="mb-4 text-lg">
          <label for="g-recaptcha-response" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
          </svg>       
          Harap Selesaikan Captcha Terlebih Dahulu!</label>
          {!! NoCaptcha::display() !!}
          {!! NoCaptcha::renderJs() !!}
        </div>

        <div class="mt-8 flex justify-center text-lg text-white-900 font-bold">
          <button type="submit" class="rounded-3xl bg-purple-400 bg-opacity-50 px-10 py-2 text-white-900 dark:text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-purple-600">Login</button>
        </div>

        <div class="mb-4 text-lg align-bottom pt-4 items-center justify-center">
            <span>Tidak Mempunyai Akun ? Klik <a href="{{ route('register') }}" class="text-blue-500 hover:underline font-bold hover:font-semibold">Daftar</a> Disini.</span>
        </div>
        
      </form>
    </div>
  </div>
</div>

@endsection


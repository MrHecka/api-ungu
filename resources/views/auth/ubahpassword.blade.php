@extends('layout.success')

@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="overflow-y-auto relative flex md:h-screen sm:w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">
  <div class="overflow-y-auto max-[1024px]:h-120 max-[1024px]:py-2 rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16">
          <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z" clip-rule="evenodd" />
        </svg>

        <h1 class="mb-2 text-2xl font-bold">Ubah Password</h1>
    
      </div>

    <form action="{{ route('ubahPassword') }}" method="POST">
        @csrf

        <input type="hidden" id="token" name="token" value="{{ $token }}" required />
        <input type="hidden" id="email" name="email" value="{{ $email }}" required />

        <div class="mb-4 text-lg">
          <label for="password" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline items-center justify-center">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>Password Baru</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-16 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="password" name="password"  oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>
        <div class="mb-4 text-lg">
          <label for="password_confirmation" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline items-center justify-center">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>Konfirmasi Password</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-16 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="password" name="password_confirmation" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
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
          <button type="submit" class="rounded-3xl bg-purple-400 bg-opacity-50 px-10 py-2 text-white-900 dark:text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-purple-600">Ubah</button>
        </div>

      </form>
    </div>
  </div>
</div>



@endsection

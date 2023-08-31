@extends('layout.success')

@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="overflow-y-auto flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">
  <div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">

        <h1 class="mb-2 text-2xl font-bold">Ganti Password</h1>
    
      </div>

    <form action="{{ route('profil.updatePassword') }}" method="POST">
        @csrf
        <div class="mb-4 text-lg">
          <label for="old_password" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline items-center justify-center">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>Password Lama</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="password" name="old_password" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>
        <div class="mb-4 text-lg">
          <label for="password" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline items-center justify-center">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>Password Baru</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="password" name="password"  oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>
        <div class="mb-4 text-lg">
          <label for="password_confirmation" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline items-center justify-center">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>Konfirmasi Password</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="password" name="password_confirmation" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>
        <div class="mb-4 text-lg">
          <label for="g-recaptcha-response" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
          </svg>       
          Awas Lu Kalo Pake Bot😡</label>
          {!! NoCaptcha::display() !!}
          {!! NoCaptcha::renderJs() !!}
        </div>
        <div class="inline-flex mt-2 flex justify-content-center text-lg text-white-900 font-bold">
          <button type="submit" class="inline rounded-3xl bg-purple-400 bg-opacity-50 px-10 py-2 text-white-900 dark:text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-purple-600">Ubah</button>
        </div>
        <div class="inline-flex pl-4 mt-8 text-lg text-white-900 font-bold">
              <button type="submit" class="inline rounded-3xl bg-purple-400 bg-opacity-50 px-5 mr-10 py-2 items-right relative p-2 inline text-white-900 dark:text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-purple-600">
                <a href="{{ route('profil') }}">Kembali</a></button>
        </div>

      </form>
    </div>
  </div>
</div>



@endsection

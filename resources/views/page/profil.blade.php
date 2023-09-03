@extends('layout.success')

@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="overflow-y-auto flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">
  <div class="overflow-y-auto max-[1024px]:h-120 max-[1024px]:py-2 rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">

        <h1 class="mb-2 text-2xl font-bold">Edit Profil</h1>
    
      </div>

    <form action="{{ route('profil.update') }}" method="POST">
        @csrf
        <div class="mb-4 text-lg">
          <label for="text" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5 h-5 items-center justify-center inline" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
          </svg>Nama Lengkap</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="text" name="nama" value="{{ $nama }}" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>
        <div class="mb-4 text-lg">
          <label for="nohp" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-5 h-5 items-center justify-center inline" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
        </svg>No Hp</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="number" name="nohp" value="{{ $nohp }}"  oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>
        <div class="mb-4 text-lg">
          <label for="email" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path fill-rule="evenodd" d="M5.404 14.596A6.5 6.5 0 1116.5 10a1.25 1.25 0 01-2.5 0 4 4 0 10-.571 2.06A2.75 2.75 0 0018 10a8 8 0 10-2.343 5.657.75.75 0 00-1.06-1.06 6.5 6.5 0 01-9.193 0zM10 7.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" clip-rule="evenodd" />
          </svg>Email</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="email" name="email" value="{{ $email }}" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>
        <div class="mb-4 text-lg">
          <label for="apikey" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
          </svg>ApiKey
          </label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center inline px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="text" name="apikey" id="apikey" value="{{ $apikey }}" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required readonly/><button class="pl-4" type="button" onclick="generateapikey()"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5 h-5 items-end justify-center float-right inline" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
          </svg></button>
        </div>
        <div class="mb-4 text-lg">
          <label for="wlip" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
          </svg>
          Whitelist IPs
          </label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center inline px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="text" placeholder="101.18.34.1,188.19.23.1" name="wlip" id="wlip" value="" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')"/>
        </div>
         <div class="mb-4 text-lg">
          <label for="g-recaptcha-response" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
          </svg>       
          Awas Lu Kalo Pake Bot😡</label>
          {!! NoCaptcha::display() !!}
          {!! NoCaptcha::renderJs() !!}
        </div>
        <div class="inline-flex mt-8 flex justify-content-center text-lg text-white-900 font-bold">
          <button type="submit" class="inline rounded-3xl bg-purple-400 bg-opacity-50 px-10 py-2 text-white-900 dark:text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-purple-600">Edit</button>
        </div>
        <div class="inline-flex pl-4 mt-8 text-lg text-white-900 font-bold">
              <button type="button" class="inline rounded-3xl bg-purple-400 bg-opacity-50 px-5 mr-10 py-2 items-right relative p-2 inline text-white-900 dark:text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-purple-600">
                <a href="{{ route('profil.gantiPassword') }}">Ganti Password</a></button>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
  const generateNewApiKey = (length) => {
  let result = '';
  const characters =
    'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
  };

  function generateapikey(){
    document.getElementById("apikey").value = generateNewApiKey(32);;

  }

  
</script>


@endsection

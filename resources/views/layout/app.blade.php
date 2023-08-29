<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="API, APIUNGU, FREEAPI, APIKEYS, APIDEV, APIINDONESIA, INDONESIA, APPLICATION PROGRAMMING INTERFACE, PREMIUM API, FREE API, API KEYS, API INDONESIA, API ID">
    <meta name="description" value="API-UNGU | API UNTUK DEVELOPER">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <link rel="icon" type="image/x-icon" href="{{url('img/faviconHead.ico')}}">
    <title>API|UNGU</title>
    @vite('resources/css/app.css')
  </head>

{{-- SPIN PRELOADER --}}
@extends('layout.spinpreloader')
{{-- SPIN PRELOADER --}}
<body>
    <!-- HEADER -->
    <header>
        <nav id="nav" class="fixed inset-x-0 top-0 flex flex-row justify-between z-10 text-white bg-transparent">
            <div class="p-4 inline">
              @if (Auth::check())
                <img class="inline pb-2 w-12 h-12" src="{{url('img/faviconHead.ico')}}">
                <div class="inline animate-in slide-in-from-top transform transition-all hover:scale-125 font-extrabold tracking-widest text-xl"><a href="/dashboard" class="transition duration-500 hover:text-indigo-500">API-UNGU</a></div>
              @else
                <img class="inline pb-2 w-12 h-12" src="{{url('img/faviconHead.ico')}}">
                <div class="inline animate-in slide-in-from-top transform transition-all hover:scale-125 font-extrabold tracking-widest text-xl"><a href="/" class="transition duration-500 hover:text-indigo-500">API-UNGU</a></div>
              @endif
            </div>
      
            <div class="p-4 hidden md:flex flex-row justify-between font-bold">
              @if (Auth::check())
                <a href="{{ route('dashboard') }}" class="animate-in slide-in-from-top transform transition-all hover:scale-125 mx-4 text-lg border-b-2 border-transparent hover:border-b-2 hover:border-indigo-300 transition duration-500">Dashboard</a>
                <a href="{{ route('docs') }}" class="animate-in slide-in-from-top transform transition-all hover:scale-125 mx-4 text-lg border-b-2 border-transparent hover:border-b-2 hover:border-indigo-300 transition duration-500">Docs</a>
                <a href="{{ route('profil') }}" class="animate-in slide-in-from-top transform transition-all hover:scale-125 mx-4 text-lg border-b-2 border-transparent hover:border-b-2 hover:border-indigo-300 transition duration-500">Profil</a>
                <a href="{{ route('logout') }}" class="animate-in slide-in-from-top transform transition-all hover:scale-125 mx-4 text-lg border-b-2 border-transparent hover:border-b-2 hover:border-indigo-300">Logout</a>
              @else
                <a href="{{ route('login') }}" class="animate-in slide-in-from-top transform transition-all hover:scale-125 mx-4 text-lg border-b-2 border-transparent hover:border-b-2 hover:border-indigo-300 transition duration-500">Login</a>
                <a href="{{ route('register') }}" class="animate-in slide-in-from-top transform transition-all hover:scale-125 mx-4 text-lg border-b-2 border-transparent hover:border-b-2 hover:border-indigo-300 transition duration-500">Register</a>
              @endif
            </div>
            

            <div id="nav-open" class="p-4 md:hidden">
                <button onclick="NavMobileActive('#nav-opened')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                </button>
            </div>
          </nav>
          <div id="nav-opened" class="fixed left-0 right-0 hidden bg-purple-500 mx-2 mt-16 bg-opacity-50 rounded-br rounded-bl shadow z-10">
            <div class="p-2 divide-y divide-gray-600 flex flex-col">
              @if (Auth::check())
              <a href="{{ route('dashboard') }}" class="animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">Dashboard</a>
              <a href="{{ route('docs') }}" class="animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">Docs</a>
              <a href="{{ route('profil') }}" class="animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">Profil</a>
              <a href="{{ route('logout') }}" class="animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">Logout</a>
              @else
                <a href="{{ route('login') }}" class="animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">Login</a>
                <a href="{{ route('register') }}" class="animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">Register</a>
              @endif
            </div>
          </div>

    </header>

    <!-- KONTEN -->
    @yield('isikonten')

</body>


<footer class="flex flex-col items-center bg-neutral-900 text-center text-white font-bold">
  <div class="container px-6 pt-4 font-bold">
    <div class="mb-6 flex justify-center font-bold">
      <a href="https://macroma.site/">
        <img src="{{ url('/img/macroma_logo.webp') }}" class="inline w-16 h-16 mt-4" />
      </a>
      <a href="https://macroma.site/" class="inline pt-8 pr-4 font-bold animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">Macroma Media</a>
      <div class="inline-block h-[100px] min-h-[1em] w-0.5 self-stretch bg-neutral-100 opacity-100 dark:opacity-50"></div>
      
      <a href="{{ route('login') }}">
        <img src="{{ url('/img/faviconHead.ico') }}" class="inline w-16 h-16 mt-4 ml-2" />
      </a>
      <a href="{{ route('login') }}" class="inline pt-8 font-bold animate-in slide-in-from-top p-2 font-semibold text-white hover:text-indigo-500">API Ungu</a>
    </div>
  </div>

  <div class="w-full p-4 text-center" style="background-color: rgba(0, 0, 0, 0.2)">© <script>document.write(new Date().getFullYear())</script> Copyright: <a class="text-whitehite font-bold" href="https://tailwind-elements.com/">Macroma Media</a>
  </div>
</footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function NavMobileActive(idElem) {
            $(idElem).toggle();
        }

    $(window).on('load', function() {
        $('#spin-preloader').fadeOut();
    });
    $( '.g-recaptcha' ).attr( 'data-theme', 'dark' );
 
    </script>
</html>

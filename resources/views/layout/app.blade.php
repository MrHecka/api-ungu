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

<div class="flex flex-col">
    <footer class="bg-gradient-to-r from-fuchsia-900 to-violet-950 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; <script>document.write(new Date().getFullYear())</script> H3x4. All rights reserved❤</p>
        </div>
    </footer>
</div>

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

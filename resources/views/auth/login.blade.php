@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">
  <div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">
      <svg width="95px" height="95px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="a"></g> <g id="b"> <circle cx="21.5" cy="10.5" r="5.5" style="fill:#cfb1fc;"></circle> <path d="M24,9.5c0,.8284-.6716,1.5-1.5,1.5s-1.5-.6716-1.5-1.5,.6716-1.5,1.5-1.5,1.5,.6716,1.5,1.5Zm5,1.5c0,4.4111-3.5889,8-8,8-1.0234,0-2.0171-.1924-2.9629-.5732l-5.4009,4.96c-.2349,.2158-.5571,.3105-.8716,.2441l-.2905-.0576,.0312,.3213c.0298,.3135-.0889,.6221-.3213,.834l-.5796,.5293c-.1587,.1445-.3594,.2344-.5728,.2568l-.5713,.0576-.0459,.4414c-.0254,.2422-.1382,.4678-.3179,.6328l-1.7397,1.5996c-.1875,.1719-.4302,.2637-.6768,.2637-.1104,0-.2217-.0186-.3291-.0557l-1.9502-.6797c-.2871-.0996-.5132-.3252-.6143-.6123l-.7397-2.0996c-.126-.3584-.0381-.7568,.2266-1.0293L13.4346,13.5947c-.2886-.8369-.4346-1.7061-.4346-2.5947,0-4.4111,3.5889-8,8-8s8,3.5889,8,8Zm-2,0c0-3.3086-2.6914-6-6-6s-6,2.6914-6,6c0,.8369,.1733,1.6533,.5151,2.4258,.165,.373,.0869,.8096-.1978,1.1016L5.1396,24.9834l.3735,1.0605,.9307,.3242,1.0205-.9375,.0908-.874c.0488-.4707,.4219-.8438,.8931-.8916l1.0156-.1035-.1094-1.1357c-.0303-.3145,.0903-.625,.3247-.8379,.2349-.2109,.5557-.3037,.8662-.2383l1.1118,.2207,5.5137-5.0625c.3066-.2832,.7563-.3438,1.1274-.1562,.8511,.4307,1.7603,.6484,2.7017,.6484,3.3086,0,6-2.6914,6-6Z" style="fill:#96c;"></path> </g> </g></svg>
      <br>
        <h1 class="mb-2 text-2xl font-bold">Login Dulu Nye.</h1>
        <span class="text-gray-300">Masukkan Email & Password Dulu Woyyy!😡</span>
      </div>

      <form action="{{ route('postlogin') }}" method="POST">
        @csrf
    
        <div class="mb-4 text-lg">
          <label for="email" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path fill-rule="evenodd" d="M5.404 14.596A6.5 6.5 0 1116.5 10a1.25 1.25 0 01-2.5 0 4 4 0 10-.571 2.06A2.75 2.75 0 0018 10a8 8 0 10-2.343 5.657.75.75 0 00-1.06-1.06 6.5 6.5 0 01-9.193 0zM10 7.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" clip-rule="evenodd" />
          </svg>Email</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="email" value="{{ Session::get('email') }}" name="email" placeholder="emailku@gmail.com" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>

        <div class="mb-4 text-lg">
          <label for="password" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path fill-rule="evenodd" d="M8 7a5 5 0 113.61 4.804l-1.903 1.903A1 1 0 019 14H8v1a1 1 0 01-1 1H6v1a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 01.293-.707L8.196 8.39A5.002 5.002 0 018 7zm5-3a.75.75 0 000 1.5A1.5 1.5 0 0114.5 7 .75.75 0 0016 7a3 3 0 00-3-3z" clip-rule="evenodd" />
          </svg>
          Password</label>
          <input class="rounded-3xl border-none bg-purple-400 bg-opacity-50 items-center px-12 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50" type="password" name="password" placeholder="*********" oninvalid="this.setCustomValidity('Isi Dulu Yang Bener Ganteng :)')" oninput="setCustomValidity('')" required />
        </div>

        <div class="mb-4 text-lg">
          <label for="g-recaptcha-response" class="relative rounded-3xl border-none block mb-3 bg-opacity-50 space-x-3 items-center text-sm font-medium text-white-900 dark:text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 items-center justify-center inline">
            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
          </svg>       
          Awas Lu Kalo Pake Bot😡</label>
          {!! NoCaptcha::display() !!}
          {!! NoCaptcha::renderJs() !!}
        </div>

        <div class="mt-8 flex justify-center text-lg text-white-900 font-bold">
          <button type="submit" class="rounded-3xl bg-purple-400 bg-opacity-50 px-10 py-2 text-white-900 dark:text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-purple-600">Login</button>
        </div>

        <div class="mb-4 text-lg align-bottom pt-5 pl-5 items-center justify-center">
            <span>Gapunya Akun? Ya <a href="{{ route('register') }}" class="text-blue-500 hover:underline font-bold hover:font-semibold">Daftar</a> Jirr😡</span>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection


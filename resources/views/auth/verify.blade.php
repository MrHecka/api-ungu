@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="overflow-y-auto relative flex md:h-screen sm:w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">

  <div class="overflow-y-auto max-[1024px]:h-120 max-[1024px]:py-2  rounded-xl bg-gray-800 bg-opacity-50 px-16 py-5 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 h-24">
            <path fill-rule="evenodd" d="M5.478 5.559A1.5 1.5 0 016.912 4.5H9A.75.75 0 009 3H6.912a3 3 0 00-2.868 2.118l-2.411 7.838a3 3 0 00-.133.882V18a3 3 0 003 3h15a3 3 0 003-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0017.088 3H15a.75.75 0 000 1.5h2.088a1.5 1.5 0 011.434 1.059l2.213 7.191H17.89a3 3 0 00-2.684 1.658l-.256.513a1.5 1.5 0 01-1.342.829h-3.218a1.5 1.5 0 01-1.342-.83l-.256-.512a3 3 0 00-2.684-1.658H3.265l2.213-7.191z" clip-rule="evenodd" />
            <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v6.44l1.72-1.72a.75.75 0 111.06 1.06l-3 3a.75.75 0 01-1.06 0l-3-3a.75.75 0 011.06-1.06l1.72 1.72V3a.75.75 0 01.75-.75z" clip-rule="evenodd" />
          </svg>          
      <br>
        <h1 class="mb-2 text-2xl font-bold">Verifikasi Email</h1>
        <span class="text-gray-300 font-bold">Silahkan Melakukan Verifikasi Email Terlebih Dahulu ^_^</span>
      </div>
      <span class="text-gray-300 font-bold">Sebelum melakukan autentikasi, silahkan verifikasi email anda terlebih dahulu cek email anda sekarang atau cek pada inbox spam dan lakukan verifikasi email!</span>
      <span class="text-gray-300 font-bold"> Anda masih belum mendapatkan email dari kami ? </span>

      <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-blue-800 font-bold">Klik disini untuk mengirim ulang verifikasi email!</button>.
    </form>
    </div>
  </div>
</div>

@endsection


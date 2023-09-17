@extends('layout.success')

@extends('layout.error')

@extends('layout.app')

@section('title')DOCS |@endsection

@section('isikonten')

<div class="overflow-y-auto pt-16 flex flex-col h-screen w-full inline items-center text-md text-white text-left font-sans justify-center font-bold bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">
<div class="overflow-y-auto text-white text-left">
    <p class="text-2xl">API-UNGU DOCS</p>

    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bgdark:bg-white-900 text-white-900 dark:text-white" data-inactive-classes="text-white-500 dark:text-white-400">
        @foreach($apiLists as $apiDocs)
            <h2 id="accordion-flush-heading-{{ $loop->iteration }}">
                <button type="button" class="flex items-center justify-between w-full p-5 px-96 font-medium text-left text-white-500 border border-b-1 border-white-200 rounded-t-md focus:ring-4 focus:ring-white-200 dark:focus:ring-white-800 dark:border-white-700 dark:text-white-400 hover:bg-white-100 dark:hover:bg-white-800" data-accordion-target="#accordion-flush-body-{{ $loop->iteration }}" aria-expanded="false" aria-controls="accordion-flush-body-{{ $loop->iteration }}">
                    <span>[{{ $apiDocs['methodReq'] }}] {{ $apiDocs['title']  }}</span>
                </button>
            </h2>
            <div id="accordion-flush-body-{{ $loop->iteration }}" class="hidden overflow-y-auto pt-16 flex flex-col h-screen w-full inline items-center text-md" aria-labelledby="accordion-flush-heading-{{ $loop->iteration }}">
                <div class="overflow-y-auto pt-16 flex flex-col h-screen w-full inline items-center text-md p-5 border border-b-1 bg-gray-900 border-white-200 dark:border-white-700 dark:bg-gray-900">
                    <p>Response:</p>
                    <pre class="mb-2 text-white-500 dark:text-white-400 flex-grow">{{ json_encode($apiDocs['docs'], JSON_PRETTY_PRINT) }}</pre>
                </div>
            </div>
        @endforeach
    </div>

</div>
      
</div>

@endsection

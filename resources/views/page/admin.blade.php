@extends('layout.success')

@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">
<div class="my-3 p-3 bg-body rounded shadow-sm">
<div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
<div class="text-white">
    
            <!-- FORM PENCARIAN -->
            
            <div class="mb-3">
                <form action="{{ url('admin') }}" method="get" class="relative flex w-full">
                    <div class="relative flex w-full">
                        <input
                            type="search"
                            name="katakunci"
                            value="{{ Request::get('katakunci') }}"
                            aria-label="Search"
                            class="relative block w-full min-w-0 flex-auto px-3 py-1.5 text-base font-normal text-white bg-transparent border border-solid border-neutral-300 rounded bg-clip-padding transition duration-200 ease-in-out outline-none focus:z-[3] focus:border-primary focus:text-white focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] dark:border-neutral-600 dark:text-neutral-200 dark:placeholder-text-neutral-200 dark:focus:border-primary"

                            placeholder="Search"
                        />
                        <button
                            type="submit"
                            class="btn btn-secondary flex items-center px-3 py-1.5 rounded ml-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            

            
          
                <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Nama Lenkap</th>
                            <th scope="col" class="px-6 py-4">No hp</th>
                            <th scope="col" class="px-6 py-4">Email</th>
                            <th scope="col" class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i= $data->firstItem()?>
                        @foreach ($data as $item)
                            
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4">{{ $i }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $item->nama }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $item->nohp }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $item->email }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                            
                            <a href='{{ url('page.admin/'.$item->id.'/edit') }}'> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 d-flex inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg></a>

                           <form onsubmit="return confirm('yakin mau delete?')" class="d-flex inline" action="{{ url('admin/'.$item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" name="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 d-flex inline">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    </button>
                                </form>
                                
                                
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                               
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
               {{ $data->withQueryString()->links('pagination::tailwind') }}
          </div>
</div>
</div>
</div>
      

@endsection
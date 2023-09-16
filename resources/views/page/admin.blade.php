@extends('layout.success')

@extends('layout.error')

@extends('layout.app')

@section('isikonten')

<div class="overflow-y-auto overflow-x-auto flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url({{url('img/bgAuth.webp')}})">
    <div class="overflow-y-auto overflow-x-auto max-[1024px]:h-120 max-[1024px]:py-2 my-3 p-3 bg-body rounded shadow-sm">
        <div class="overflow-y-auto overflow-x-auto rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
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
                            <th scope="col" class="px-6 py-4">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-4">No. HP</th>
                            <th scope="col" class="px-6 py-4">Email</th>
                            <th scope="col" class="px-6 py-4">Role</th>
                            <th scope="col" class="px-6 py-4">Verifikasi Email</th>
                            <th scope="col" class="px-6 py-4">Status</th>
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
                            <td class="whitespace-nowrap px-6 py-4">{{ $item->is_dewa ? 'Admin':'User' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $item->email_verified_at ? 'Terverifikasi':'Belum Verifikasi' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ in_array($item->id,array_column(json_decode($logs_login), 'id')) ? 'Online':'Offline' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <a href='#' data-target="{{ $item->id }}" class="openModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 d-flex inline">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>

                                <form onsubmit="return confirm('Apakah anda yakin menghapus user ini?')" class="d-flex inline" action="{{ url('admin/'.$item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 d-flex inline">
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
                <br><p class="font-bold">Online Users [5 Menit Terakhir] : {{ count($logs_login) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="invisible fixed inset-0 items-center justify-center bg-opacity-50 bg-cover bg-no-repeat" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="interestModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div class="inline-block align-bottom rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-opacity-50 px-16 py-5 shadow-lg backdrop-blur-md max-sm:px-8 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 text-center justify-center">
                <div class="sm:flex sm:items-start">
                    <div class="container text-center justify-center">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-2xl leading-6 font-medium text-white text-center pb-8" id="modal-title">
                                UPDATE USER
                            </h3>
                            <div class="mt-2 justify-center items-center">
                                <div class="w-full items-center justify-center m-0">
                                    <form method="POST" action="{{ url('admin/'.$item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="userId" name="userId" value="">
                                        
                                        <div class="mb-4">
                                            <label for="nama" class="block text-center items-center justify-center text-white text-sm font-bold mb-2 w-full">Nama User :</label>
                                            <input type="text" value="" class="rounded-3xl border-none text-white bg-purple-400 bg-opacity-50 items-center px-4 lg:px-32 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50 w-full" id="nama" name="nama" placeholder="Nama">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="nohp" class="block text-center items-center justify-center text-white text-sm font-bold mb-2 w-full">No HP :</label>
                                            <input class="rounded-3xl border-none text-white bg-purple-400 bg-opacity-50 items-center px-4 lg:px-32 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50 w-full" id="nohp" name="nohp" value="" type="text" placeholder="No HP">
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="email" class="block text-center items-center justify-center text-white text-sm font-bold mb-2 w-full">Email :</label>
                                            <input class="rounded-3xl border-none text-white bg-purple-400 bg-opacity-50 items-center px-4 lg:px-32 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50 w-full" id="email" name="email" value="" type="email" placeholder="Email">
                                        </div>
                                        
                                        <div class="mb-4 place-self-center place-self-center place-items-center content-center place-items-center text-center font-bold">
                                            <label for="roles" class="block text-center items-center justify-center text-white text-sm font-bold mb-2 w-full">Verifikasi Email :</label>
                                            <select class="place-self-center text-center items-center rounded-3xl place-items-center border-none justify-center text-white bg-purple-400 bg-opacity-50 px-12 text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50 w-full" id="verifyEmail" name="verifyEmail">
                                                <option value="">Belum Verifikasi</option>
                                                <option value={{ date("Y-m-d H:i:s"); }}>Sudah Verifikasi</option>
                                              </select>
                                        </div>

                                        <div class="mb-4 place-self-center place-self-center place-items-center content-center place-items-center text-center font-bold">
                                            <label for="roles" class="block text-center items-center justify-center text-white text-sm font-bold mb-2">Role User :</label>
                                            <select class="place-self-center text-center items-center rounded-3xl place-items-center border-none justify-center text-white bg-purple-400 bg-opacity-50 px-12 text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md placeholder-opacity-50 w-full" id="roles" name="roles">
                                                <option value=0>User</option>
                                                <option value=1>Admin</option>
                                              </select>
                                        </div>
                                        
                                        <div class="mb-4 place-self-center content-center place-items-center text-center font-bold md:text-center md:text-right">
                                            <button type="button" class="closeModal mt-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Cancel
                                            </button>

                                            <button type="submit" id="updateButton" class="flex inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- END MODAL --}}

{{-- Script Modal --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('.openModal').on('click', function (e) {
            var userId = $(this).data('target');
            $('#userId').val(userId);

            $.ajax({
                url: '/admin/' + userId, 
                method: 'GET',
                success: function (response) {
                    $('#nama').val(response.UserDetails.nama);
                    $('#nohp').val(response.UserDetails.nohp);
                    $('#email').val(response.UserDetails.email);
                    $('#roles').val(response.UserDetails.is_dewa).attr('selected','selected');
                    $('#interestModal').removeClass('invisible');

                },
                error: function (xhr, status, error) {

                }
            });
        });

        $('.closeModal').on('click', function (e) {
            $('#interestModal').addClass('invisible');
            // Reset nilai input ke default jika perlu
        });

    });
</script>
@endsection

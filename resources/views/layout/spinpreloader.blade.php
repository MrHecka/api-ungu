{{-- SPIN PRELOADER --}}
<div class="h-screen w-full bg-indigo-400 bg-opacity-50 flex justify-center items-center absolute right-1/2 bottom-1/2 transform translate-x-1/2 translate-y-1/2" id="spin-preloader">
    <div class="p-4 bg-gradient-to-tr animate-spin from-indigo-500 to-purple-500 via-purple-500 rounded-full">
        <div class="bg-purple rounded-full">
            <div class="w-24 h-24 rounded-full"></div>
        </div>
    </div>
</div>

<script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    $(window).on('load', function() {
        $('#spin-preloader').fadeOut();
    });
</script>

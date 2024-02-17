<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('welcome.css') }}" />

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-lighter bg-center bg-gray-100 light:bg-dots-darker light:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/home') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 light:text-gray-400 light:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 light:text-gray-400 light:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 light:text-gray-400 light:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <!-- resources/views/pola_bintang/index.blade.php -->
        <div class="container">
            <div class="row my-2">
                <div class="form-group my-2">
                    <label for="jumlah_bintang">Input: Berbintang</label>
                    <input class="form-control" type="number" name="jumlah_bintang" id="jumlah_bintang" required>
                    <button class="btn btn-primary btn-sm w-25 mt-2" type="button" id="submitBtn">Submit</button>
                </div>
            </div>
            <div class="row my-2">
                <div id="hasilPolaBintang"></div>
            </div>

            <div class="row my-2">
                <div class="form-group my-2">
                    <label for="jumlah_angka">Input: Angka</label>
                    <input class="form-control" type="number" name="jumlah_angka" id="jumlah_angka" required>
                    <button class="btn btn-primary btn-sm w-25 mt-2" type="button" id="submitBtnAngka">Submit</button>
                </div>
            </div>
            <div class="row my-2">
                <div id="hasilPolaAngka"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function() {
                var jumlahBintang = $('#jumlah_bintang').val();

                $.ajax({
                    type: 'GET',
                    url: "{{ route('cetak-berbintang') }}",
                    data: {
                        jumlah_bintang: jumlahBintang
                    },
                    success: function(data) {
                        var polaHtml = '';
                        $.each(data.pola_bintang, function(index, value) {
                            polaHtml += value + '<br>';
                        });
                        $('#hasilPolaBintang').html(polaHtml);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#submitBtnAngka').click(function() {
                var jumlahAngka = $('#jumlah_angka').val();
                console.log(jumlahAngka);

                $.ajax({
                    type: 'GET',
                    url: "{{ route('cetak-angka') }}",
                    data: {
                        jumlah_angka: jumlahAngka
                    },
                    success: function(data) {
                        var polaAngka = '';
                        $.each(data.pola_bintang, function(index, value) {
                            polaAngka += value + '<br>';
                        });
                        $('#hasilPolaAngka').html(polaAngka);
                    }
                });
            });
        });
    </script>
</body>

</html>

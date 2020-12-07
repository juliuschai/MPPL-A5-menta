@extends('layouts.app')

@section('content')
<link href="{{ asset('css/about.css') }}" rel="stylesheet">
<main class="text-dark-blue">
    <div class="py-4 about-img-1">
        <div class="container">
            <div class="col">
                <div class="row">
                    <div class="col p-5" style="height: 700px">
                        <div class="row p-5 about-title">
                            <span>Apa itu <span class="color-yellow">MENTA</span></span>?
                        </div>
                        <div class="row">
                            <div class="col-7 rounded-rectangle yellow">
                                MENTA sebagai <b>platform konseling online</b> berbasis web menyediakan fitur yang tepat
                                untuk
                                menjadi
                                alternatif sistem konseling konvensional. <br>
                                <br>
                                Sistem ini juga dapat digunakan oleh semua orang yang memiliki perangkat elektronik yang
                                mendukung dalam mengakses web sehingga membuat konseling psikologi lebih aksesibel.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="white">
            <div class="container" style="height: 200px">
                <div class="row justify-content-center " style="height: 100%">
                    <div class="col-inline align-self-end">
                        <span class="about-title">MISI <span class="color-yellow">KAMI</span>!</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-img-2" style="height: 546px">
            <div class="container" style="height: 100%">
                <div class="row p-5 justify-content-center">
                    <div class="col-6 rounded-rectangle yellow">
                        Membuat <b>konseling profesional</b> yang mudah diakses, terjangkau, nyaman sehingga siapa
                        pun yang sedang mengalami masalah bisa mendapatkan bantuan, <b>kapan pun dan dimana pun.</b>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

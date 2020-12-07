@extends('layouts.app')

@section('content')
<link href="{{ asset('css/about.css') }}" rel="stylesheet">
<main class="text-dark-blue ">
    <div class="main-banner" id="top">
        <img src="{{ asset('img/menta2.jpeg') }}" alt="waves" id="bg-video">
        <div class="video-overlay header-text">
            <div class="caption">
                <h2>SEBUAH RUMAH UNTUK
                    <em>BERKELUH KESAH</em></h2>
                <h6>Disini, kamu tidak perlu menyembunyikan apapun atau bahkan <em>berpura-pura baik-baik saja.</em>
                </h6>
                <div class="mt-2 main-button scroll-to-section">
                    <a href="#features">Yuk, Konseling!</a>
                </div>
            </div>
        </div>
    </div>

    <section class="section white" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>FASILITAS <em>UNTUK KAMU</em></h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="{{ asset('img/group_24px_rounded.svg') }}" alt="First One">
                            </div>
                            <div class="right-content">
                                <h4>Konseling dengan ahlinya!</h4>
                                <p>Menta menyediakan terapis yang profesional,
                                    berlisensi, dan teruji yang dapat kamu percayai! </p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="{{ asset('img/event_available_24px_rounded.svg') }}" alt="second one">
                            </div>
                            <div class="right-content">
                                <h4>Media dan jadwal yang fleksibel!</h4>
                                <p>Berbicara dengan terapis kini menjadi lebih mudah,
                                    hanya dengan media <b>chat</b>, <b>telepon</b>, ataupun <b>video!</b>
                                    </p>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="{{ asset('img/insert_drive_file_24px_rounded.svg') }}" alt="third gym training">
                            </div>
                            <div class="right-content">
                                <h4>Bacaan terkait self-healing!</h4>
                                <p>Credit goes to <a rel="nofollow" href="https://www.pexels.com" target="_blank">Pexels
                                        website</a> for images and video background used in this HTML template.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <img src="{{ asset('img/menta-consull-3.png') }}" alt="">
                </div>
    </section>

    <section class="section" id="call-to-action">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-lg-8">
                    <div class="cta-content color-white">
                        <h2>KONSELING ONLINE DENGAN TERAPIS<em class="color-yellow"> PERTAMA DI INDONESIA</em></h2>
                        <p>Karena kesehatan mentalmu yang utama, diatas segalanya!</p>
                        <div class="main-button scroll-to-section">
                            <a href="#our-classes">YUK KONSELING!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section white" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>KENALAN<em> YUK!</em></h2>
                        <img src="{{ asset('img/line-dec.png') }}" alt="">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="{{ asset('img/terapis1.jpg') }}" alt="">
                        </div>
                        <div class="down-content">
                            <span>Ahli Terapi Perilaku</span>
                            <h4>Bret D. Bowers</h4>
                            <p>Bitters cliche tattooed 8-bit distillery mustache. Keytar succulents gluten-free vegan
                                church-key pour-over seitan flannel.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="{{ asset('img/image2.png') }}" alt="">
                        </div>
                        <div class="down-content">
                            <span>Ahli Terapi Humanistik</span>
                            <h4>Chintya, S.Ft, M.Psi</h4>
                            <p>Ketua organisasi kesehatan mental
                                terkemuka yang telah tersebar di
                                seluruh daerah di Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="{{ asset('img/terapis3.jpg') }}" alt="">
                        </div>
                        <div class="down-content">
                            <span>Ahli Terapi Humanistik</span>
                            <h4>Natih, S.Psi, M.Psi</h4>
                            <p>Seorang pendiri sekaligus rektor
                                institut kesehatan mental
                                di Indonesia.
                                </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="contact-us">
        <div class="container-fluid">
            <div class="row yellow">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1976.584487283649!2d110.37873778478202!3d-7.771899694566659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b4e053d857%3A0x9f54d8ccdc210f52!2sFaculty%20of%20Psychology%20Gadjah%20Mada%20University!5e0!3m2!1sen!2sid!4v1607344046378!5m2!1sen!2sid"
                            width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12 pl-5">
                    <div class="cta-content color-white p-5">
                        <h2>Karena <i>feedback</i> darimu<em class="color-dark-blue"> sangat berarti</em> bagi kami!</h2>
                    </div>
                    <div class="contact-form">
                        <form id="contact" action="" method="post">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" id="name" placeholder="Nama Lengkap" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                            placeholder="E-mail" required="">
                                    </fieldset>
                                </div>

                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" id="message"
                                            placeholder="Pesan dan kesanmu selama menggunakan MENTA!"
                                            required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="main-button">Kirim</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

@extends('layouts.app')

@section('content')
<section class="program-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Program Kami</h2>
            <hr class="w-25 mx-auto border-dark">
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/img/program.png') }}" class="card-img-top" alt="Program 1">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Rumah Tahfizh Bina Al Qur’an (RTQ)</h5>
                        <p>Rumah Tahfizh Bina Al Qur’an (RTQ) adalah lembaga pendidikan non-formal yang berfokus pada pembinaan generasi penghafal Al-Qur’an. RTQ hadir sebagai wadah untuk membentuk karakter islami, menanamkan cinta terhadap Al-Qur’an sejak dini, serta mencetak generasi yang tidak hanya mampu menghafal, tetapi juga memahami dan mengamalkan isi kandungannya dalam kehidupan sehari-hari.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/img/program.png') }}" class="card-img-top" alt="Program 2">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Rumah Pembelajaran Qiro’atul Qur’an (RPQQ) setingkat remaja dan dewasa.</h5>
                        <p>Rumah Pembelajaran Qiro’atul Qur’an (RPQQ) merupakan sebuah lembaga pembinaan dan pendidikan Al-Qur’an yang berfokus pada peningkatan kemampuan membaca, memahami, dan mengamalkan Al-Qur’an secara baik dan benar. Khusus untuk jenjang remaja dan dewasa, RPQQ hadir sebagai wadah yang memberikan kesempatan belajar yang inklusif, sistematis, dan mendalam sesuai dengan kebutuhan usia dan tingkat pemahaman peserta.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/img/program.png') }}" class="card-img-top" alt="Program 3">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Sekolah Al-Quran, Bahasa dan Teknologi Informasi dari tingkat SD - SMA/SMK.</h5>
                        <p>Sekolah Al-Quran, Bahasa, dan Teknologi Informasi adalah institusi pendidikan terpadu yang menggabungkan pendidikan formal umum dengan pendalaman ilmu agama (Al-Quran), penguasaan bahasa asing, serta keterampilan teknologi informasi. Sekolah ini dirancang untuk mencetak generasi yang beriman, berilmu, dan berdaya saing global, dengan kurikulum yang disesuaikan untuk setiap jenjang pendidikan dari SD, SMP, hingga SMA/SMK.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/img/program.png') }}" class="card-img-top" alt="Program 4">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Academy Kaderisasi Keguruan Bahasa, Al-Quran dan Teknologi Informasi setingkat perguruan tinggi.</h5>
                        <p>Academy Kaderisasi Keguruan Bahasa, Al-Qur'an, dan Teknologi Informasi merupakan lembaga pendidikan tinggi yang bertujuan mencetak tenaga pendidik dan profesional unggul di bidang bahasa, pengajaran Al-Qur'an, dan teknologi informasi. Akademi ini didirikan sebagai respons terhadap kebutuhan akan kader pendidik yang tidak hanya menguasai ilmu kebahasaan dan keagamaan, tetapi juga mampu beradaptasi dengan perkembangan teknologi dalam dunia pendidikan modern.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

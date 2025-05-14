<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        Profile::create([
            'title' => 'Smart Character Islamic School (SCIS)',
            'content' => 'SCIS Campus<br><br>Smart Character Islamic School (SCIS) merupakan salah satu lembaga kaderisasi pemimpin masa depan untuk peradaban Islam yang beroperasi di Tasikmalaya sejak tahun 2024. <br><br>Pendidikan adalah proses pembelajaran manusia untuk membangun suatu peradaban yang bermuara pada terwujudnya suatu tatanan masyarakat yang sejahtera lahir dan batin. Setiap orang tua menginginkan pendidikan yang terbaik bagi putra-putrinya dan kami di SCIS juga memiliki keinginan yang sama. <br><br><strong>SCIS</strong> adalah lembaga kaderisasi dan pendidikan berfungsi sebagai lembaga fasilitator pengembangan minat bakat peserta didik dengan dasar Al Quran dan wawasan global. SCIS ringkasan dari bahasa Inggris yaitu Smart Character Islamic School disingkat SCIS. Pendiri lembaga memiliki cita-cita menjadikan lembaga ini bertaraf internasional dengan bahasa pengantar bahasa internasional khususnya Inggris dan Arab, membekali peserta didik dengan kompetensi informatika yang merupakan jendela ilmu pengetahuan dan teknologi abad ini serta mewajibkan peserta didik untuk menghafal Al Quran agar memiliki benteng spiritual yang kokoh. <br><br>SCIS menyelenggarakan 2 (dua) model pendidikan dan pengkaderan, yaitu formal dan non formal yang masing-masing terintegrasi dalam satu irama kehidupan Sistem Boarding School dan Fullday School. Kampus pusat SCIS terletak di Kebon Manggu Jl. Situ Bojong Kelurahan Tamanjaya, Kecamatan Tamansari, Kota Tasikmalaya, Jawa Barat. <br><br>Dengan sistem pesantren (Islamic Boarding) dan didukung oleh para pengajar yang berpengalaman dalam bidangnya. SCIS memberikan lingkungan yang bernuansa internasional dengan mengangkat bahasa Inggris/Arab sebagai bahasa kesehariannya. <br>Selain itu, kami juga menyuguhkan nuansa lingkungan yang mengedepankan nilai-nilai keislaman (Islamic Values). Disamping itu tidak ketinggalan kami berusaha untuk menyediakan fasilitas belajar, asrama dan sarana pendukung lainnya sehingga tercipta lingkungan KBM yang kondusif, bersih dan nyaman. <br>Pendidikan yang ideal tidak akan terwujud tanpa adanya dukungan orang tua dan keluarga santri. Maka dari itu, jaringan komunikasi dan layanan informasi yang ramah menjadi prioritas kami dalam melayani orang tua dan santri.',
            'image' => 'profile_images/program-1.png',
        ]);
    }
}

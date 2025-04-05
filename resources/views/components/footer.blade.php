<footer>
    <div class="footer__area">
        <div class="footer__top grey-bg-4 pt-95 pb-45">
            <div class="container">
                <div class="row">
                    <!-- Logo and Description -->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-7">
                        <div class="footer__widget footer-col-1 mb-50">
                            <div class="footer__logo">
                                <a href="{{route('landing.home')}}">
                                    <img src="{{asset('assets/img/logo/logo-name.png')}}" alt="" style="width: 100%; height: auto; max-width: 250px;">
                                </a>
                            </div>
                            <div class="footer__widget-content">
                                <p style="margin-top: 10px; color: #031220;">Making Technology as a Container, Quran as a Foundation.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Helpful Links -->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-7">
                        <div class="footer__widget mb-50">
                            <h3 style="font-weight: bold; color: #031220; margin-bottom: 15px;">Link Bermanfaat</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 10px;">
                                    <a href="{{route('landing.home')}}" style="color: #031220; text-decoration: none;" onmouseover="this.style.color='#28a745';"
                                        onmouseout="this.style.color='#031220';">Beranda</a>
                                </li>
                                <li style="position: relative; margin-bottom: 10px;"
                                    onmouseenter="showDropdown(this)"
                                    onmouseleave="hideDropdown(this)">
                                    <a href="#" style="color: #031220; text-decoration: none; display: flex; align-items: center;" onmouseover="this.style.color='#28a745';"
                                    onmouseout="this.style.color='#031220';">
                                        Tentang Kami <span style="margin-left: 8px; font-size: 14px;">›</span>
                                    </a>
                                    <div class="submenu" style="display: none; position: absolute; left: 0; background: white; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); width: 150px; border-radius: 5px; z-index: 10;">
                                        <div style="padding: 8px 12px; white-space: nowrap;">
                                            <a href="{{route('landing.profile')}}" style="color: #031220; display: block;" onmouseover="this.style.color='#28a745';"
                                            onmouseout="this.style.color='#031220';">Profil</a>
                                        </div>
                                        <div style="padding: 8px 12px; white-space: nowrap;">
                                            <a href="{{route('landing.vision')}}" style="color: #031220; display: block;" onmouseover="this.style.color='#28a745';"
                                            onmouseout="this.style.color='#031220';">Visi dan Misi</a>
                                        </div>
                                        <div style="padding: 8px 12px; white-space: nowrap;">
                                            <a href="{{route('landing.program')}}" style="color: #031220; display: block;" onmouseover="this.style.color='#28a745';"
                                            onmouseout="this.style.color='#031220';">Program</a>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="{{route('landing.ppdb')}}" style="color: #031220; text-decoration: none;" onmouseover="this.style.color='#28a745';"
                                        onmouseout="this.style.color='#031220';">PPDB</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Us -->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-7">
                        <div class="footer__widget mb-50">
                            <h3 class="footer__widget-title" style="font-weight: bold; color: #031220; margin-bottom: 15px;">Hubungi Kami</h3>
                            <ul style="padding: 0; margin: 0; list-style: none;">
                                <li style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 15px; line-height: 1.6;">
                                    <i class="fa-solid fa-map-marker-alt" style="color: #28a745; font-size: 18px; margin-top: 5px;"></i>
                                    <a href="https://maps.app.goo.gl/GmLnp8cWdumje7d86?g_st=aw" target="_blank" style="color: #031220; text-decoration: none;"
                                        onmouseover="this.style.color='#28a745';"
                                        onmouseout="this.style.color='#031220';">
                                        Jl. Balaraja No. 67 Kp. Kalista Blok 1 Kec. Cibeureum, Kota Tasikmalaya, Jawa barat 46196
                                    </a>
                                </li>
                                <li style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px; line-height: 1.6;">
                                    <i class="fa-solid fa-phone" style="color: #28a745; font-size: 18px;"></i>
                                    <a href="https://wa.me/6281777888" target="_blank" style="color: #031220; text-decoration: none;"
                                        onmouseover="this.style.color='#28a745';"
                                        onmouseout="this.style.color='#031220';">
                                        6281777888
                                    </a>
                                </li>
                                <li style="display: flex; align-items: center; gap: 12px; line-height: 1.6;">
                                    <i class="fa-solid fa-envelope" style="color: #28a745; font-size: 18px;"></i>
                                    <a href="mailto:info@scis" target="_blank" style="color: #031220; text-decoration: none;"
                                        onmouseover="this.style.color='#28a745';"
                                        onmouseout="this.style.color='#031220';">
                                        info@scis
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Registration -->
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-7">
                        <div class="footer__widget mb-50">
                            <h3 class="footer__widget-title" style="font-weight: bold; color: #031220; margin-bottom: 15px;">Pendaftaran</h3>
                            <p style="color: #031220; margin-bottom: 20px;">Isi Formulir Pendaftaran secara online sesuai dengan jenjang yang diinginkan, inden mulai sekarang untuk pendaftaran tahun ajaran yang akan datang.</p>
                            <a href="{{route('auth.register')}}" style="display: inline-block; padding: 10px 20px; background-color: #E47804; color: #fff; text-decoration: none; border-radius: 5px; transition: 0.3s;"
                                onmouseover="this.style.backgroundColor='#FF9800';"
                                onmouseout="this.style.backgroundColor='#E47804';">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer__bottom grey-bg-4">
            <div class="container">
                <div class="footer__bottom-inner">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="footer__copyright text-center">
                                <p style="color: #4B535A; margin: 0;">© SCIS, 2024. All Right Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

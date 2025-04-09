<header>
    <!-- Top Header (Location) -->
    <div class="header__top" style="background-color: #f0f0f0; color: #031220; padding: 8px 0; border-bottom: 1px solid #dee2e6;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between">

                    <!-- Location -->
                    <div class="header__top-left">
                        <a href="https://maps.app.goo.gl/GmLnp8cWdumje7d86?g_st=aw" target="_blank"
                            style="display: inline-flex; align-items: center; gap: 5px; color: #4B535A; text-decoration: none; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#4B535A';">
                            <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.9235 4.66671C5.23068 4.66671 4.66709 5.2303 4.66709 5.92383C4.66709 6.61666 5.23068 7.17953 5.9235 7.17953C6.61632 7.17953 7.17991 6.61666 7.17991 5.92383C7.17991 5.2303 6.61632 4.66671 5.9235 4.66671ZM5.92354 8.25642C4.63698 8.25642 3.59021 7.21037 3.59021 5.9238C3.59021 4.63652 4.63698 3.58975 5.92354 3.58975C7.21011 3.58975 8.25688 4.63652 8.25688 5.9238C8.25688 7.21037 7.21011 8.25642 5.92354 8.25642Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.92278 1.07695C3.25058 1.07695 1.07663 3.27172 1.07663 5.96834C1.07663 9.39942 5.11437 12.7422 5.92278 12.9202C6.73119 12.7415 10.7689 9.3987 10.7689 5.96834C10.7689 3.27172 8.59499 1.07695 5.92278 1.07695ZM5.92259 14C4.63459 14 -0.000488281 10.0139 -0.000488281 5.96831C-0.000488281 2.67723 2.65664 0 5.92259 0C9.18854 0 11.8457 2.67723 11.8457 5.96831C11.8457 10.0139 7.21059 14 5.92259 14Z" fill="currentColor" />
                            </svg>
                            Jl. Situ Bojong Kel. Tamanjaya, Kec. Tamansari, Kota Tasikmalaya.
                        </a>
                    </div>

                    <!-- Social Media -->
                    <div class="header__top-right" style="display: flex; align-items: center; gap: 10px;">
                        <a href="#" style="color: #9AA6B2; text-decoration: none; font-size: 20px; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#9AA6B2';">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="#" style="color: #9AA6B2; text-decoration: none; font-size: 20px; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#9AA6B2';">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#" style="color: #9AA6B2; text-decoration: none; font-size: 20px; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#9AA6B2';">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="#" style="color: #9AA6B2; text-decoration: none; font-size: 20px; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#9AA6B2';">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bottom Header (Logo, Navigation, Search, Registration) -->
    <div class="header__area">
        <div class="header__bottom grey-bg-4" id="header-sticky" style="padding: 10px 0; border-bottom: 1px solid #dee2e6;">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-6 col-6">
                        <div class="logo">
                            <a href="{{route('landing.home')}}">
                                <img src="{{asset('assets/img/logo/logo-name.png')}}"
                                    alt="Smart Character Islamic School Logo"
                                    style="max-width: 100%; height: auto; width: clamp(150px, 40%, 250px);">
                            </a>
                        </div>

                    </div>

                    <!-- Menu, Search, dan Registration -->
                    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-6 col-6">
                        <div class="header__right" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">

                            <!-- Navigation -->
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul style="list-style: none; margin: 0; padding: 0; display: flex; gap: 20px;">
                                        <li style="position: relative;">
                                            @if ($title == 'Beranda')
                                            <a href="{{ route('landing.home') }}"
                                                style="color: #28a745; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;">
                                                Beranda
                                            </a>
                                            @else
                                            <a href="{{ route('landing.home') }}"
                                                style="color: #031220; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;"
                                                onmouseover="this.style.color='#28a745';"
                                                onmouseout="this.style.color='#031220';">
                                                Beranda
                                            </a>
                                            @endif
                                        </li>

                                        <!-- Dropdown -->
                                        <li class="has-dropdown" style="position: relative;" onmouseover="showDropdown(this)" onmouseout="hideDropdown(this)">
                                            @if ($title == 'Tentang Kami' || $title == 'Profil' || $title == 'Visi dan Misi' || $title == 'Program')
                                            <a href="#"
                                                style="color: #28a745; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;">
                                                Tentang Kami
                                            </a>
                                            @else
                                            <a href="#"
                                                style="color: #031220; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;"
                                                onmouseover="this.style.color='#28a745'; showDropdown(this);"
                                                onmouseout="this.style.color='#031220'; hideDropdown(this);">
                                                Tentang Kami
                                            </a>
                                            @endif
                                            <ul class="submenu"
                                                style="display: none; position: absolute; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px 0; min-width: 160px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); top: 100%; left: 0;">
                                                <li>
                                                    <a href="{{route('landing.profile')}}"
                                                        style="display: block; padding: 8px 20px; color: #031220; text-decoration: none; transition: color 0.3s ease-in-out;"
                                                        onmouseover="this.style.color='#28a745';"
                                                        onmouseout="this.style.color='#031220';">
                                                        Profil
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('landing.vision')}}"
                                                        style="display: block; padding: 8px 20px; color: #031220; text-decoration: none; transition: color 0.3s ease-in-out;"
                                                        onmouseover="this.style.color='#28a745';"
                                                        onmouseout="this.style.color='#031220';">
                                                        Visi dan Misi
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('landing.program')}}"
                                                        style="display: block; padding: 8px 20px; color: #031220; text-decoration: none; transition: color 0.3s ease-in-out;"
                                                        onmouseover="this.style.color='#28a745';"
                                                        onmouseout="this.style.color='#031220';">
                                                        Program
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="position: relative;">
                                            @if ($title == 'PPDB')
                                            <a href="{{route('ppdb')}}"
                                                style="color: #28a745; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;">
                                                PPDB
                                            </a>
                                            @else
                                            <a href="{{route('ppdb')}}"
                                                style="color: #031220; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;"
                                                onmouseover="this.style.color='#28a745';"
                                                onmouseout="this.style.color='#031220';">
                                                PPDB
                                            </a>
                                            @endif
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Search -->
                            <div class="header__search">
                                <form action="#">
                                    <div class="header__search-input" style="padding: 5px 10px; display: flex; align-items: center; width: 200px;">
                                        <input type="text" placeholder="Search..." style="border: none; outline: none; width: 100%; padding: 0 5px;">
                                        <button class="header__search-btn" style="background: none; border: none; cursor: pointer;">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.11117 15.2222C12.0385 15.2222 15.2223 12.0385 15.2223 8.11111C15.2223 4.18375 12.0385 1 8.11117 1C4.18381 1 1.00006 4.18375 1.00006 8.11111C1.00006 12.0385 4.18381 15.2222 8.11117 15.2222Z" stroke="#031220" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M17 17L13.1334 13.1333" stroke="#031220" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Registration Button -->
                            <div class="header__btn">
                                <a href="{{route('auth.register')}}" class="header-btn"
                                    style="display: inline-flex; align-items: center; padding: 8px 15px; background-color: #E47804; color: #fff; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease-in-out;"
                                    onmouseover="this.style.backgroundColor='#FF9800';"
                                    onmouseout="this.style.backgroundColor='#E47804';">
                                    Pendaftaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<header>
    <!-- Top Header (Location) -->
    <div class="header__top" style="background-color: #f0f0f0; color: #031220; padding: 8px 0; border-bottom: 1px solid #dee2e6;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 d-flex justify-content-between">
                    <!-- Location -->
                    <div class="header__top-left">
                    </div>

                    <!-- Social Media -->
                    <div class="header__top-right" style="display: flex; align-items: center; gap: 10px;">
                        <a href="https://www.facebook.com/profile.php?id=61573868848841" style="color: #9AA6B2; text-decoration: none; font-size: 20px; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#9AA6B2';">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="#" style="color: #9AA6B2; text-decoration: none; font-size: 20px; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#9AA6B2';">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://www.instagram.com/pesantrenscis?igsh=ZjI2bWIyaGhubndh" style="color: #9AA6B2; text-decoration: none; font-size: 20px; transition: color 0.3s ease-in-out;"
                            onmouseover="this.style.color='#008000';"
                            onmouseout="this.style.color='#9AA6B2';">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
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
                            <a href="{{ route('landing.home') }}">
                                <img src="{{ asset('assets/img/logo/logo-name.png') }}"
                                    alt="Smart Character Islamic School Logo"
                                    style="max-width: 250%; height: auto; width: clamp(210px, 50%, 300px);">
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
                                            @if ($title == 'Tentang Kami' || $title == 'Profil' || $title == 'Visi dan Misi' || $title == 'Program' || $title == 'FAQ')
                                            <a href="#"
                                                style="color: #28a745; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;">
                                                Tentang Kami
                                            </a>
                                            @else
                                            <a href="#"
                                                style="color: #031220; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;"
                                                onmouseover="this.style.color='#28a745';"
                                                onmouseout="this.style.color='#031220';">
                                                Tentang Kami
                                            </a>
                                            @endif
                                            <ul class="submenu"
                                                style="display: none; position: absolute; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px 0; min-width: 160px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); top: 100%; left: 0;">
                                                <li>
                                                    <a href="{{ route('landing.profile') }}"
                                                        style="display: block; padding: 8px 20px; color: #031220; text-decoration: none; transition: color 0.3s ease-in-out;"
                                                        onmouseover="this.style.color='#28a745';"
                                                        onmouseout="this.style.color='#031220';">
                                                        Profil
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('landing.vision') }}"
                                                        style="display: block; padding: 8px 20px; color: #031220; text-decoration: none; transition: color 0.3s ease-in-out;"
                                                        onmouseover="this.style.color='#28a745';"
                                                        onmouseout="this.style.color='#031220';">
                                                        Visi dan Misi
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('landing.program') }}"
                                                        style="display: block; padding: 8px 20px; color: #031220; text-decoration: none; transition: color 0.3s ease-in-out;"
                                                        onmouseover="this.style.color='#28a745';"
                                                        onmouseout="this.style.color='#031220';">
                                                        Program
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('landing.faq') }}"
                                                        style="display: block; padding: 8px 20px; color: #031220; text-decoration: none; transition: color 0.3s ease-in-out;"
                                                        onmouseover="this.style.color='#28a745';"
                                                        onmouseout="this.style.color='#031220';">
                                                        FAQ
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="position: relative;">
                                            @if ($title == 'PPDB')
                                            <a href="{{ route('ppdb') }}"
                                                style="color: #28a745; text-decoration: none; font-size: 16px; padding: 10px 15px; display: block; transition: color 0.3s ease-in-out;">
                                                PPDB
                                            </a>
                                            @else
                                            <a href="{{ route('ppdb') }}"
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
                            <div class="header__search" style="position: relative;">
                                <form action="{{ route('landing.search') }}" method="GET">
                                    @csrf
                                    <div class="header__search-input" style="padding: 5px 10px; display: flex; align-items: center; width: 200px;">
                                        <input type="text" name="query" id="search-input" placeholder="Search..." style="border: none; outline: none; width: 100%; padding: 0 5px;" autocomplete="off">
                                        <button class="header__search-btn" type="submit" style="background: none; border: none; cursor: pointer;">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.11117 15.2222C12.0385 15.2222 15.2223 12.0385 15.2223 8.11111C15.2223 4.18375 12.0385 1 8.11117 1C4.18381 1 1.00006 4.18375 1.00006 8.11111C1.00006 12.0385 4.18381 15.2222 8.11117 15.2222Z" stroke="#031220" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M17 17L13.1334 13.1333" stroke="#031220" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                                <!-- Suggestion Box -->
                                <div id="search-suggestions" style="display: none; position: absolute; top: 100%; left: 0; width: 200px; background: white; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 1000;">
                                    <ul style="list-style: none; margin: 0; padding: 5px 0;">
                                        <!-- Suggestions will be injected here -->
                                    </ul>
                                </div>
                            </div>

                            <!-- Registration Button -->
                            <div class="header__btn">
                                <a href="{{ route('login') }}" class="header-btn"
                                    style="display: inline-flex; align-items: center; padding: 8px 15px; background-color: #E47804; color: #fff; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease-in-out;"
                                    onmouseover="this.style.backgroundColor='#FF9800';"
                                    onmouseout="this.style.backgroundColor='#E47804';">
                                    Login
                                </a>
                                <a href="{{ route('login') }}" class="header-btn"
                                    style="display: inline-flex; align-items: center; padding: 8px 15px; background-color: #1E88E5; color: #fff; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease-in-out;"
                                    onmouseover="this.style.backgroundColor='#42A5F5';"
                                    onmouseout="this.style.backgroundColor='#1E88E5';">
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

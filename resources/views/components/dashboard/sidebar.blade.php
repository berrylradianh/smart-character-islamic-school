<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-accelerator"></i><span> Dashboard <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li><a href="{{route('dashboard.stats')}}">Setting Dashboard</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-spread"></i><span> Content <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('dashboard.hero')}}">Hero</a></li>
                        <li><a href="{{route('dashboard.news')}}">Berita</a></li>
                        <li><a href="{{route('dashboard.agenda')}}">Agenda</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-todolist"></i><span> PPDB <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('dashboard.ppdb_info')}}">Informasi</a></li>
                        <li><a href="{{route('dashboard.requirement_information')}}">Setting Informasi</a></li>
                        <li><a href="{{route('dashboard.ppdb_timeline')}}">Timeline</a></li>
                        <li><a href="{{route('dashboard.requirement_timeline')}}">Setting Timeline</a></li>
                        <li><a href="{{route('dashboard.ppdb_faq')}}">FAQs</a></li>
                        <li><a href="{{route('dashboard.requirement_faq')}}">Setting FAQs</a></li>
                        <li><a href="{{route('dashboard.ppdb_pendaftaran')}}">Pendaftaran</a></li>
                        <li><a href="{{route('dashboard.list_pendaftar')}}">List Pendaftar</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('dashboard.users.index')}}" class="waves-effect"><i class="icon-profile"></i><span> User Management </span></a>
                </li>

                <li>
                    <a href="{{route('dashboard.roles.index')}}" class="waves-effect"><i class="icon-setting-2"></i><span> Role Management </span></a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

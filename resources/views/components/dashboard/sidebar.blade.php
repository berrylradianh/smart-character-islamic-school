<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    @if ($title == 'Dashboard Admin')
                    <a href="{{route('admin.index')}}" class="waves-effect active">
                        <i class="icon-accelerator" style="color: white;"></i> <span style="color: white;"> Dashboard </span>
                    </a>
                    @else
                    <a href="{{route('admin.index')}}" class="waves-effect">
                        <i class="icon-accelerator"></i> <span> Dashboard </span>
                    </a>
                    @endif
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-spread"></i><span> Content <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.hero')}}">Hero</a></li>
                        <li><a href="{{route('admin.news')}}">Berita</a></li>
                        <li><a href="{{route('admin.agenda')}}">Agenda</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-todolist"></i><span> PPDB <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.ppdb_info')}}">Informasi</a></li>
                        <li><a href="{{route('admin.ppdb_timeline')}}">Timeline</a></li>
                        <li><a href="{{route('admin.ppdb_faq')}}">FAQs</a></li>
                        <li><a href="{{route('admin.ppdb_pendaftaran')}}">Pendaftaran</a></li>
                        <li><a href="{{route('admin.list_pendaftar')}}">List Pendaftar</a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div>

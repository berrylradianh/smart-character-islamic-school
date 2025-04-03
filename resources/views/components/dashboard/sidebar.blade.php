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
                        <li><a href="{{route('admin.introduction')}}">Perkenalan</a></li>
                        <li><a href="#">Program</a></li>
                        <li><a href="#">Berita</a></li>
                        <li><a href="#">Agenda</a></li>
                        <li><a href="#">Testimoni</a></li>
                        <li><a href="#">Media</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="waves-effect"><i class="icon-todolist"></i><span> PPDB </span></a>
                </li>

            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div>

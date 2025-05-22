@php
use Illuminate\Support\Facades\Auth;
@endphp

<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                @if (Auth::user()->role && in_array(Auth::user()->role->name, ['Admin', 'Superadmin']))
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-accelerator"></i><span> Dashboard <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li><a href="{{route('dashboard.stats')}}">Setting Dashboard</a></li>
                    </ul>
                </li>
                @else
                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect"><i class="icon-accelerator"></i><span> Dashboard </span></a>
                </li>
                @endif

                @if (Auth::user()->role && in_array(Auth::user()->role->name, ['Admin', 'Superadmin']))
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-spread"></i><span> Content <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('dashboard.hero')}}">Hero</a></li>
                        <li><a href="{{route('dashboard.news')}}">Berita</a></li>
                        <li><a href="{{route('dashboard.agenda')}}">Agenda</a></li>
                        <li><a href="{{route('dashboard.introduction')}}">Perkenalan</a></li>
                        <li><a href="{{route('dashboard.values')}}">Prinsip</a></li>
                        <li><a href="{{route('dashboard.programs')}}">Program Unggulan</a></li>
                        <li><a href="{{route('dashboard.testimonials')}}">Testimoni</a></li>
                        <li><a href="{{route('dashboard.media')}}">Media</a></li>
                        <li><a href="{{route('dashboard.profile')}}">Profil</a></li>
                        <li><a href="{{route('dashboard.vision')}}">Visi dan Misi</a></li>
                        <li><a href="{{route('dashboard.ppdb')}}">PPDB</a></li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->role && in_array(Auth::user()->role->name, ['Admin', 'Superadmin']))
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-todolist"></i><span> PPDB <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">

                        <li><a href="{{route('dashboard.list_pendaftar')}}">List Pendaftar</a></li>
                    </ul>
                </li>
                @else
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-todolist"></i><span> PPDB <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('dashboard.ppdb_pendaftaran')}}">Pendaftaran</a></li>
                        <li><a href="{{route('dashboard.ppdb_pengumuman')}}">Pengumuman</a></li>
                    </ul>
                </li>
                @endif

                @if (Auth::user()->role && in_array(Auth::user()->role->name, ['Superadmin']))
                <li>
                    <a href="{{route('dashboard.users.index')}}" class="waves-effect"><i class="icon-profile"></i><span> User Management </span></a>
                </li>

                <li>
                    <a href="{{route('dashboard.roles.index')}}" class="waves-effect"><i class="icon-setting-2"></i><span> Role Management </span></a>
                </li>
                @endif

            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

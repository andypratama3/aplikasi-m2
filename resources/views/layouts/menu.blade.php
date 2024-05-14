@role(['admin','super-admin'])
<li class="{{ Request::is('home') ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><i class="fa fa-home"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Home</span></a>
</li>
@endrole


<li class="{{ Request::is('profil*') ? 'active' : '' }}">
    <a href="{!! route('profil') !!}"><i class="fa fa-user"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Profil</span></a>
</li>


<!-- @canany(['agenda.index','people.index','jabatans.index','pendidikans.index','bidangs.index','pangkatGolongans.index'])
<li class="navigation-header">
    <span data-i18n="nav.category.layouts">--Mater Data</span>
    <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
</li>
    @can('people.index')
        <li class="{{ Request::is('people*') ? 'active' : '' }}">
            <a href="{{ route('people.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Person</span></a>
        </li>
    @endcan

    @can('jabatans.index')
        <li class="{{ Request::is('jabatans*') ? 'active' : '' }}">
            <a href="{{ route('jabatans.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Jabatan</span></a>
        </li>
    @endcan

    @can('pendidikans.index')
        <li class="{{ Request::is('pendidikans*') ? 'active' : '' }}">
            <a href="{{ route('pendidikans.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Pendidikan</span></a>
        </li>
    @endcan

    @can('bidangs.index')
        <li class="{{ Request::is('bidangs*') ? 'active' : '' }}">
            <a href="{{ route('bidangs.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Bidang</span></a>
        </li>
    @endcan

    @can('pangkatGolongans.index')
        <li class="{{ Request::is('pangkatGolongans*') ? 'active' : '' }}">
            <a href="{{ route('pangkatGolongans.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Pangkat/Golongan</span></a>
        </li>
    @endcan
@endcanany

@canany(['agenda.index','posts.index','pages.index','galeris.index','kegiatans.index'])
<li class="navigation-header">
    <span data-i18n="nav.category.layouts">--Website</span>
    <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
</li>
    @can('posts.index')
        <li class="{{ Request::is('posts*') ? 'active' : '' }}">
            <a href="{{ route('posts.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Post</span></a>
        </li>
    @endcan

    @can('pages.index')
        <li class="{{ Request::is('pages*') ? 'active' : '' }}">
            <a href="{{ route('pages.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Page</span></a>
        </li>
    @endcan


    @can('pageCategories.index')
        <li class="{{ Request::is('pageCategories*') ? 'active' : '' }}">
            <a href="{{ route('pageCategories.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Page Category</span></a>
        </li>
    @endcan

    @can('postCategories.index')
        <li class="{{ Request::is('postCategories*') ? 'active' : '' }}">
            <a href="{{ route('postCategories.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Post Category</span></a>
        </li>
    @endcan

    @can('agendaCategories.index')
        <li class="{{ Request::is('agendaCategories*') ? 'active' : '' }}">
            <a href="{{ route('agendaCategories.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Agenda Category</span></a>
        </li>
    @endcan

    @can('agendas.index')
        <li class="{{ Request::is('agendas*') ? 'active' : '' }}">
            <a href="{{ route('agendas.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Agenda</span></a>
        </li>
    @endcan

    @can('galeris.index')
        <li class="{{ Request::is('galeris*') ? 'active' : '' }}">
            <a href="{{ route('galeris.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Galeri</span></a>
        </li>
    @endcan

    @can('kegiatans.index')
        <li class="{{ Request::is('kegiatans*') ? 'active' : '' }}">
            <a href="{{ route('kegiatans.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Kegiatan</span></a>
        </li>
    @endcan
@endcanany -->

@canany(['users.index','roles.index','permissions.index'])
<li class="navigation-header">
    <span data-i18n="nav.category.layouts">--Pengaturan</span>
    <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
</li>
<li class="nav-item"><a href="#"><i class="fa fa-users"></i><span class="menu-title font-small-4 black" data-i18n="nav.dash.main">Pengaturan User</span></a>
    <ul class="menu-content">
        @can('users.index')
           <li class="{{ Request::is('users*') ? 'active' : '' }}">
               <a href="{!! route('users.index') !!}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Akun Pengguna</span></a>
           </li>
        @endcan

        @can('permissions.index')
            <li class="{{ Request::is('permissions*') ? 'active' : '' }}">
                <a href="{{ route('permissions.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Permissions</span></a>
            </li>
        @endcan

        @can('roles.index')
            <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Roles</span></a>
            </li>
        @endcan

    </ul>
</li>
@endcanany

@canany(['pendaftaranMutasiStatuses.index','statuses.index','pangkats.index','perangkatDaerahs.index'])

<li class="nav-item"><a href="#"><i class="fa fa-users"></i><span class="menu-title font-small-4 black" data-i18n="nav.dash.main">Master Data</span></a>
    <ul class="menu-content">
        @can('pendaftaranMutasiStatuses.index')
        <li class="{{ Request::is('pendaftaranMutasiStatuses*') ? 'active' : '' }}">
            <a href="{{ route('pendaftaranMutasiStatuses.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Pendaftaran Mutasi Status</span></a>
        </li>
        @endcan

        @can('statuses.index')
        <li class="{{ Request::is('statuses*') ? 'active' : '' }}">
            <a href="{{ route('statuses.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Status</span></a>
        </li>
        @endcan

        @can('pangkats.index')
        <li class="{{ Request::is('pangkats*') ? 'active' : '' }}">
            <a href="{{ route('pangkats.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Pangkat</span></a>
        </li>
        @endcan

        @can('perangkatDaerahs.index')
        <li class="{{ Request::is('perangkatDaerahs*') ? 'active' : '' }}">
            <a href="{{ route('perangkatDaerahs.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Perangkat Daerah</span></a>
        </li>
        @endcan

        @can('pangkatGolongans.index')
        <li class="{{ Request::is('pangkatGolongans*') ? 'active' : '' }}">
            <a href="{{ route('pangkatGolongans.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Pangkat Golongan</span></a>
        </li>
        @endcan

    </ul>
</li>
@endcanany

<li class="navigation-header">
    <span data-i18n="nav.category.layouts">Mutasi</span>
    <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
</li>

@can('pendaftaranMutasis.index')
    <li class="{{ Request::is('pendaftaranMutasis*') && !Request::is('pendaftaranMutasis/keputusanMutasi*') ? 'active' : '' }}">
        <a href="{{ route('pendaftaranMutasis.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Pendaftaran Mutasi</span></a>
    </li>
    @role(['admin','super-admin'])
    <li class="{{ Request::is('pendaftaranMutasis/keputusanMutasi*') ? 'active' : '' }}">
        <a href="{{ route('pendaftaranMutasis.keputusanMutasi') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Mutasi Disetujui/Ditolak</span></a>
    </li>
    @endrole
@endcan

@role(['admin','super-admin'])
<li class="navigation-header">
    <span data-i18n="nav.category.layouts">Lainya</span>
    <i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
</li>
@endrole

@can('pegawais.index')
    <li class="{{ Request::is('pegawais*') ? 'active' : '' }}">
        <a href="{{ route('pegawais.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Pegawai</span></a>
    </li>
@endcan

@can('linkSks.index')
    @role(['admin','super-admin'])
        <li class="{{ Request::is('linkSks*') ? 'active' : '' }}">
            <a href="{{ route('linkSks.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Link SK / Berkas</span></a>
        </li>
    @else
      @if (Auth::user()->getLatestLinkSk())
          <li class="{{ Request::is('linkSks*') ? 'active' : '' }}">
              <a href="{{ Auth::user()->getLatestLinkSk() }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Link SK / Berkas</span></a>
          </li>
      @endif
    @endrole
@endcan

@can('sarans.index')
<li class="{{ Request::is('sarans*') ? 'active' : '' }}">
    <a href="{{ route('sarans.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">Kritik & Saran</span></a>
</li>
@endcan

@can('slideSops.index')
<li class="{{ Request::is('slideSops*') ? 'active' : '' }}">
    <a href="{{ route('slideSops.index') }}"><i class="icon-circle-right"></i><span data-i18n="nav.form_layouts.form_layout_basic" class="menu-title">SOP</span></a>
</li>
@endcan

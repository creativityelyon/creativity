@if(Auth::guard('web')->check())
<li class="side-menus {{ Request::is('/home') ? 'active' : '' }}">
  <a class="nav-link" href="/home">
    <i class=" fas fa-building"></i><span>Dashboard</span>
  </a>
</li>

<li class="side-menus {{ Request::is('survey/kesehatan') ? 'active' : '' }}">
  <a class="nav-link" href="/survey/kesehatan">
    <i class="fas fa-asterisk"></i><span>Survey Kesehatan</span>
  </a>
</li>

@if(Auth::user()->id_level = 12 || Auth::user()->id_level = 13)
<!-- <li class="side-menus {{ Request::is('lomba') ? 'active' : '' }}">
  <a class="nav-link" href="/lomba">
    <i class="fas fa-bahai"></i><span>Registrasi Lomba</span>
  </a>
</li> -->
@endif
<li class="side-menus {{ Request::is('jajak/pendapat') ? 'active' : '' }}">
  <a class="nav-link" href="/jajak/pendapat">
    <i class="fas fa-bahai"></i><span>Jajak Pendapat</span>
  </a>
</li>

<li class="side-menus {{ Request::is('check_fit') ? 'active' : '' }}">
  <a class="nav-link" href="/check_fit">
    <i class="fas fa-cloud"></i><span>Check Fit</span>
  </a>
</li>


<li class="side-menus {{ Request::is('daily_fit') ? 'active' : '' }}">
  <a class="nav-link" href="/daily_fit">
    <i class="fas fa-heartbeat"></i><span>Daily Fit</span>
  </a>
</li>


@endif


@if(Auth::guard('teacher')->check())

<li class="side-menus {{ Request::is('teacher') ? 'active' : '' }}">
  <a class="nav-link" href="/teacher">
    <i class=" fas fa-building"></i><span>Dashboard</span>
  </a>
</li>

<li class="side-menus {{ Request::is('kesehatan/guru') ? 'active' : '' }}">
  <a class="nav-link" href="/kesehatan/guru">
    <i class="fas fa-atom"></i><span>Kesehatan Guru</span>
  </a>
</li>

<li class="side-menus {{ Request::is('list/siswa') ? 'active' : '' }}">
  <a class="nav-link" href="/list/siswa">
    <i class=" fas fa-building"></i><span>List Siswa</span>
  </a>
</li>

<li class="side-menus {{ Request::is('/bukutamu') ? 'active' : '' }}">
  <a class="nav-link" href="/bukutamu">
    <i class=" fas fa-building"></i><span>Buku Tamu</span>
  </a>
</li>

{{-- yang di rubah ini ya  --}}
<li class="side-menus {{ Request::is('corpus/indexsetting') ? 'active' : '' }}">
    <a class="nav-link" href="/corpus/indexsetting">
      <i class="fas fa-cog"></i><span>Setting Tanda Tangan Rapot</span>
    </a>
  </li>
{{-- ending yang dirubah --}}

<li class="dropdown">
  <a href="#" class="nav-link has-dropdown  {{ Request::is('/report*') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Report</span></a>
  <ul class="dropdown-menu">
    <li class="side-menus {{ Request::is('/report/kesehatan') ? 'active' : '' }}">
      <a class="nav-link" href="/report/kesehatan">
        <i class=" fas fa-building"></i><span>Report Kesehatan</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/report/jajak') ? 'active' : '' }}">
      <a class="nav-link" href="/report/jajak">
        <i class=" fas fa-building"></i><span>Report Jajak</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/report/pernyataan') ? 'active' : '' }}">
      <a class="nav-link" href="/report/pernyataan">
        <i class=" fas fa-building"></i><span>Report Pernyataan</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/report/lomba') ? 'active' : '' }}">
      <a class="nav-link" href="/report/lomba">
        <i class=" fas fa-building"></i><span>Report Lomba</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/report/test') ? 'active' : '' }}">
      <a class="nav-link" href="/report/test">
        <i class=" fas fa-building"></i><span>Report Test Fisik</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/report/daily/corpus') ? 'active' : '' }}">
      <a class="nav-link" href="/report/daily/corpus">
        <i class=" fas fa-building"></i><span> Daily Corpus Student</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/report/daily/staff/corpus') ? 'active' : '' }}">
      <a class="nav-link" href="/report/daily/staff/corpus">
        <i class=" fas fa-building"></i><span> Daily Corpus Staff</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/persenDaily') ? 'active' : '' }}">
      <a class="nav-link" href="/persenDaily">
        <i class=" fas fa-building"></i><span> % Daily Student</span>
      </a>
    </li>

  </ul>
</li>

@if(!empty(auth()->user()->id))
@if(Auth::user()->admin_level == 1 ||  in_array(auth()->user()->id, [160,68,43,249,136, 100001]))
<li class="dropdown">
  <a href="#" class="nav-link has-dropdown {{ Request::is('/master*') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master</span></a>
  <ul class="dropdown-menu">

    <li class="side-menus {{ Request::is('/fit_time*') ? 'active' : '' }}">
      <a class="nav-link" href="/fit_time">
        <i class=" fas fa-building"></i><span>Master Fit Time</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/fit_video*') ? 'active' : '' }}">
      <a class="nav-link" href="/fit_video">
        <i class=" fas fa-building"></i><span>Master Video</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/fit_time/staff*') ? 'active' : '' }}">
      <a class="nav-link" href="/fit_time/staff">
        <i class=" fas fa-building"></i><span>Fit Time Staff</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/fit_video/staff*') ? 'active' : '' }}">
      <a class="nav-link" href="/fit_video/staff">
        <i class=" fas fa-building"></i><span>Video Staff</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/semester*') ? 'active' : '' }}">
      <a class="nav-link" href="/semester">
        <i class=" fas fa-building"></i><span>Master Semester</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/project_tipe*') ? 'active' : '' }}">
      <a class="nav-link" href="/project_tipe">
        <i class=" fas fa-building"></i><span>Master Course Type</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/role*') ? 'active' : '' }}">
      <a class="nav-link" href="/role">
        <i class=" fas fa-building"></i><span>Master Role</span>
      </a>
    </li>

  </ul>
</li>
@endif
@endif

<!-- tadi di tutup ini -->

 <li class="side-menus {{ Request::is('/periode/survey*') ? 'active' : '' }}">
  <a class="nav-link" href="/periode/survey">
    <i class=" fas fa-building"></i><span>Periode Survey</span>
  </a>
</li>


 <li class="dropdown">
  <a href="#" class="nav-link has-dropdown {{ Request::is('/Test*') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Export Test</span></a>
  <ul class="dropdown-menu">

    <li class="side-menus {{ Request::is('/export/test*') ? 'active' : '' }}">
      <a class="nav-link" href="/export/test">
        <i class=" fas fa-building"></i><span>Export Hasil Test</span>
      </a>
    </li>

    <li class="side-menus {{ Request::is('/manual/test*') ? 'active' : '' }}">
      <a class="nav-link" href="/manual/test">
        <i class=" fas fa-building"></i><span>Input Hasil Test</span>
      </a>
    </li>

  </ul>
</li>
<!-- akhir ditutup -->
@if(!empty(auth()->user()->id))
@if(Auth::user()->admin_level == 1 || in_array(auth()->user()->id, [160,68,43,249,136,96,   100001]))


<li class="side-menus {{ Request::is('/final/report*') ? 'active' : '' }}">
  <a class="nav-link" href="/final/report">
    <i class=" fas fa-building"></i><span>Final Report Student</span>
  </a>
</li>

<li class="side-menus {{ Request::is('/staff/final/report*') ? 'active' : '' }}">
  <a class="nav-link" href="/staff/final/report">
    <i class=" fas fa-envelope"></i><span>Final Report Staff</span>
  </a>
</li>
@endif
@endif

<li class="side-menus {{ Request::is('fit_staff*') ? 'active' : '' }}">
  <a class="nav-link" href="/fit_staff">
    <i class="fas fa-plane"></i><span>Check Fit Staff</span>
  </a>
</li>

<li class="side-menus {{ Request::is('daily_fit/staff') ? 'active' : '' }}">
  <a class="nav-link" href="/daily_fit/staff">
    <i class="fas fa-heartbeat"></i><span>Daily Fit Staff</span>
  </a>
</li>



<li class="dropdown">
  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-heartbeat"></i> <span>Creativity</span></a>
  <ul class="dropdown-menu">

  <li class="side-menus {{ Request::is('rubrick/creativity') ? 'active' : '' }}">
    <a class="nav-link" href="/rubrick/creativity">
      <i class="fas fa-heartbeat"></i><span>Creativity Student</span>
    </a>
  </li>

  <li class="side-menus {{ Request::is('rubrick/creativity') ? 'active' : '' }}">
    <a class="nav-link" href="/rubrick/creativity-percent">
      <i class="fas fa-heartbeat"></i><span>Creativity Student %</span>
    </a>
  </li>
</ul>
</li>

<li class="dropdown">
  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-heartbeat"></i> <span>Creativity Teacher</span></a>
  <ul class="dropdown-menu">

  <li class="side-menus {{ Request::is('rubrick/creativity_teacher') ? 'active' : '' }}">
    <a class="nav-link" href="/rubrick/creativity_teacher">
      <i class="fas fa-heartbeat"></i><span>Creativity Teacher</span>
    </a>
  </li>

  <li class="side-menus {{ Request::is('rubrick/creativity_teacher') ? 'active' : '' }}">
    <a class="nav-link" href="/rubrick/creativity_teacher-percent">
      <i class="fas fa-heartbeat"></i><span>Creativity Teacher %</span>
    </a>
  </li>
</ul>
</li>


@endif

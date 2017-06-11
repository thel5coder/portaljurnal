<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('public/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            @if(auth()->user()->user_level == 'penulis')
                <li><a href="#/dashboard"><i class='glyphicon glyphicon-home'></i> <span>Home</span></a></li>
                <li><a href="#/pendaftaran"><i class='fa fa-folder'></i> <span>Pendaftaran</span></a></li>
                <li><a href="#"><i class='fa fa-folder'></i> <span>My Jurnal</span></a></li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-folder'></i> <span>Jurnal Revisi</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#">Revisi TR</a></li>
                        <li><a href="#">Revisi MB</a></li>
                    </ul>
                </li>
                <li><a href="#profile"><i class='fa fa-folder'></i> <span>Profile</span></a></li>
            @elseif(auth()->user()->user_level == 'tim redaksi')
                <li><a href="#/dashboard"><i class='glyphicon glyphicon-home'></i> <span>Home</span></a></li>
                <li><a href="#/pendaftaran"><i class='fa fa-folder'></i> <span>Pendaftaran</span></a></li>
                <li><a href="#/jurnalusulan"><i class='fa fa-folder'></i> <span>Jurnal Usulan</span></a></li>
                <li><a href="#/blindreview"><i class='fa fa-folder'></i> <span>Blind Review</span></a></li>
                <li><a href="#/rekapitulasi"><i class='fa fa-folder'></i> <span>Rekapitulasi</span></a></li>
                <li><a href="#/profile"><i class='fa fa-folder'></i> <span>Profile</span></a></li>
            @elseif(auth()->user()->user_level == 'mitra bestari')
                <li><a href="#/dashboard"><i class='glyphicon glyphicon-home'></i> <span>Home</span></a></li>
                <li><a href="#/jurnalusulan"><i class='fa fa-folder'></i> <span>Jurnal Usulan</span></a></li>
                <li><a href="#/review"><i class='fa fa-folder'></i> <span>Review</span></a></li>
                <li><a href="#/rekapitulasi"><i class='fa fa-folder'></i> <span>Rekapitulasi</span></a></li>
                <li><a href="#/profile"><i class='fa fa-folder'></i> <span>Profile</span></a></li>
            @else
                <li><a href="#/dashboard"><i class='glyphicon glyphicon-home'></i> <span>Home</span></a></li>
                <li><a href="#/jurnal"><i class='fa fa-folder'></i> <span>Jurnal</span></a></li>
                <li><a href="#/rekapitulasi"><i class='fa fa-folder'></i> <span>Rekapitulasi</span></a></li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-folder'></i> <span>User Management</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#">Admin</a></li>
                        <li><a href="#">Penulis</a></li>
                        <li><a href="#">Tim Redaksi</a></li>
                        <li><a href="#">Mitra Bestari</a></li>
                        <li><a href="#">Visitor</a></li>
                    </ul>
                </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

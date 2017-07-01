<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html ng-app="jurnalApp">
@if(auth()->check())
    @include('partials.htmlheader')


    <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">

    <div class="wrapper">
    @include('partials.mainheader')

    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


        <!-- Main content -->
            <section class="content">
                <ng-view></ng-view>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        @include('partials.controlsidebar')

        @include('partials.footer')

    </div><!-- ./wrapper -->
    @include('partials.scripts')
    </body>
@else
    @include('partials.htmlheader')

    <body class="login-page">
    <ng-view></ng-view>
    @include('partials.scripts')
    </body>
@endif
</html>
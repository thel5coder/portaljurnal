<!-- jQuery 2.1.4 -->
<script src="{{ asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('public/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/waitMe.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/angular.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/angular-cookies.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/angular-route.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/angular-sanitize.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/angular-validate.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var baseUrl = "{{url('/')}}";
</script>

<script src="{{ asset('public/js/base.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/Services/loginServices.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/js/Controllers/loginController.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@yield('customscripts')

var app = angular.module("jurnalApp", [
    "ngRoute",
    "ngCookies",
    "ngValidate",
    "loginController",
    "loginServices",
    "dashboardController",
    "SessionService",
    "OpenJurnalController",
    "OpenJurnalService",
    "KategoriController",
    "KategoriService","PendaftaranJurnalController","JurnalService",
    "MyJurnalPenulisController","ActionTimRedaksiController","BlindReviewService",
    "BlindReviewController","ui.bootstrap"], function ($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

});

app.config(function ($routeProvider, $locationProvider) {

    $routeProvider
        .when('/', {
            templateUrl: 'resources/views/auth/login.html',
            controller: 'authController',
        });

    $routeProvider.when('/auth/register', {
        templateUrl: 'resources/views/auth/register.html',
        controller: 'authController',
    });

    $routeProvider.when('/dashboard', {
        templateUrl: 'resources/views/dashboard/index.html',
        controller: 'dashController',
        authenticated: true
    });

    $routeProvider.when('/pendaftaran', {
        templateUrl: 'resources/views/openjurnal/index.html',
        controller: 'openJurnalController',
        authenticated: true
    });

    $routeProvider.when('/kategori',{
        templateUrl: 'resources/views/kategori/index.html',
        controller: 'kategoriController',
        authenticated: true
    });

    $routeProvider.when('/pendaftaran-jurnal',{
        templateUrl: 'resources/views/pendaftaranjurnal/create.html',
        controller: 'pendaftaranJurnalController',
        authenticated: true
    });

    $routeProvider.when('/my-jurnal',{
        templateUrl: 'resources/views/pendaftaranjurnal/index.html',
        controller: 'myJurnalPenulisController',
        authenticated: true
    });

    $routeProvider.when('/jurnal-usulan',{
        templateUrl: 'resources/views/jurnalusulan/index.html',
        controller:'actionTimRedaksiController',
        authenticated: true
    });

    $routeProvider.when('/revisi-tr',{
        templateUrl: 'resources/views/blindreview/index.html',
        controller: 'blindReviewController',
        authenticated: true
    });

    $routeProvider.otherwise('/');
});

app.run(["$rootScope", "$location", 'sessionFactory',
    function ($rootScope, $location, sessionFactory) {
        $rootScope.$on("$routeChangeSuccess",
            function (event, next, current) {
                if (next.$$route.authenticated) {
                    if (!sessionFactory.get('auth')) {
                        $location.path('/');
                    }
                }

                if (next.$$route.originalPath == '/') {
                    if (sessionFactory.get('auth')) {
                        $location.path('/dashboard');
                    }
                }
            });
    }
]);

function notificationMessage(message, type) {
    toastr.options.positionClass = "toast-top-full-width";
    onclick:null;
    toastr.options.closeButton = true;
    toastr.options.showDuration = "300";
    toastr.options.hideDuration = "1000";
    toastr.options.timeOut = "5000";
    toastr.options.extendedTimeOut = "1000";
    toastr.options.showEasing = "swing";
    toastr.options.hideEasing = "linear";
    toastr.options.showMethod = "slideDown";
    toastr.options.hideMethod = "slideUp";
    toastr[type](message, type);
}

function runWaitMe(renderEffect, effect, text) {
    $(renderEffect).waitMe({
        effect: effect,
        text: text,
        bg: 'rgba(255,255,255,0.7)',
        color: '#000',
        maxSize: '',
        onClose: function () {
        }
    });
}


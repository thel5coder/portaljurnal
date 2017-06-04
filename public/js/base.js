var app = angular.module("jurnalApp", ["loginController","loginServices"], function ($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: true
    });
});


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


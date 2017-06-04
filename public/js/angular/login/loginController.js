angular.module('loginController', [])
    .controller('authController', function ($scope,$http,$window,$location,authFactory) {
    $scope.registerUser = function () {
        runWaitMe('body','roundBounce','Mendaftar...');
        authFactory.register($scope.registerData)
            .success(function (s) {
                if(s.isSuccess){

                }
            })
            .error(function (XMLHttpRequest, textStatus, errorThrow) {
                $('body').waitMe('hide');
                notificationMessage(errorThrow,'error');
            })
    };
});
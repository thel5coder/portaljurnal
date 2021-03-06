angular.module('loginServices', [])
    .factory('authFactory', function ($http,$cookies) {
    return {

        register: function (registerData) {
            return $http({
                url: baseUrl + "/api/registration",
                method: "POST",
                async: false,
                contentType: false,
                processData: false,
                data: registerData
            });
        },

        login: function (loginData) {
            return $http({
                url: baseUrl + "/api/user-login",
                method: "POST",
                async: false,
                contentType: false,
                processData: false,
                data: loginData
            });
        },

        logout: function () {
            return $http({
                url: baseUrl + "/api/user-logout",
                method: "GET",
                async: false,
                contenType: false,
                processData: false
            });
        }
    }

});
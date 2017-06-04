angular.module('loginServices', [])
    .factory('authFactory', function ($http) {
    return {
        register: function (registerData) {
            return $http({
                url: baseUrl + "/auth/register",
                method: "POST",
                async: false,
                contentType: false,
                processData: false,
                data: registerData
            });
        },

        login: function (loginData) {
            return $http({
                url: baseUrl + "/auth/login",
                method: "POST",
                async: false,
                contentType: false,
                processData: false,
                data: registerData
            });
        }
    }

});
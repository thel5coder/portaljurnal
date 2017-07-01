angular.module('KategoriService', [])
    .factory('kategoriFactory', function ($http) {
        return {
            kategoriSave: function (kategoriData, state) {
                var apiUrl;

                apiUrl = baseUrl + "/api/kategori/create";
                if (state == 'edit') {
                    apiUrl = baseUrl + "/api/kategori/update";
                }

                return $http({
                    url: apiUrl,
                    method: "POST",
                    async: false,
                    contentType: false,
                    processData: false,
                    data: kategoriData
                });
            },

            kategoriRead: function (id) {
                return $http({
                    url: baseUrl + "/api/kategori/read/" + id,
                    method: "GET",
                    async: false,
                    contentType: false,
                    processData: false,
                });
            },

            kategoriShowAll: function () {
                return $http({
                    url: baseUrl + "/api/kategori/all",
                    method: "GET",
                    async: false,
                    contentType: false,
                    processData: false,
                });
            },

            kategoriDelete: function (id) {
                return $http({
                    url: baseUrl + "/api/kategori/delete/" + id,
                    method: "POST",
                    async: false,
                    contentType: false,
                    processData: false,
                });
            }
        }
    });
angular.module('OpenJurnalService',[])
    .factory('openJurnalFactory',function ($http) {
        return {
            readOpenJurnal:function (id) {
                return $http({
                    url: baseUrl + "/api/open-jurnal/read/"+id,
                    method: "GET",
                    async: false,
                    contentType: false,
                    processData: false
                });
            },
            createOpenJurnal:function (openJurnalData,state) {
                var apiUrl;

                apiUrl = baseUrl + "/api/open-jurnal/create";
                if(state == 'edit'){
                    apiUrl = baseUrl + "/api/open-jurnal/update";
                }

                return $http({
                    url: apiUrl,
                    method: "POST",
                    async: false,
                    contentType: false,
                    processData: false,
                    data: openJurnalData
                });
            },
            deleteOpenJurnal: function (id) {
                return $http({
                    url: baseUrl+"/api/open-jurnal/delete/"+id,
                    method: "POST",
                    async: false,
                    contentType: false,
                    processData: false,
                });
            },
            getAllOpenJurnal:function () {
                return $http({
                    url: baseUrl + "/api/open-jurnal/all",
                    method: "GET",
                    async: false,
                    contentType: false,
                    processData: false
                });
            },
            getDefaultOpenJurnal:function () {
                return $http({
                    url: baseUrl + "/api/open-jurnal/get-default",
                    method: "GET",
                    async: false,
                    contentType: false,
                    processData: false
                });
            }
        }
    });

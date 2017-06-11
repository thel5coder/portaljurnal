angular.module('OpenJurnalService',[])
    .factory('openJurnalFactory',function ($http) {
        return {
            readOpenJurnal:function (id) {
                return $http({
                    url: baseUrl + "/api/open-jurnal/"+id,
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
            }
        }
    });

angular.module('JurnalService', [])
    .factory('jurnalFactory', function ($http) {
        return {
            saveJurnal: function (data) {
                console.log($('#jurnalFile').prop('files')[0]);
                var newFormData = new FormData();
                newFormData.append('fileJurnal',$('#jurnalFile').prop('files')[0]);
                return $http({
                    url: baseUrl + "/api/jurnal/create",
                    method: "POST",
                    headers: { 'Content-Type': undefined},
                    transformRequest: angular.identity,
                    data: newFormData
                });
            },
            getDataJurnal:function (id) {
                return $http({
                    url: baseUrl + "/api/jurnal/read/" + id,
                    method: "GET",
                    async: false,
                    contentType: false,
                    processData: false,
                });
            },
            getDataPenulisJurnal:function (id) {
                return $http({
                    url: baseUrl + "/api/penulis-jurnal/read/" + id,
                    method: "GET",
                    async: false,
                    contentType: false,
                    processData: false,
                });
            },
            deleteMyJurnal:function (id) {
                return $http({
                    url: baseUrl + "/api/jurnal/delete/"+id,
                    method: "POST",
                    async: false,
                    contentType: false,
                    processData: false,
                });
            }
        }
    });


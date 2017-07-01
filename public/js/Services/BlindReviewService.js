angular.module('BlindReviewService', [])
    .factory('blindReviewFactory', function ($http) {

        return {
            saveBlindReview:function (blindReviewData) {
                return $http({
                    url: baseUrl + "/api/blind-review/create",
                    method: "POST",
                    async: false,
                    contentType: false,
                    processData: false,
                    data:blindReviewData
                });
            }
        }
    });
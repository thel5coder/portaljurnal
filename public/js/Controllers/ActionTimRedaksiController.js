angular.module('ActionTimRedaksiController',[])
    .controller('actionTimRedaksiController',function ($scope,$location,jurnalFactory,blindReviewFactory) {
        $scope.dataJurnalUsulan = {};
        $scope.namaPenulis = {};
        $scope.blindReview = {};

        $scope.toggleFormBlindReview = function (id) {
            jurnalFactory.getDataJurnal(id)
                .success(function (response) {
                    $scope.dataJurnalUsulan = response;
                    $scope.blindReview.jurnalId = response.id;
                });

            jurnalFactory.getDataPenulisJurnal(id)
                .success(function (response) {
                    $scope.namaPenulis = response.namaPenulis;
                });

            $('#modalFormBlindReview').modal('show');
        };

        $scope.validateBlindReview = {
            errorElement: 'tr', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                isiTulisan1: {
                    required: true
                },
                isiTulisan2: {
                    required: true
                },
                isiTulisan3: {
                    required: true
                },
                isiTulisan4: {
                    required: true
                },
                isiTulisan5: {
                    required: true
                },
                isiTulisan6: {
                    required: true
                },
                isiTulisan7: {
                    required: true
                },
                isiTulisan8: {
                    required: true
                },
                isiTulisan9: {
                    required: true
                },
                isiTulisan10: {
                    required: true
                },
                parafReviewer:{
                    required:true
                }
            },
            messages: {
                isiTulisan1: {
                    required: "Penilaian Isi Tulisan Point 1 Di Perlukan"
                },
                isiTulisan2: {
                    required: "Penilaian Isi Tulisan Point 2 Di Perlukan"
                },
                isiTulisan3: {
                    required: "Penilaian Isi Tulisan Point 3 Di Perlukan"
                },
                isiTulisan4: {
                    required: "Penilaian Isi Tulisan Point 4 Di Perlukan"
                },
                isiTulisan5: {
                    required: "Penilaian Isi Tulisan Point 5 Di Perlukan"
                },
                isiTulisan6: {
                    required: "Penilaian Isi Tulisan Point 6 Di Perlukan"
                },
                isiTulisan7: {
                    required: "Penilaian Isi Tulisan Point 7 Di Perlukan"
                },
                isiTulisan8: {
                    required: "Penilaian Isi Tulisan Point 8 Di Perlukan"
                },
                isiTulisan9: {
                    required: "Penilaian Isi Tulisan Point 9 Di Perlukan"
                },
                isiTulisan10: {
                    required: "Penilaian Isi Tulisan Point 10 Di Perlukan"
                },
                parafReviewer:{
                    required:"Paraf Reviewer tidak boleh kosong"
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('tr').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('tr').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            }
        }
        
        $scope.saveBlindReview = function (form) {
            if(form.validate()){
                runWaitMe('body','roundBounce','Menyimpan hasil blind review...');
                console.log($scope.blindReview);
                blindReviewFactory.saveBlindReview($scope.blindReview)
                    .success(function (s) {
                        $('body').waitMe('hide');
                        if (s.isSuccess) {
                            $('#tblJurnalUsulan').bootgrid('reload');
                            $('#modalFormBlindReview').modal('hide');
                        } else {
                            var errorMessagesCount = s.message.length;
                            for (var i = 0; i < errorMessagesCount; i++) {
                                notificationMessage(s.message[i], 'error');
                            }
                        }
                    })
                    .error(function (XMLHttpRequest, textStatus, errorThrow) {
                        $('body').waitMe('hide');
                        notificationMessage(errorThrow, 'error');
                    });
            }
        }

    });


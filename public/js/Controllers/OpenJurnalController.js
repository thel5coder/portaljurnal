angular.module('OpenJurnalController',[])
    .controller('openJurnalController',function ($scope,$http,$window,openJurnalFactory) {
        $scope.openJurnalValidationOption = {
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                tglBuka: {
                    required: true
                },
                tglTutup: {
                    required: true
                },
                volume: {
                    required: true
                },
                nomor: {
                    required: true
                }
            },

            messages: {
                tglBuka: {
                    required: "Tanggal Buka Harus Di Isi"
                },
                tglTutup: {
                    required: "Tanggal Tutup Harus Di Isi"
                },
                volume: {
                    required: "Volume Harus Di Isi"
                },
                nomor: {
                    required: "Nomor Harus Di Isi"
                }
            },
        };

        $scope.openJurnalCreate = function (form) {
            if(form.validate()){
                runWaitMe('body','roundBounce','Menyimpan...');

                var state = 'new';
                if($scope.modalTitle =='Pendaftaran-Edit'){
                    state = 'edit';
                }

                openJurnalFactory.createOpenJurnal($scope.openJurnalData,state)
                    .success(function (s) {
                        $('body').waitMe('hide');
                        if(s.isSuccess){
                            $('#tblOpenJurnal').bootgrid('reload');
                            $('#openJurnalModal').modal('hide');
                        }else{
                            $('body').waitMe('hide');
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
            };
        };

        $scope.toggleModal = function (state,id) {
            console.log(state);
            switch (state){
                case 'new':
                    $scope.modalTitle = 'Pendaftaran-Tambah';
                    break;
                case 'edit':
                    $scope.modalTitle = 'Pendaftaran-Edit';
                    openJurnalFactory.readOpenJurnal(id)
                        .success(function (response) {
                           $scope.openJurnalData = response;
                            console.log($scope.openJurnalData);
                        })
                        .error(function (XMLHttpRequest, textStatus, errorThrow) {
                            $('body').waitMe('hide');
                            notificationMessage(errorThrow, 'error');
                        });
                    break;
                default:
                    break;
            }
            $('#openJurnalModal').modal('show');
        }

        $scope.openJurnalDelete = function (id) {
            swal({
                title: 'Konfirmasi?',
                text: "Yakin ingin menghapus?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya,Hapus!'
            }).then(function () {
                runWaitMe('body','roundBounce','Menghapus...');
                openJurnalFactory.deleteOpenJurnal(id)
                    .success(function () {
                        $('body').waitMe('hide');
                        $('#tblOpenJurnal').bootgrid('reload');
                    })
                    .error(function (XMLHttpRequest, textStatus, errorThrow) {
                        $('body').waitMe('hide');
                        notificationMessage(errorThrow, 'error');
                    });
            });

        }
    });

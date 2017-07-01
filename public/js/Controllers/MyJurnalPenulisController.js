angular.module('MyJurnalPenulisController', [])
    .controller('myJurnalPenulisController', function ($scope, $location, jurnalFactory, kategoriFactory) {
        $scope.jurnalData = {};
        $scope.namaPenulis = {};
        $scope.kategoriData = {};

        $scope.editJurnal = function (id) {


            $('#modalEditJurnal').modal('show');


            jurnalFactory.getDataPenulisJurnal(id)
                .success(function (response) {
                    $scope.namaPenulis = response;
                })
                .error(function (XMLHttpRequest, textStatus, errorThrow) {
                    notificationMessage(errorThrow, 'error');
                });

            kategoriFactory.kategoriShowAll()
                .success(function (response) {
                    $scope.kategoriData = response;
                })
                .error(function (XMLHttpRequest, textStatus, errorThrow) {
                    notificationMessage(errorThrow, 'error');
                });

            jurnalFactory.getDataJurnal(id)
                .success(function (response) {
                    $scope.jurnalData = response;
                    $scope.selectedKategoriId = {
                        'kategoriId': response.kategoriId,
                        'namaKategori': response.namaKategori
                    }
                })
                .error(function (XMLHttpRequest, textStatus, errorThrow) {
                    notificationMessage(errorThrow, 'error');
                });
        };

        $scope.updateJurnalValidationOptions = {
            errorElement: 'span',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: '',
            rules: {
                volume: {
                    required: true
                },
                judul: {
                    required: true,
                    minlength: 8
                },
                penulis1: {
                    required: true
                },
                abstrak: {
                    required: true
                },
                jurusan: {
                    required: true
                },
                instansi: {
                    required: true
                },
                kategori: {
                    required: true
                },
                jurnalFile: {
                    extension: 'pdf|doc'
                }
            },
            messages: {
                volume: {
                    required: "Pilih volume dahulu"
                },
                judul: {
                    required: "Judul harus di isi",
                    minlength: "Judul minimal terdiri dari 8 karakter"
                },
                penulis1: {
                    required: "Penulis harus di isi"
                },
                abstrak: {
                    required: "Abstrak harus di isi"
                },
                jurusan: {
                    required: "Jurusan harus di isi"
                },
                instansi: {
                    required: "Instansi harus di isi"
                },
                kategori: {
                    required: "Pilih kategori"
                },
                jurnalFile: {
                    extension: "Format file harus PDF"
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            }
        };

        $scope.updateJurnalUsulan = function (form) {
            if(form.validate()){
                runWaitMe('body','roundBounce','Mengupdate...');

                var penulis;
                var fileJurnal;
                var newFormData = new FormData();
                var isSuccess = 0;
                penulis = [];
                var i;
                i = 0;
                $('input[name=penulisJurnal]').each(function () {
                    i++;
                    newFormData.append('penulis' + i, $(this).val());
                    newFormData.append('penulisId'+i,$(this).data('penulis-id'));
                });
                newFormData.append('penulisCount', i);
                newFormData.append('id',$scope.jurnalData.id);
                newFormData.append('openJurnalId', $scope.jurnalData.openJurnalId);
                newFormData.append('judul', $scope.jurnalData.judul);
                newFormData.append('abstrak', $scope.jurnalData.abstrak);
                newFormData.append('kategoriId', $scope.selectedKategoriId.kategoriId);
                newFormData.append('jurusan', $scope.jurnalData.jurusan);
                newFormData.append('instansi', $scope.jurnalData.instansi);
                if(typeof $('#jurnalFile').prop('files')[0] =='undefined'){
                    newFormData.append('fileJurnal', '');
                }else{
                    newFormData.append('fileJurnal', $('#jurnalFile').prop('files')[0]);
                }

                $.ajax({
                    url: baseUrl + "/api/jurnal/update",
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: newFormData,
                    error: function (XMLHttpRequest, textStatus, errorThrow) {
                        $('body').waitMe('hide');
                        notificationMessage(errorThrow, 'error');
                    },
                    success: function (s) {
                        $('body').waitMe('hide');
                        if (s.isSuccess) {
                            notificationMessage('Berhasil mendaftarkan jurnal', 'success');
                            $('#tblMyJurnal').bootgrid('reload');
                        } else {
                            var errorMessagesCount = s.message.length;
                            for (var i = 0; i < errorMessagesCount; i++) {
                                notificationMessage(s.message[i], 'error');
                            }
                        }
                    }
                });
            }
        }

        $scope.deleteMyJurnal = function (id) {
            runWaitMe('body', 'roundBounce', 'Menghapus...');
            jurnalFactory.deleteMyJurnal(id)
                .success(function (s) {
                    $('body').waitMe('hide');
                    if (s.isSuccess) {
                        notificationMessage('Berhasil menghapus','success');
                        $('#tblMyJurnal').bootgrid('reload');
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
                })
        }
    });
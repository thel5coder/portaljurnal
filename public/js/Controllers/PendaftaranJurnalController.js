angular.module('PendaftaranJurnalController', [])
    .controller('pendaftaranJurnalController', function ($scope, $http, $location, jurnalFactory, openJurnalFactory, kategoriFactory) {
        $scope.pendaftaranJurnalData = {};
        $scope.isSuccess = 0;
        openJurnalFactory.getDefaultOpenJurnal()
            .success(function (response) {
                $scope.pendaftaranJurnalData = response;
            });

        kategoriFactory.kategoriShowAll()
            .success(function (response) {
                $scope.kategoriData = response;
            });

        $scope.redirectIfSuccess = function () {
            $location.path('#/');
        };

        $scope.pendaftaranJurnalValidate = {
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
                unikId: {
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
                    required: true,
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
                unikId: {
                    required: "NIDN/NIM harus di isi"
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
                    required: "File jurnal tidak boleh kosong"
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

        $scope.setIsSuccess = function (val) {
            $scope.isSuccess = val;
        }

        $scope.pendaftarnJurnalSave = function (form) {

            if (form.validate()) {
                runWaitMe('body', 'roundBounce', 'Menyimpan...');
                var penulis;
                var fileJurnal;
                var newFormData = new FormData();


                penulis = [];
                var i;
                i = 0;
                $('input[name=penulis]').each(function () {
                    i++;
                    newFormData.append('penulis' + i, $(this).val());
                });
                newFormData.append('penulisCount', i);
                newFormData.append('openJurnalId', $scope.pendaftaranJurnalData.openJurnalId);
                newFormData.append('judul', $scope.pendaftaranJurnalData.judul);
                newFormData.append('abstrak', $scope.pendaftaranJurnalData.abstrak);
                newFormData.append('kategoriId', $scope.pendaftaranJurnalData.kategori.kategoriId);
                newFormData.append('jurusan', $scope.pendaftaranJurnalData.jurusan);
                newFormData.append('instansi', $scope.pendaftaranJurnalData.instansi);
                newFormData.append('fileJurnal', $('#jurnalFile').prop('files')[0]);

                $.ajax({
                    url: baseUrl + "/api/jurnal/create",
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
                            window.location = baseUrl+'#/my-jurnal';
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
    });
angular.module('KategoriController', [])
    .controller('kategoriController', function ($scope, kategoriFactory) {
        $scope.kategoriValidationOption = {
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                namaKategori: {
                    required: true
                }
            },
            messages: {
                namaKategori: {
                    required: "Nama kategori harus di isi!"
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
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
        };

        $scope.saveKategori = function (form) {
            runWaitMe('body', 'roundBounce', 'Menyimpan...');
            if (form.validate()) {
                var state;

                state = 'new';
                if ($scope.kategoriModalTitle == 'Kategori-Edit') {
                    state = 'edit';
                }

                kategoriFactory.kategoriSave($scope.kategoriData, state)
                    .success(function (s) {
                        $('body').waitMe('hide');
                        if (s.isSuccess) {
                            $('#tblKategori').bootgrid('reload');
                            $('#kategoriModal').modal('hide');
                        } else {
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
            }
        };


        $scope.kategoriToggleModal = function (state, id) {
            switch (state) {
                case "new":
                    $scope.kategoriModalTitle = 'Kategori-Tambah';
                    break;
                case "edit":
                    $scope.kategoriModalTitle = 'Kategori-Edit';
                    kategoriFactory.kategoriRead(id)
                        .success(function (response) {
                            $scope.kategoriData = response;
                        });
                    break;
                default:
                    break;
            }
            $('#kategoriModal').modal('show');
        };

        $scope.kategoriDelete = function (id) {
            runWaitMe('body', 'roundBounce', 'Menghapus...');
            kategoriFactory.kategoriDelete(id)
                .success(function (s) {
                    $('body').waitMe('hide');
                    if (s.isSuccess) {
                        $('#tblKategori').bootgrid('reload');
                    } else {
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
    });

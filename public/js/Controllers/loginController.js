angular.module('loginController', [])
    .controller('authController', function ($scope, $http, $window, $location, authFactory) {
        $scope.validationOptions ={
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                unikId: {
                    required: true
                },
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                alamat: {
                    required: true,
                },
                password: {
                    required: true,
                    min: 8
                },
                confirmPassword:{
                    equalTo: '#password'
                }
            },

            messages: {
                unikId: {
                    required: "NIM/NIDN Harus di isi"
                },
                name: {
                    required: "Nama harus di isi",
                },
                email:{
                    required: "Email harus di isi",
                    email: "Masukkan alamat email yang valid"
                },
                alamat:{
                    required: "Alamat harus di isi"
                },
                password:{
                    required:"Password harus di isi",
                    min: "Password minimal 8 karakter"
                },
                confirmPassword: {
                    equalTo: 'Konfirmasi password harus sama dengan password'
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
            },
        };

        $scope.registerUser = function (form) {
            $scope.registerData.userLevel = 'Penulis';
            if($scope.setuju == 1){
                if(form.validate()){
                    runWaitMe('body', 'roundBounce', 'Mendaftar...');
                    authFactory.register($scope.registerData)
                        .success(function (s) {
                            if(s.isSuccess){
                                $('body').waitMe('hide');
                                notificationMessage('Berhasil mendaftar','success');
                                $location.path('#/').$apply();
                            }else{
                                $('body').waitMe('hide');
                                var errorMessagesCount = s.message.length;
                                for (var i = 0; i < errorMessagesCount; i++) {
                                    notificationMessage(s.message[i], 'error');
                                }
                            }
                        })
                        .error(function(XMLHttpRequest, textStatus, errorThrow){
                            $('body').waitMe('hide');
                            notificationMessage(errorThrow, 'error');
                        });
                }
            }else{
                notificationMessage('Centang setuju dahulu sebagai bentuk persetujuan user','info');
            }
        };
    });
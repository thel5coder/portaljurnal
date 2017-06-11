angular.module('SessionService',[])
    .factory('sessionFactory',function ($cookies) {
        return {
            get:function (key) {
                return $cookies.get(key);
            },
            
            set:function (key,val) {
                return $cookies.put(key,val);
            },

            unset:function (key) {
                return $cookies.remove(key);
            }
        }
    });

app.controller('BandsController', function($scope, $http, $filter, $uibModal, API_URL) {
    //Pull band data from API
    getAllBands();

    $scope.showForm = function(action, bandId) {
        $scope.action = action;

        if(bandId !== undefined) {
            getBandById(bandId);
            $scope.bandId = bandId;
        }

        var modalInstance = $uibModal.open({
            templateUrl: 'bandModalTemplate.html',
            controller: BandModalController,
            scope: $scope,
            resolve: {
                bandForm: function() {
                    return $scope.bandForm;
                },
                band: function() {
                    return $scope.band;
                }
            }
        });
    };

    var BandModalController = function($scope, $uibModalInstance, band, bandForm) {
        switch($scope.action) {
            case 'add':
                $scope.formTitle = 'Add New Band';
                $scope.submitButtonLabel = 'Add';
                $scope.submitAction = 'store';
                $scope.band = null;
                break;
            case 'edit':
                $scope.formTitle = 'Edit Band Details';
                $scope.submitButtonLabel = 'Update';
                $scope.submitAction = 'update';
                break;
        }

        $scope.form = {};

        $scope.close = function() {
            $uibModalInstance.close('closed');
        };

        $scope.submitForm = function() {
            if($scope.bandForm.$valid) {
                //form valid
                var url = null;

                switch($scope.submitAction) {
                    case 'store':
                        url = API_URL + 'bands';
                        var method = 'POST';
                        break;
                    case 'update':
                        url = API_URL + 'bands/' + $scope.bandId;
                        method = 'PUT';
                        break;
                }

                $http({
                    method: method,
                    url: url,
                    transformRequest: function(obj) {
                        var str = [];
                        for(var p in obj)
                            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                        return str.join("&");
                    },
                    data: {
                        name: $scope.band.name,
                        start_date: $scope.band.start_date !== undefined ? $scope.band.start_date : '0000-00-00',
                        website: $scope.band.website !== undefined ? $scope.band.website : '',
                        still_active: $scope.band.still_active ? 1 : 0
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function success(response) {
                    getAllBands();
                }, function failure(response) {
                    console.log(response);
                    alert("Sorry, looks like there was an error.");
                });

                $uibModalInstance.close('closed');
            }
        };
    };

    $scope.deleteBand = function(id) {
        var confirmDelete = confirm("Are you sure you want to delete this band?");

        if(confirmDelete) {
            $http.delete(API_URL + 'bands/' + id)
                .then(function success(response) {
                    getAllBands();
                }, function failure(response) {
                    console.log(response);
                    alert("We're having trouble deleting that band.");
                });
        } else {
            return false;
        }
    };

    function getAllBands() {
        $http.get(API_URL + 'bands')
            .then(function success(response) {
                $scope.bands = response.data;
            }, function failure() {
                console.log(response);
            });
    }

    function getBandById(id) {
        $http.get(API_URL + 'bands/' + id)
            .then(function success(response) {
                var band = response.data;
                band.still_active = band.still_active === 1;
                band.start_date = $filter('date')(band.start_date, 'MM/dd/yyyy');

                $scope.band = band;
            }, function failure(response) {
                console.log(response);
            });
    }
});
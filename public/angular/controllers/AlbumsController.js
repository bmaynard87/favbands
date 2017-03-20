app.controller('AlbumsController', function($scope, $http, $uibModal, $filter, API_URL) {
    $scope.bandId = null;

    //Pull band data from API to populate dropdown
    getAllBands();

    //Pull albums data from api to populate table
    getAllAlbums();

    $scope.showForm = function(action, albumId) {
        $scope.action = action;

        if(albumId !== undefined) {
            getAlbumById(albumId);
            $scope.albumId = albumId;
        }

        var modalInstance = $uibModal.open({
            templateUrl: 'albumModalTemplate.html',
            controller: AlbumModalController,
            scope: $scope,
            resolve: {
                albumForm: function() {
                    return $scope.albumForm;
                },
                album: function() {
                    return $scope.album;
                }
            }
        });
    };

    var AlbumModalController = function($scope, $uibModalInstance, album, albumForm) {
        switch($scope.action) {
            case 'add':
                $scope.formTitle = 'Add New Band';
                $scope.bandDropdownDisabled = false;
                $scope.submitButtonLabel = 'Add';
                $scope.submitAction = 'store';
                $scope.album = null;
                break;
            case 'edit':
                $scope.formTitle = 'Edit Band Details';
                $scope.bandDropdownDisabled = true;
                $scope.submitButtonLabel = 'Update';
                $scope.submitAction = 'update';
                break;
        }

        $scope.form = {};

        $scope.close = function() {
            $uibModalInstance.close('closed');
        };

        $scope.submitForm = function() {
            if($scope.albumForm.$valid) {
                //form valid
                var url = null;

                switch($scope.submitAction) {
                    case 'store':
                        url = API_URL + 'albums';
                        var method = 'POST';
                        break;
                    case 'update':
                        url = API_URL + 'albums/' + $scope.albumId;
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
                        band_id: $scope.album.band_id,
                        name: $scope.album.name,
                        recorded_date: $scope.album.recorded_date !== undefined ? $scope.album.recorded_date : '0000-00-00',
                        release_date: $scope.album.release_date !== undefined ? $scope.album.release_date : '0000-00-00',
                        number_of_tracks: $scope.album.number_of_tracks !== undefined ? $scope.album.number_of_tracks : 0,
                        label: $scope.album.label !== undefined ? $scope.album.label : '',
                        producer: $scope.album.producer !== undefined ? $scope.album.producer : '',
                        genre: $scope.album.genre !== undefined ? $scope.album.genre : ''
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function success(response) {
                    getAllAlbums();
                }, function failure(response) {
                    console.log(response);
                    alert("Sorry, looks like there was an error.");
                });

                $uibModalInstance.close('closed');
            }
        };
    };

    $scope.deleteAlbum = function(id) {
        var confirmDelete = confirm("Are you sure you want to delete this album?");

        if(confirmDelete) {
            $http.delete(API_URL + 'albums/' + id)
                .then(function success(response) {
                    getAllAlbums();
                }, function failure(response) {
                    console.log(response);
                    alert("We're having trouble deleting that album.");
                });
        } else {
            return false;
        }
    };

    $scope.getAlbumsByBandId = function() {
        if($scope.bandId === null) {
            getAllAlbums();
            return;
        }

        $http.get(API_URL + 'albums/band/' + $scope.bandId)
            .then(function success(response) {
                $scope.albums = response.data;
            }, function failure(response) {
                console.log(response);
            });
    };

    function getAllBands() {
        $http.get(API_URL + 'bands')
            .then(function success(response) {
                $scope.bands = response.data;
            }, function failure(response) {
                console.log(response);
            });
    }

    function getAllAlbums() {
        $http.get(API_URL + 'albums')
            .then(function success(response) {
                $scope.albums = response.data;
            }, function failure(response) {
                console.log(response);
            });
    }

    function getAlbumById(id) {
        $http.get(API_URL + 'albums/' + id)
            .then(function success(response) {
                var album = response.data;
                album.recorded_date = $filter('date')(album.recorded_date, 'MM/dd/yyyy');
                album.release_date = $filter('date')(album.release_date, 'MM/dd/yyyy');

                $scope.album = album;
            }, function failure(response) {
                console.log(response);
            });
    }

});
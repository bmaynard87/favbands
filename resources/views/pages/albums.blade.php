@extends('layouts.master')
@section('content')
    <h3 class="page-heading">Albums</h3>
    <div class="inner" ng-controller="AlbumsController" ng-cloak>
        <div class="form-group" id="select_band">
            <label for="bands_dropdown" ng-show="bands.length > 0 && albums.length > 0">View by band:
                <select class="form-control"
                        id="bands_dropdown"
                        ng-model="bandId"
                        ng-options="band.id as band.name for band in bands"
                        ng-change="getAlbumsByBandId()">
                    <option></option>
                </select>
            </label>
        </div>
        <table id="albums_table" class="sortable-theme-bootstrap" data-sortable ng-show="albums.length > 0">
            <thead>
                <tr>
                    <th>&num;</th>
                    <th>Name</th>
                    <th data-sortable-type="date">Date Recorded</th>
                    <th data-sortable-type="date">Release Date</th>
                    <th>Number of Tracks</th>
                    <th>Label</th>
                    <th>Producer</th>
                    <th>Genre</th>
                    <th data-sortable="false">
                        <button ng-click="showForm('add')" class="btn btn-sm btn-primary add-item">
                            <span class="glyphicon glyphicon-plus"></span> Add an Album
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="album in albums" ng-cloak>
                    <td>@{{ $index + 1 }}</td>
                    <td><a href="/albums/@{{ album.id }}">@{{ album.name }}</a></td>
                    <td><span>@{{ album.recorded_date | date }}</span></td>
                    <td><span>@{{ album.release_date | date }}</span></td>
                    <td><span ng-show="album.number_of_tracks > 0">@{{ album.number_of_tracks }}</span></td>
                    <td><span>@{{ album.label }}</span></td>
                    <td><span>@{{ album.producer }}</span></td>
                    <td><span>@{{ album.genre }}</span></td>
                    <td>
                        <button ng-click="showForm('edit', album.id, album.band.id)" class="btn btn-sm btn-info edit-item" role="button">
                            <span class="glyphicon glyphicon-edit"></span>
                        </button>
                        <button ng-click="deleteAlbum(album.id)" class="btn btn-sm btn-danger delete-item delete" role="button">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <p ng-cloak ng-show="! albums || albums.length === 0">No albums<span ng-show="! bands || bands.length === 0"> or bands</span> found. <span ng-show="bands.length > 0"><a href="" ng-click="showForm('add')">Click here</a> to add one!</span></p>
        <script type="text/ng-template" id="albumModalTemplate.html">
            <div class="modal-header">
                <button type="button" ng-click="close()" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@{{ formTitle }}</h4>
            </div>
            <div class="modal-body">
                <small><strong>*</strong> indicates required field.</small>
                <form name="albumForm" ng-submit="submitForm(submitAction)" novalidate>
                    <div class="form-group">
                        <label for="bands_dropdown">Band: <strong>*</strong>
                            <select class="form-control" ng-model="album.band_id" required>
                                <option ng-if=" ! bandDropdownDisabled"></option>
                                <option ng-repeat="band in bands" value="@{{ band.id }}" ng-selected="band.id === album.band_id" ng-disabled="bandDropdownDisabled">@{{ band.name }}</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="name">Album Name: <strong>*</strong></label>
                        <input type="text" id="name" class="form-control" name="name" ng-model="album.name" required>
                        <p ng-show="albumForm.name.$invalid && !albumForm.name.$pristine" class="help-block">Name is required.</p>
                    </div>
                    <div class="form-group">
                        <label for="recorded_date">Date Recorded:</label>
                        <input type="text" id="recorded_date" class="form-control" name="recorded_date" ng-model="album.recorded_date" placeholder="mm/dd/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="release_date">Release Date:</label>
                        <input type="text" id="release_date" class="form-control" name="release_date" ng-model="album.release_date" placeholder="mm/dd/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="number_of_tracks">Number of Tracks</label>
                        <input type="number" min="0" id="number_of_tracks" class="form-control" name="number_of_tracks" ng-model="album.number_of_tracks">
                    </div>
                    <div class="form-group">
                        <label for="label">Label:</label>
                        <input type="text" id="label" class="form-control" name="label" ng-model="album.label">
                    </div>
                    <div class="form-group">
                        <label for="producer">Producer:</label>
                        <input type="text" id="producer" class="form-control" name="producer" ng-model="album.producer">
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <input type="text" id="genre" class="form-control" name="genre" ng-model="album.genre">
                    </div>
                    <button type="submit" ng-disabled="albumForm.$invalid" class="btn btn-primary" ng-click="save()">@{{ submitButtonLabel }} Album</button>
                </form>
            </div>
        </script>
    </div>
@endsection
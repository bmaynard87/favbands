@extends('layouts.master')
@section('content')
<h3 class="page-heading">Bands</h3>
<div class="inner" ng-controller="BandsController" ng-cloak>
    <table id="bands_table" class="sortable-theme-bootstrap" data-sortable ng-show="bands.length > 0">
        <thead>
            <tr>
                <th>&num;</th>
                <th>Name</th>
                <th data-sorttable-type="date">Start Date</th>
                <th>Website</th>
                <th>Status</th>
                <th data-sortable="false"><button ng-click="showForm('add')" class="btn btn-sm btn-primary add-item"><span class="glyphicon glyphicon-plus"></span> Add a Band</button></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="band in bands" ng-cloak>
                <td>@{{ $index + 1 }}</td>
                <td><a href="/bands/@{{ band.id }}">@{{ band.name }}</a></td>
                <td data-value=""><span >@{{ band.start_date | date }}</span></td>
                <td><a target="_blank" href="@{{ band.website }}">@{{ band.website }}</a></td>
                <td>@{{ band.still_active ? "Active" : "Inactive" }}</td>
                <td>
                    <button ng-click="showForm('edit', band.id)" class="btn btn-sm btn-info edit-item" role="button">
                        <span class="glyphicon glyphicon-edit"></span>
                    </button>
                    <button ng-click="deleteBand(band.id)" class="btn btn-sm btn-danger delete-item delete" role="button">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <p ng-cloak ng-show="! bands || bands.length === 0">No bands found. <a href="" ng-click="showForm('add')">Click here</a> to add one!</p>
    <script type="text/ng-template" id="bandModalTemplate.html">
        <div class="modal-header">
            <button type="button" ng-click="close()" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@{{ formTitle }}</h4>
        </div>
        <div class="modal-body">
            <small><strong>*</strong> indicates required field.</small>
            <form name="bandForm" ng-submit="submitForm(submitAction)" novalidate>
                <div class="form-group">
                    <label for="name">Band Name: <strong>*</strong></label>
                    <input type="text" id="name" class="form-control" name="name" ng-model="band.name" required>
                    <p ng-show="bandForm.name.$invalid && !bandForm.name.$pristine" class="help-block">Name is required.</p>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date:</label>
                    <input type="text" id="start_date" class="form-control" name="start_date" ng-model="band.start_date" placeholder="mm/dd/yyyy">
                </div>
                <div class="form-group">
                    <label for="website">Website URL</label>
                    <input type="text" id="website" class="form-control" name="website" ng-model="band.website">
                </div>
                <div class="form-group">
                    <label for="still_active">
                        Still Active <input type="checkbox" id="still_active" class="form-checkbox" name="still_active" ng-model="band.still_active">
                    </label>
                </div>
                <button type="submit" ng-disabled="bandForm.$invalid" class="btn btn-primary" ng-click="save()">@{{ submitButtonLabel }} Band</button>
            </form>
        </div>
    </script>
</div>
@endsection
var eventsApp = angular.module('eventsApp', []);
eventsApp.controller('EventListCtrl', function ($scope, $http) {
    $http.get('http://sports.moraspirit.com/backend/fetch.php?type=events').success(function(data) {
        $scope.events = data;
    });
    //$scope.orderProp = 'age';
});
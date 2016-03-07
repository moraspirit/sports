var app = angular.module('myApp', ['ngRoute']);
app.factory("services", ['$http', function($http) {
    var serviceBase = 'services/'
    var obj = {};
    obj.getEvents = function(){
        return $http.get(serviceBase + 'events');
    }
    obj.getEvent = function(eventID){
        return $http.get(serviceBase + 'event?id=' + eventID);
    }

    obj.insertEvent = function (event) {
        return $http.post(serviceBase + 'insertEvent', event).then(function (status) {
            return status;
        });
    };

    obj.updateEvent = function (id,event) {
        return $http.post(serviceBase + 'updateEvent', {id:id, event:event}).then(function (status) {
            return status.data;
        });
    };

    obj.deleteEvent = function (id) {
        return $http.delete(serviceBase + 'deleteEvent?id=' + id).then(function (status) {
            return status.data;
        });
    };

    return obj;
}]);

app.controller('listCtrl', function ($scope, services) {
    services.getEvents().then(function(data){
        $scope.events = data.data;
    });
});

app.controller('editCtrl', function ($scope, $rootScope, $location, $routeParams, services, event) {
    var eventID = ($routeParams.eventID) ? parseInt($routeParams.eventID) : 0;
    $rootScope.title = (eventID > 0) ? 'Edit Event' : 'Add New Event';
    $scope.buttonText = (eventID > 0) ? 'Update Event' : 'Add New Event';
    var original = event.data;
    original._id = eventID;
    $scope.event = angular.copy(original);
    $scope.event._id = eventID;

    $scope.isClean = function() {
        return angular.equals(original, $scope.event);
    }

    $scope.deleteEvent = function(event) {
        if(confirm("Are you sure to delete event number: "+$scope.event._id)==true) {
            services.deleteEvent(event._id);
        }
        $location.path('/');
    };

    $scope.saveEvent = function(event) {
        if (eventID <= 0) {
            services.insertEvent(event);
        }
        else {
            services.updateEvent(eventID, event);
        }
        $location.path('/');
    };
});

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                title: 'Events',
                templateUrl: 'partials/events.html',
                controller: 'listCtrl'
            })
            .when('/edit-event/:eventID', {
                title: 'Edit Events',
                templateUrl: 'partials/edit-event.html',
                controller: 'editCtrl',
                resolve: {
                    event: function(services, $route){
                        var eventID = $route.current.params.eventID;
                        return services.getEvent(eventID);
                    }
                }
            })
            .otherwise({
                redirectTo: '/'
            });
    }]);
app.run(['$location', '$rootScope', function($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);
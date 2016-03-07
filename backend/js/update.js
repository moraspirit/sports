/*
 * @author chathura widanage <chathurawidanage@gmail.com>
 */
var app = angular.module("update", []);

app.controller('updatectrl', ["$http", "$scope", function ($http, $scope) {
        $scope.searchTxt = "";
        $scope.pointsArr = [];
        $scope.visibleArr = [];

        $scope.theChosenOne;

        $http.get("fetch.php?type=points").success(function (data) {
            $scope.pointsArr = data;
            $scope.updateVisibleArray();
        });

        $scope.updateVisibleArray = function () {
            if ($scope.searchTxt.trim() === "") {
                $scope.visibleArr = $scope.pointsArr;
                console.log($scope.searchTxt);
                return;
            }
            $scope.visibleArr = [];
            for (var i = 0, max = $scope.pointsArr.length; i < max; i++) {
                var text = $scope.searchTxt;
                var scoreObj = $scope.pointsArr[i];
                var textParts = text.split(" ");
                var chosen = false;
                if (textParts.length === 1) {
                    if (contains(textParts[0], scoreObj.game_name) ||
                            contains(textParts[0], scoreObj.game_code) ||
                            contains(textParts[0], scoreObj.university_name) ||
                            contains(textParts[0], scoreObj.university_code)) {
                        chosen = true;
                    }
                } else {
                    if ((contains(textParts[1], scoreObj.game_name) ||
                            contains(textParts[1], scoreObj.game_code)) &&
                            (contains(textParts[0], scoreObj.university_name) ||
                                    contains(textParts[0], scoreObj.university_code))) {
                        chosen = true;
                    }
                }



                if (chosen) {
                    $scope.visibleArr.push(scoreObj);
                }
            }

            function contains(what, inWhich) {
                if (inWhich.toString().toLowerCase().indexOf(what) !== -1) {
                    return true;
                }
                return false;
            }


        };

        $scope.updateReq = function (tco) {
            $scope.theChosenOne = tco;
            $('#upd_modal').modal('show');
        };

        $scope.delete = function () {
            var cn = confirm("Do you really need to delete this entry.");
            if (cn === true) {
                $http.get('updatescore.php?id=' + $scope.theChosenOne.id + "&delete=true").success(function (data) {
                    console.log(data);
                    for (var i = 0, max = $scope.pointsArr.length; i < max; i++) {
                        var entry = $scope.pointsArr[i];
                        if (entry.id === $scope.theChosenOne.id) {
                            $scope.pointsArr.splice(i, 1);
                            $scope.updateVisibleArray();
                            $('#upd_modal').modal('hide');
                        }
                    }
                });
            }
        };

        $scope.update = function () {
            var cn = confirm("Do you really need to update this entry.");
            if (cn === true) {
                var newScore = $('#new_score').val();
                $http.get('updatescore.php?id=' + $scope.theChosenOne.id + "&score=" + newScore).success(function (data) {
                    $scope.theChosenOne.score = newScore;
                    $('#upd_modal').modal('hide');
                });
            }
        };
    }]);
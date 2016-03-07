/**
 * Created by chathura widanage on 3/10/15.
 */

var app = angular.module("app", []);
app.run(function($rootScope, $templateCache) {
    $rootScope.$on('$viewContentLoaded', function() {
        $templateCache.removeAll();
    });
});
app.controller("controller", function ($scope, $http) {
    $scope.allGames= [];
    $scope.universities = [];

    $scope.unis = [];
    $scope.selectValue= 0;
    $scope.scores = [];
    $scope.games = [];
    $http.get("http://sports.moraspirit.com/backend/fetch.php?type=alls")
        .success(function(response) {
            $scope.scores = response;
            console.log($scope.scores);

            $http.get("http://sports.moraspirit.com/backend/fetch.php?type=allu")
                .success(function(response) {
                    $scope.unis = response;
                    console.log($scope.unis);

                    $http.get("http://sports.moraspirit.com/backend/fetch.php?type=allg")
                        .success(function(response) {
                            $scope.games = response;
                            console.log($scope.games);

                            process();
                        });
                });
        });








    /*codes = ['MORA',
        'PERA',
        'COL',
        'USJP',
        'KEL',
        'RAJ',
        'UVA',
        'SAB',
        'RUH',
        'WAY',
        'JAF',
        'EST',
        'SEA',
        'VPA'];

    for(i=0;i<codes.length;i++) {
        u1 = new Uni();
        u1.code = codes[i];
        $scope.unis.push(u1);
    }*/

    process = function(){
        allgames= [];

        // O(n^2) ??
        for(i=0; i<$scope.scores.length; i++){
            g= new Game();
            exist= false;

            g.code= $scope.scores[i].game_code;
            g.category= $scope.scores[i].category;
            g.score= 0;
            for(j=0; j<allgames.length; j++){
                if($scope.scores[i].game_code == allgames[j].code && $scope.scores[i].category == allgames[j].category){
                    exist= true;
                }
            }

            for(k=0; k<$scope.games.length; k++){
                if($scope.games[k].game_code == $scope.scores[i].game_code){
                    g.name= $scope.games[k].game_name;
                }
            }


            if(!exist){
                allgames.push(g);
            }



        }

        $scope.allGames = allgames;
        console.log(allgames);




        for(i=0; i<$scope.unis.length; i++){
            u1= new University();
            u1.name= $scope.unis[i].name;
            u1.code= $scope.unis[i].code;
            uniGames = [];
            angular.copy(allgames, uniGames);
            total= 0;

            for(j=0; j<uniGames.length; j++){
                for(k=0; k<$scope.scores.length; k++){
                    if($scope.scores[k].university_code == $scope.unis[i].code && $scope.scores[k].game_code == uniGames[j].code && $scope.scores[k].category == uniGames[j].category){
                        uniGames[j].score = $scope.scores[k].score;
                        total += parseFloat($scope.scores[k].score);
                    }

                }




            }


            u1.games= uniGames;
            u1.total= total;

            $scope.universities.push(u1);
        }



        $scope.universities.sort(function (a, b) {
           return b.total - a.total;
        });

        /*
        * rank universities
        * */
        index=2;
        $scope.universities[0].rank = 1;
        for(i=0; i<$scope.universities.length-1; i++){

            if($scope.universities[i].total == $scope.universities[i+1].total){
                $scope.universities[i+1].rank = $scope.universities[i].rank;
                index++;
            }
            else{
                $scope.universities[i+1].rank= index;
                index++;
            }
        }

        console.log($scope.universities);
    }




    $scope.showPoints= function(){
        console.log($scope.selectValue);
    }

    $scope.getTotal= function (uniName) {
        total= 0;

        for(i=0; i< $scope.universities.length; i++){
            if($scope.universities[i].code == uniName){
                for(j=0; j< $scope.universities[i].games.length; j++){
                    total += parseFloat($scope.universities[i].games[j].score);
                }

            }

        }
        return total;
    }

});


function Uni() {
    var code;
    var name;
}

function University(){
    var name;
    var code;
    var games = [];
    var total;
    var rank;

}

function Game(){
    var name;
    var code;
    var category;
    var score;
}

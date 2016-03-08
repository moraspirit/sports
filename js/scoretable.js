/**
 * Created by sasitha wathmal on 3/10/15.
 * sasithawathmal@gmail.com
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
    $http.get("/sports/backend/fetch.php?type=alls")
        .success(function(response) {
            $scope.scores = response;
            console.log($scope.scores);

            $http.get("/sports/backend/fetch.php?type=allu")
                .success(function(response) {
                    $scope.unis = response;
                    console.log($scope.unis);

                    $http.get("/sports/backend/fetch.php?type=allg")
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

    /*
    * main process function
    * create game Objects for all scores
    * */
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



        /*
        * create uniGames[] to each university and add only games related to
        * matching uni and put it into University.game
        * calculate total, menTotal and womenTotal
        *
        * */
        for(i=0; i<$scope.unis.length; i++){
            u1= new University();
            u1.name= $scope.unis[i].name;
            u1.code= $scope.unis[i].code;
            uniGames = [];
            angular.copy(allgames, uniGames);
            total= 0;
            menTotal= 0;
            womenTotal= 0;

            for(j=0; j<uniGames.length; j++){
                for(k=0; k<$scope.scores.length; k++){
                    if($scope.scores[k].university_code == $scope.unis[i].code && $scope.scores[k].game_code == uniGames[j].code && $scope.scores[k].category == uniGames[j].category){
                        uniGames[j].score = $scope.scores[k].score;
                        total += parseFloat($scope.scores[k].score);

                        if($scope.scores[k].category == "M"){
                            menTotal += parseFloat($scope.scores[k].score);
                        }
                        else{
                            womenTotal += parseFloat($scope.scores[k].score);
                        }
                    }

                }




            }


            u1.games= uniGames;
            u1.total= total;
            u1.menTotal = menTotal;
            u1.womenTotal = womenTotal;

            $scope.universities.push(u1);
        }





        /*
         * rank universities men
         * */
        $scope.universities.sort(function (a, b) {
            return b.menTotal - a.menTotal;
        });

         mindex=2;
        $scope.universities[0].menRank = 1;
        for(i=0; i<$scope.universities.length-1; i++){

            if($scope.universities[i].menTotal == $scope.universities[i+1].menTotal){
                $scope.universities[i+1].menRank = $scope.universities[i].menRank;
                mindex++;
            }
            else{
                $scope.universities[i+1].menRank= mindex;
                mindex++;
            }
        }

        /*
         * rank universities women
         * */

        $scope.universities.sort(function (a, b) {
            return b.womenTotal - a.womenTotal;
        });

        windex=2;
        $scope.universities[0].womenRank = 1;
        for(i=0; i<$scope.universities.length-1; i++){

            if($scope.universities[i].womenTotal == $scope.universities[i+1].womenTotal){
                $scope.universities[i+1].womenRank = $scope.universities[i].womenRank;
                windex++;
            }
            else{
                $scope.universities[i+1].womenRank= windex;
                windex++;
            }
        }

        // sort universities according to total
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
    var menTotal;
    var womenTotal;
    var total;
    var rank;
    var menRank;
    var womenRank;

}

function Game(){
    var name;
    var code;
    var category;
    var score;
}

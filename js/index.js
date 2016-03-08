/**
 * Created by wathmal on 4/5/15.
 */
var app = angular.module('mspApp', []);
app.run(function($rootScope, $templateCache) {
   $rootScope.$on('$viewContentLoaded', function() {
      $templateCache.removeAll();
   });
});

app.controller('scoreCtrl', function($scope, $http) {
    $scope.unis= [];
    $scope.summaries= [];

    uniNames= [];

    $http.get("/sports/backend/fetch.php?type=scr")
        .success(function(response) {
            $scope.scores = response;

            $http.get("/sports/backend/fetch.php?type=allu").success(function(response){
                uniNames= response;
                console.log(uniNames);


                for(i=0; i<uniNames.length; i++){
                    u1= new University();
                    u1.code= uniNames[i].code;
                    u1.name= uniNames[i].name;

                    uniScore =0;
                    for(j=0; j< $scope.scores.length; j++){
                        if(uniNames[i].code== $scope.scores[j].university_code){
                            uniScore= parseFloat($scope.scores[j].score);
                        }

                    }
                    u1.points= uniScore;
                    $scope.unis.push(u1);
                }


                $scope.unis.sort(function (a, b) {
                    return b.points - a.points;
                });

                /*
                 * rank unis
                 * */
                index=2;
                $scope.unis[0].rank = 1;
                for(i=0; i<$scope.unis.length-1; i++){

                    if($scope.unis[i].points == $scope.unis[i+1].points){
                        $scope.unis[i+1].rank = $scope.unis[i].rank;
                        index++;
                    }
                    else{
                        $scope.unis[i+1].rank= index;
                        index++;
                    }
                }
                console.log($scope.unis);


            });


        });

    $http.get("/sports/backend/fetch.php?type=sum").success(function(response){
        $scope.summaries= response;
        console.log($scope.summaries);



    });



    $scope.summary_index= 0;
    /*
     handler for the next button in score summary
     */
    $scope.next= function () {
        if($scope.summary_index >= $scope.summaries.length -1){
            $scope.summary_index= 0;
        }
        else {
            $scope.summary_index++;
        }
    };

    /*
     handler for the back button in score summary
     */
    $scope.back= function () {
        if($scope.summary_index <= 0){
            $scope.summary_index= $scope.summaries.length-1;
        }
        else {
            $scope.summary_index--;
        }
    };
});

function University(){
    var code;
    var name;
    var points;
    var rank;
}
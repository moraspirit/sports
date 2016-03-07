
var streams=[];

//rugger
var g1=new Object();
g1.stream="";
g1.blyve="";
g1.name="volleyball";
streams[0]=g1;

//rowing
var g2=new Object();
g2.stream="";
g2.blyve="";
g2.name="Rugby";
//streams[1]=g2;


//no need to edit the thing below
$(document).ready(function(){
$('.live_menu_item').click(function(){
  var index=$(this).attr('data-index');
  alert(index);
  var comp=streams[index];
  $('#youtube').attr('src',comp.stream);
  if(comp.blyve===undefined){
    $('#BlyveEvent').hide();
  }else{
    $('#BlyveEvent').show();
    $('#BlyveEvent').attr('src',comp.blyve);
  }
});



for(i=0;i<streams.length;i++){
  var html='<div class="row live_menu_item" data-index="'+i+'" onclick="load('+i+')">'+streams[i].name+'</div>';
  $('.live_menu').append(html);
}
$('.live_menu_item')[0].click();
});

function load(i){
  var comp=streams[i];
  $('#youtube').attr('src',comp.stream);
  if(comp.blyve===undefined){
    $('#BlyveEvent').hide();
  }else{
    $('#BlyveEvent').show();
    $('#BlyveEvent').attr('src',comp.blyve);
  }
}

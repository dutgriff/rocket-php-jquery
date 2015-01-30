var currentFlight = 1;

//
//  Handle the Form
//

// Handle Flight changing 
$("#selectFlightNumber").change(function(){
  changeFlight(parseInt($("#selectFlightNumber option:selected").val()));
});

function changeFlight(destination) {
  if(currentFlight < destination) {
    $("#flight-"+currentFlight).hide(400);
    $("#flight-"+(++currentFlight)).show(400, function(){changeFlight(destination)});
  }
  if(currentFlight > destination) {
    $("#flight-"+currentFlight).hide(400);
    $("#flight-"+(--currentFlight)).show(400, function(){changeFlight(destination)});
  }
}

// Handle updating the number of stages
$("#selectNumberOfStages").change(function() {
  renderStageSpecifics(parseInt($(this).val()));
});

function renderStageSpecifics(quantity) {
  for(var i=1; i <= $("#selectNumberOfStages option").length; i++) {
    if(i <= quantity) {
      $(".stage-"+i).show(400);
    } else {
      $(".stage-"+i).hide(400);
    }
  }
}

// Handle updating the number of engines
$(".selectNumberOfEnginesPerStage").change(function() {
  renderEngineSpecifics(parseInt($(this).val()), parseInt(($(this).attr('id')).slice(-1)));
});

function renderEngineSpecifics(quantity, stage) {
  for(var i=1; i <= $("#selectNumberOfEngines-stage-1 option").length; i++) {
    if(i <= quantity) {
      $(".stage-"+stage+" .engine-"+i).show(400);
    } else {
      $(".stage-"+stage+" .engine-"+i).hide(400);
    }
  }
}

//
//  Handle calculations
//

var engineTypeInfo = {
  "1/2A3": {PROPM:1.75 , TBURN:.36 , IMPULSE:1.25 , DELAYM:.2 , CASEM:3.45 },
  "1/2A6": {PROPO:1.56 , TBURN:.2 , IMPULSE:1.25 , DELAYM:.72 , CASEM:12 },
  "A3"   : {PROPM:3.5 , TBURN:.86 , IMPULSE:2.5 , DELAYM:.28 , CASEM:3 },
  "A8"   : {PROPM:3.12 , TBURN:.32 , IMPULSE:2.5 , DELAYM:.69 , CASEM:11 },
  "A10"  : {PROPM:3.78 , TBURN:.26 , IMPULSE:2.5 , DELAYM:.37 , CASEM:3 },
  "B4"   : {PROPM:8.33 , TBURN:1.2 , IMPULSE:5 , DELAYM:.60 , CASEM:10.27 },
  "B6"   : {PROPM:6.24 , TBURN:.83 , IMPULSE:5 , DELAYM:.40 , CASEM:12.26 },
  "C6"   : {PROPM:12.48 , TBURN:1.7 , IMPULSE:10 , DELAYM:.45 , CASEM:11.07 },
  "D12"  : {PROPM:24.93 , TBURN:1.7 , IMPULSE:20 , DELAYM:.45 , CASEM:15.92 },
  "E15"  : {PROPM:35.5 , TBURN:2.6 , IMPULSE:32 , DELAYM:.35 , CASEM:19.7 },
};

function sinh(x){
  return (Math.exp(x) - Math.exp(-x)) / 2;
}
function cosh(x){
  return (Math.exp(x) + Math.exp(-x)) / 2;
}
function tanh(x){
  return (Math.exp(x) - Math.exp(-x)) / (Math.exp(x) + Math.exp(-x));
}

$("button").click(function(e){
  e.preventDefault();
  
  numberOfStages = parseInt($("#selectNumberOfStages").val());
  emptyRocketMassForStage = [];
  for(var i=1; i<=numberOfStages; i++){
    emptyRocketMassForStage[i] = parseFloat($("#inputEmptyMassOfRocket-stage-"+i).val());
  }
  RT=[];
  RT[numberOfStages+1] = 0;
  for(var i=numberOfStages; i > 0; i--) {
    RT[i]=emptyRocketMassForStage[i]+RT[i+1];
  }
  var engineTypeForStageEngine = [];
  var totalPropellantMass = [];
  var engm = [];
  var thrust = [];
  var numberOfEnginesForStage = [];
  var tcoast = [];

  for(var i=1; i<=numberOfStages; i++){
    engineTypeForStageEngine[i] = [];
    totalPropellantMass[i] = 0;
    engm[i] = 0;
    thrust[i] = 0;

    numberOfEnginesForStage[i] = parseInt($("#selectNumberOfEngines-stage-"+i).val());
    tcoast[i] = [];

    for(var j=1; j<=numberOfEnginesForStage[i]; j++){
      tcoast[i][j] = parseFloat($("#inputEngineCoastTime-flight-"+currentFlight+"-stage-"+i+"-engine-"+j).val());
      engineTypeForStageEngine[i][j] = $("#selectEngineType-flight-"+currentFlight+"-stage-"+i+"-engine-"+j+" option:selected").val();
      thrust[i] = thrust[i] + engineTypeInfo[engineTypeForStageEngine[i][j]].IMPULSE / engineTypeInfo[engineTypeForStageEngine[i][j]].TBURN;
      engm[i] = engm[i] + engineTypeInfo[engineTypeForStageEngine[i][j]].PROPM + engineTypeInfo[engineTypeForStageEngine[i][j]].CASEM + engineTypeInfo[engineTypeForStageEngine[i][j]].DELAYM * tcoast[i][j];
      totalPropellantMass[i] = totalPropellantMass[i] + engineTypeInfo[engineTypeForStageEngine[i][j]].PROPM;
    }
  }

  var promtv = 0;
  TENGM = [];
  TENGM[numberOfStages+1] = 0;
  for(var i=numberOfStages; i>0; i--){
    promtv += totalPropellantMass[i];
    TENGM[i] = engm[i] + TENGM[i+1];
  }

  var rocketDiameter = parseFloat($("#inputRocketDiameter").val());
  var dragCoefficient = parseFloat($("#inputDragCoefficient").val());
  var S = [];
  var V = [];
  S[0] = 0;
  V[0] = 0;
  for(var i=1; i<=numberOfStages; i++) {
    var W = RT[i] + TENGM[i] - totalPropellantMass[i] / 2;
    var AREA = Math.PI * (rocketDiameter / 2) * (rocketDiameter /2);
    var B = W / dragCoefficient / AREA;
    var A = thrust[i] / (W * .0098) - 1;

    S[i] = S[i-1] + 16.32882 * B * Math.log((cosh(.7747*Math.sqrt(A)*engineTypeInfo[engineTypeForStageEngine[i][1]].TBURN / Math.sqrt(B)))+V[i-1]/(Math.sqrt(B)*Math.sqrt(A)*12.65009)*sinh(.7747*Math.sqrt(A)*engineTypeInfo[engineTypeForStageEngine[i][1]].TBURN / Math.sqrt(B)));
    $("#buroutAltitude-flight-"+currentFlight+"-stage-"+i+" .data").text(Math.round(S[i]));
    V[i] = V[i-1] + 12.65009 * Math.sqrt(B) * Math.sqrt(A) * tanh(.7747 * Math.sqrt(A) * engineTypeInfo[engineTypeForStageEngine[i][1]].TBURN / Math.sqrt(B));
    $("#buroutSpeed-flight-"+currentFlight+"-stage-"+i+" .data").text(Math.round(V[i]));
  }

  W = RT[numberOfStages] + TENGM[numberOfStages] - promtv;
  B = W / dragCoefficient / AREA;
  Z = 8.16441 * B * Math.log(1 + V[numberOfStages] * V[numberOfStages] / B / 160.02577);
  k = 1.2908 * Math.sqrt(B) * Math.atan(V[numberOfStages] / 12.65009 / Math.sqrt(B));
  $("#coastTime-flight-"+currentFlight+" .data").text(k.toFixed(1));
  Z = Z + 16.32882 * B * Math.log(Math.cos(.7747 * (k - tcoast[numberOfStages][1]) / Math.sqrt(B)));
  $("#coastDistance-flight-"+currentFlight+" .data").text(Math.round(Z));
  H = S[numberOfStages] + Z
  $("#totalAltitude-flight-"+currentFlight+" .data").text(Math.round(H));

  $("#resultsContainer-flight-"+currentFlight).show();
});


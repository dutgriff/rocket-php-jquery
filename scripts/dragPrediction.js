$("button").click(function(e) {
  e.preventDefault();

  var tubeDiameter = parseFloat($("#inputTubeDiameter").val()) / 2.54;
  var bodyCrossSectionArea = 3.14159 * Math.pow(tubeDiameter/2, 2);

  switch ($("#selectNoseShape option:selected" ).text()) {
    case "Ogive":
      var noseLength = parseFloat($("#inputNoseLength").val()) / 2.54;
      var noseAreaRatio = 2.64 * noseLength / tubeDiameter;
      break;
    case "Cone":
      var noseLength = parseFloat($("#inputNoseLength").val()) / 2.54;
      var noseAreaRatio = 2 * Math.sqrt(Math.exp(tubeDiameter/2, 2) + Math.exp(noseLength, 2)) / tubeDiameter;
      break;
    case "Hemisphere":
      var noseLength = tubeDiameter / 2;
      var noseAreaRatio = 2;
      break;
  }

  var tubeLength = parseFloat($("#inputTubeLength").val()) / 2.54;
  var bodyAreaRatio = 4 * tubeLength / tubeDiameter;
  var totalLength = noseLength + tubeLength;
  var totalAreaRatio = noseAreaRatio + bodyAreaRatio;
  var reynoldsNumber = 50855 * totalLength; // Make sure 50855! is the same as 50855 here (! means single percision in
                                            // DBASIC http://worldcomputerarticle.blogspot.com/2010/05/elements-of-qbasic.html)

  switch ($("#selectFinishQuality option:selected").text()) {
    case "None":
    case "Good":
      var flowFrictionFactor = Math.exp(10, -1.4 - Math.log(reynoldsNumber) / Math.log(10) * .16);
      break;
    case "Excellent":
      var flowFrictionFactor = Math.exp(10, .1836 - Math.log(reynoldsNumber) / Math.log(10) * .51);
      break;
  }

  var bodyNoseDragCoefficient = 1.02 * flowFrictionFactor * (1 + 1.5 / ((totalLength / tubeDiameter) ^ 1.5)) * totalAreaRatio;

  switch ($("#selectBaseShape option:selected").text()) {
    case "Blunt":
      var baseDiameter = tubeDiameter;
      break;
    case "Boat Tail":
      var baseDiameter = parseFloat($("#inputBaseDiameter")) / 2.54;
      break;
  }

  var baseDragCoefficient = .029 / Math.sqrt(bodyNoseDragCoefficient) * Math.exp(baseDiameter/tubeDiameter, 3);

  var launchLugLength = parseFloat($("#inputLaunchLugLength").val()) / 2.54;
  var lugDragCoefficient = (1.2 * .005 + .0045 * launchLugLength) / bodyCrossSectionArea;
  var finThickness = parseFloat($("#inputFinThickness").val()) / 2.54;
  var finRootLength = parseFloat($("#inputFinRootLength").val()) / 2.54;
  var finRadialWidth = parseFloat($("#inputFinRadialWidth").val()) / 2.54;
  var numberOfFins = parseFloat($("#inputNumberOfFins").val());

  switch ($("#selectFinProfileShape option:selected").text()) {
    case "Triangle":
      var finChord = finRootLength / 2;
      break;
    case "Rectangle":
      var finChord = finRootLength;
      break;
    case "Tapered":
      var finChord = (finRootLength + parseFloat($("#inputFinTipLength").val())/2.54) / 2;
      break;
    case "Elliptical":
      var finChord = .785 * finRootLength;
      break;
  }

  var finSurfaceArea = finChord * finRadialWidth * numberOfFins;

  switch ($("#selectFinEdgeShape option:selected").text()) {
    case "Square":
      var finC = finThickness / finRootLength * .875;
      break;
    case "Rounded":
      var finC = finThickness / finRootLength * .5;
      break;
    case "Streamlined":
      var finC = .01;
      break;
  }

  var finSurfaceDragCoefficient = finSurfaceArea / bodyCrossSectionArea * finC;
  var finInterferenceDragCoefficient = finC * finRootLength / bodyCrossSectionArea * tubeDiameter / 2 * numberOfFins;

  if ($("#selectFinishQuality option:selected").text() == "None") {
    var qualityFactorAdjustment = 1.25; // +25%
    bodyNoseDragCoefficient *= qualityFactorAdjustment;
    baseDragCoefficient *= qualityFactorAdjustment;
    finSurfaceDragCoefficient *= qualityFactorAdjustment;
    finInterferenceDragCoefficient *= qualityFactorAdjustment;
    lugDragCoefficient *= qualityFactorAdjustment;
  }

  var totalDragCoefficient = bodyNoseDragCoefficient + baseDragCoefficient + finSurfaceDragCoefficient + finInterferenceDragCoefficient + lugDragCoefficient;

  $("#resultsContainer #results #noseAndBody").text(bodyNoseDragCoefficient);
  $("#resultsContainer #results #base").text(baseDragCoefficient);
  $("#resultsContainer #results #finSurface").text(finSurfaceDragCoefficient);
  $("#resultsContainer #results #finInterference").text(finInterferenceDragCoefficient);
  $("#resultsContainer #results #launchLug").text(lugDragCoefficient);
  $("#resultsContainer #results #total").text(totalDragCoefficient);
  $("#resultsContainer").show();

});

$("#selectBaseShape").change(function() {
  if($("#selectBaseShape option:selected").text() == "Boat Tail")
    $("#baseDiameter").show(400);
  else
    $("#baseDiameter").hide(400);
});

$("#selectFinProfileShape").change(function() {
  if($("#selectFinProfileShape option:selected").text() == "Tapered")
    $("#finTipLength").show(400);
  else
    $("#finTipLength").hide(400);
});
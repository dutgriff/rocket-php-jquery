$("button").click(function(e) {
  e.preventDefault();

  var tubeDiameter = parseFloat($("#inputTubeDiameter").val()) / 2.54;
  var bodyCrossSectionArea = 3.14159 * Math.pow(tubeDiameter/2, 2);

  var noseLength, noseAreaRatio;
  switch ($("#selectNoseShape option:selected").text()) {
    case "Ogive":
      noseLength = parseFloat($("#inputNoseLength").val()) / 2.54;
      noseAreaRatio = 2.67 * noseLength / tubeDiameter;
      break;
    case "Cone":
      noseLength = parseFloat($("#inputNoseLength").val()) / 2.54;
      noseAreaRatio = 2 * Math.sqrt(Math.pow(tubeDiameter/2, 2) + Math.pow(noseLength, 2)) / tubeDiameter;
      break;
    case "Hemisphere":
      noseLength = tubeDiameter / 2;
      noseAreaRatio = 2;
      break;
    default:
      alert('Invalid nose shape.');
  }

  var tubeLength = parseFloat($("#inputTubeLength").val()) / 2.54;
  var bodyAreaRatio = 4 * tubeLength / tubeDiameter;
  var totalLength = noseLength + tubeLength;
  var totalAreaRatio = noseAreaRatio + bodyAreaRatio;
  var reynoldsNumber = 50855 * totalLength; // Make sure 50855! is the same as 50855 here (! means single precision in
                                            // QBASIC http://worldcomputerarticle.blogspot.com/2010/05/elements-of-qbasic.html)
  var flowFrictionFactor;
  switch ($("#selectFinishQuality option:selected").text()) {
    case "None":
    case "Good":
      flowFrictionFactor = Math.pow(10, (-1.4 - Math.log(reynoldsNumber) / Math.log(10) * 0.16));
      break;
    case "Excellent":
      flowFrictionFactor = Math.pow(10, (0.1836 - Math.log(reynoldsNumber) / Math.log(10) * 0.51));
      break;
    default:
      alert('Invalid finish quality');
      break;
  }

  var bodyNoseDragCoefficient = 1.02 * flowFrictionFactor * (1 + 1.5 / Math.pow((totalLength / tubeDiameter), 1.5)) * totalAreaRatio;

  var baseDiameter
  switch ($("#selectBaseShape option:selected").text()) {
    case "Blunt":
      baseDiameter = tubeDiameter;
      break;
    case "Boat Tail":
      baseDiameter = parseFloat($("#inputBaseDiameter").val()) / 2.54;
      break;
    default:
      alert('Invalid base shape.');
      break;
  }

  var baseDragCoefficient = .029 / Math.sqrt(bodyNoseDragCoefficient) * Math.pow(baseDiameter/tubeDiameter, 3);

  var launchLugLength = parseFloat($("#inputLaunchLugLength").val()) / 2.54;
  var lugDragCoefficient = (1.2 * .005 + .0045 * launchLugLength) / bodyCrossSectionArea;
  var finThickness = parseFloat($("#inputFinThickness").val()) / 2.54;
  var finRootLength = parseFloat($("#inputFinRootLength").val()) / 2.54;
  var finRadialWidth = parseFloat($("#inputFinRadialWidth").val()) / 2.54;
  var numberOfFins = parseFloat($("#inputNumberOfFins").val());

  var finChord;
  switch ($("#selectFinProfileShape option:selected").text()) {
    case "Triangle":
      finChord = finRootLength / 2;
      break;
    case "Rectangle":
      finChord = finRootLength;
      break;
    case "Tapered":
      finChord = (finRootLength + parseFloat($("#inputFinTipLength").val())/2.54) / 2;
      break;
    case "Elliptical":
      finChord = .785 * finRootLength;
      break;
    default:
      alert("Invalid fin profile shape.");
      break;
  }

  var finSurfaceArea = finChord * finRadialWidth * numberOfFins;

  var finC;
  switch ($("#selectFinEdgeShape option:selected").text()) {
    case "Square":
      finC = finThickness / finRootLength * .875;
      break;
    case "Rounded":
      finC = finThickness / finRootLength * .5;
      break;
    case "Streamlined":
      finC = .01;
      break;
    default:
      alert("Invalid find edge shape");
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

  $("#resultsContainer #results #noseAndBody").text(bodyNoseDragCoefficient.toFixed(3));
  $("#resultsContainer #results #base").text(baseDragCoefficient.toFixed(3));
  $("#resultsContainer #results #finSurface").text(finSurfaceDragCoefficient.toFixed(3));
  $("#resultsContainer #results #finInterference").text(finInterferenceDragCoefficient.toFixed(3));
  $("#resultsContainer #results #launchLug").text(lugDragCoefficient.toFixed(3));
  $("#resultsContainer #results #total").text(totalDragCoefficient.toFixed(3));
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
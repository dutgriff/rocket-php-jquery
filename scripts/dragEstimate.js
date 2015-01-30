$("button").click(function(e) {
  e.preventDefault();

  var totalImpulse = parseFloat($("#inputEngineTotalImpulse").val()); // E
  var thrustDuration = parseFloat($("#inputEngineThrustDuration").val()); // L
  var averageThrustDuration = totalImpulse / thrustDuration; // T
  var initialMass = parseFloat($("#inputEngineInitialMass").val()); // I
  var propellantMass = parseFloat($("#inputEnginePropellantMass").val()); // P
  var rocketMass = parseFloat($("#inputRocketMassNoEngine").val()); // R
  var rocketDiameter = parseFloat($("#inputRocketDiameter").val()); // D
  var coastTime = parseFloat($("#inputCoastTime").val()); // TC
  var apogeeAltitude = parseFloat($("#inputMeasuredApogeeAltitude").val()); // Q

  var estimatedDragCoefficient = 0, totalAltitude = 0;

  do {
    estimatedDragCoefficient += .05;

    var averageMassDuringThrust = rocketMass + initialMass - propellantMass / 2; // -----nomoreW----------
    console.log(averageMassDuringThrust);
    var rocketCrossSectionArea = Math.PI * (rocketDiameter / 2) * (rocketDiameter / 2); // M
    console.log(rocketCrossSectionArea);
    var ballisticCoefficientDuringThrust = averageMassDuringThrust / estimatedDragCoefficient / rocketCrossSectionArea; // -----nomoreB--------
    console.log(ballisticCoefficientDuringThrust);
    var dragFreeAcceleration = averageThrustDuration / (averageMassDuringThrust * .0098) - 1; // A
    console.log(dragFreeAcceleration);
    var burnoutAltitude = 16.3882 * ballisticCoefficientDuringThrust * Math.log(hyperbolicCosign(.7747 * Math.sqrt(dragFreeAcceleration) * thrustDuration / Math.sqrt(ballisticCoefficientDuringThrust))); // S
    console.log(burnoutAltitude);
    var burnoutVelocity = 12.65009 * Math.sqrt(ballisticCoefficientDuringThrust) * Math.sqrt(dragFreeAcceleration) * hyperbolicTangent(.7747 * Math.sqrt(dragFreeAcceleration) * thrustDuration / Math.sqrt(ballisticCoefficientDuringThrust)); // V
    console.log(burnoutVelocity);
    var averageMassDuringCoast = rocketMass + initialMass - propellantMass; // W
    console.log(averageMassDuringCoast);
    var ballisticCoefficientDuringCoast = averageMassDuringCoast / estimatedDragCoefficient / rocketCrossSectionArea; // B
    console.log(ballisticCoefficientDuringCoast);
    var coastDistance = 8.16441 * ballisticCoefficientDuringCoast * Math.log(1 + burnoutVelocity * burnoutVelocity / ballisticCoefficientDuringCoast / 160.02577); // -----nomoreZ--------
    console.log(coastDistance);
    var calculatedCoastTime = 1.2908 * Math.sqrt(ballisticCoefficientDuringCoast) * Math.atan(burnoutVelocity / 12.65009 / Math.sqrt(ballisticCoefficientDuringCoast)); // K
    console.log(calculatedCoastTime);
    coastDistance += 16.32882 * ballisticCoefficientDuringCoast * Math.log(Math.cos(.7747 * (calculatedCoastTime - coastTime) / Math.sqrt(ballisticCoefficientDuringCoast))); // Z
    console.log(coastDistance);
    totalAltitude = burnoutAltitude + coastDistance; // H

  } while(totalAltitude > apogeeAltitude);

  $("#resultsContainer #results #burnoutAltitude").text(burnoutAltitude.toFixed(1));
  $("#resultsContainer #results #burnoutVelocity").text(burnoutVelocity.toFixed(1));
  $("#resultsContainer #results #coastDistance").text(coastDistance.toFixed(1));
  $("#resultsContainer #results #totalAltitude").text(totalAltitude.toFixed(1));
  $("#resultsContainer #results #estimatedDragCoefficient").text(estimatedDragCoefficient.toFixed(3));
  $("#resultsContainer").show();
});

function hyperbolicSine(x) {
  return (Math.exp(x) - Math.exp(-x)) / 2;
}
function hyperbolicCosign(x) {
  return (Math.exp(x) + Math.exp(-x)) / 2;
}
function hyperbolicTangent(x) {
  return hyperbolicSine(x) / hyperbolicCosign(x);
}

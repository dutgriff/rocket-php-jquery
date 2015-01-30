$(document).ready(function(){


  var currentFlight = 1;

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

  // Handle updating the number of tracking stations
  $(".selectNumberTrackingStations").change(function() {
    renderTrackingStations(parseInt($("#flight-"+currentFlight+" .selectNumberTrackingStations").val()));
  });

  function renderTrackingStations(quantity) {
    for(var i=1; i<=3; i++) {
      if(i<=quantity) {
        $("#flight-"+currentFlight+" #distanceTackStation-"+i).show(400);
        $("#flight-"+currentFlight+" #angleTackStation-"+i).show(400);
      } else {
        $("#flight-"+currentFlight+" #distanceTackStation-"+i).hide(400);
        $("#flight-"+currentFlight+" #angleTackStation-"+i).hide(400);
      }
    }
  }

  // Handle calculations
  $("button").click(function(e){
    e.preventDefault();
    
    if(parseInt($("#flight-"+currentFlight+" .selectNumberTrackingStations").val()) == 1) {
      var D = parseInt($("#flight-"+currentFlight+" #inputDistanceTrackStation-1").val());
      var A = parseInt($("#flight-"+currentFlight+" #inputAngleTrackStation-1").val()) / 57.296;
      var h = Math.tan(A) * D
    } else {
      var totD = 0;
      for(var i=1; i <= parseInt($("#flight-"+currentFlight+" .selectNumberTrackingStations").val()); i++)
        totD+=parseInt($("#flight-"+currentFlight+" #inputDistanceTrackStation-"+i).val());

      var numerator = totD;
      var denominator = Math.PI;
      for(var i=1; i <= parseInt($("#flight-"+currentFlight+" .selectNumberTrackingStations").val()); i++) {
        numerator *= Math.sin(parseInt($("#flight-"+currentFlight+" #inputAngleTrackStation-"+i).val()) / 57.296);  
        denominator -= (parseInt($("#flight-"+currentFlight+" #inputAngleTrackStation-"+i).val()) / 57.296);
      }
      denominator=Math.sin(denominator);

      var h = numerator / denominator;
    }
    $("#flight-"+currentFlight+" #results").text(h.toFixed(0));
    $("#flight-"+currentFlight+" #resultsContainer").fadeIn(400);
  });

});

<?php
?>
<?php require('header.php') ?>
<div class="row">
  <div class="well col-xs-12 col-sm-offset-2 col-sm-8">
    <form class="form-horizontal col-xs-offset-1 col-xs-10" role="form" autocomplete="off">
      <legend class="text-center">Drag Estimate (Under Development)</legend>
      <div id="engineTotalImpulse" class="form-group">
        <label for="inputEngineTotalImpulse" class="col-xs-6 control-label">Engine Total Impulse:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputEngineTotalImpulse" type="text" class="form-control">
            <div class="input-group-addon">n-s</div>
          </div>
        </div>
      </div>
      <div id="engineThrustDuration" class="form-group">
        <label for="inputEngineThrustDuration" class="col-xs-6 control-label">Engine Thrust Duration:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputEngineThrustDuration" type="text" class="form-control">
            <div class="input-group-addon">s</div>
          </div>
        </div>
      </div>
      <div id="engineInitialMass" class="form-group">
        <label for="inputEngineInitialMass" class="col-xs-6 control-label">Engine Initial Mass:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputEngineInitialMass" type="text" class="form-control">
            <div class="input-group-addon">g</div>
          </div>
        </div>
      </div>
      <div id="enginePropellantMass" class="form-group">
        <label for="inputEnginePropellantMass" class="col-xs-6 control-label">Engine Propellant Mass:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputEnginePropellantMass" type="text" class="form-control">
            <div class="input-group-addon">g</div>
          </div>
        </div>
      </div>
      <div id="rocketMassNoEngine" class="form-group">
        <label for="inputRocketMassNoEngine" class="col-xs-6 control-label">Rocket Mass (no engine):</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputRocketMassNoEngine" type="text" class="form-control">
            <div class="input-group-addon">g</div>
          </div>
        </div>
      </div>
      <div id="rocketDiameter" class="form-group">
        <label for="inputRocketDiameter" class="col-xs-6 control-label">Rocket Diameter:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputRocketDiameter" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="coastTime" class="form-group">
        <label for="inputCoastTime" class="col-xs-6 control-label">Coast Time:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputCoastTime" type="text" class="form-control">
            <div class="input-group-addon">s</div>
          </div>
        </div>
      </div>
      <div id="measuredApogeeAltitude" class="form-group">
        <label for="inputMeasuredApogeeAltitude" class="col-xs-6 control-label">Measured Apogee Altitude:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputMeasuredApogeeAltitude" type="text" class="form-control">
            <div class="input-group-addon">m</div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <button id="buttonCalculate" class="btn btn-primary center-block">Calculate</button>
      </div>
      <div id="resultsContainer" class="col-md-offset-2 col-md-8 collapse">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title text-center">Results</h3>
          </div>
          <div class="panel-body text-center">
            <div id="results" class="form-group">
              <div class="row">
                <label for"burnoutAltitude" class="col-xs-6 text-right">Burnout Altitude:</label>
                <div class="col-xs-6 text-left">
                  <label id="burnoutAltitude">
                    <span class="data">m</span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"burnoutVelocity" class="col-xs-6 text-right">Burnout Velocity:</label>
                <div class="col-xs-6 text-left">
                  <label id="burnoutVelocity">
                    <span class="data">m/s</span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"coastDistance" class="col-xs-6 text-right">Coast Distance:</label>
                <div class="col-xs-6 text-left">
                  <label id="coastDistance">
                    <span class="data">m</span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"totalAltitude" class="col-xs-6 text-right">Total Altitude:</label>
                <div class="col-xs-6 text-left">
                  <label id="totalAltitude">
                    <span class="data">m</span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"estimatedDragCoefficient" class="col-xs-6 text-right">Estimated Drag Coefficient:</label>
                <div class="col-xs-6 text-left">
                  <label id="estimatedDragCoefficient">
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- The custom made javascript file for the Drag Prediction page -->
<script language="javascript" type="text/javascript" src="scripts/dragEstimate.js"></script>

<?php require('footer.php'); ?>

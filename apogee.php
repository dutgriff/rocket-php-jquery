<?php 
  define('MAXFLIGHTS' , 3);
  define('MAXTRSTATIONS'  , 2);
?>
<?php require('header.php') ?>
<div class="row">
  <div class="well col-xs-12 col-sm-offset-2 col-sm-8">
    <form class="form-horizontal col-xs-offset-1 col-xs-10" role="form" autocomplete="off">
      <legend class="text-center">Apogee Determination</legend>
      <div id="flightNumber" class="form-group">
        <label for="select" class="col-xs-6 control-label">Flight Number:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control" id="selectFlightNumber">

          <?php for($i=1; $i <= MAXFLIGHTS; $i++) { ?> 

            <option><?php echo $i; ?></option>

          <?php } ?>

          </select>
        </div>
      </div>

    <?php for($i=1; $i <= MAXFLIGHTS; $i++) { ?> 

      <div id="flight-<?php echo $i; ?>"<?php if($i>1) echo" class='collapse'"; ?>>
        <div id="numberTrackingStations" class="form-group">
          <label for="select" class="col-xs-6 control-label">Number of Tracking Stations:</label>
          <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
            <select class="form-control selectNumberTrackingStations">
            
            <?php for($j=1; $j <= MAXTRSTATIONS; $j++) { ?>

              <option><?php echo $j; ?></option>
              
            <?php } ?>
             
            </select>
          </div>
        </div>
      
      <?php for($j=1; $j <= MAXTRSTATIONS; $j++) { ?> 

        <div id="distanceTackStation-<?php echo $j; ?>" class="form-group<?php if($j>1) echo" collapse"; ?>">
          <label for="inputDistanceTrackStation-<?php echo $j; ?>" class="col-xs-6 control-label">Distance to Tracking Station <?php echo $j; ?>:</label>
          <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="input-group">
              <input type="text" class="form-control" id="inputDistanceTrackStation-<?php echo $j; ?>">
              <div class="input-group-addon">m</div>
            </div>
          </div>
        </div>
        <div id="angleTackStation-<?php echo $j; ?>" class="form-group<?php if($j>1) echo" collapse"; ?>">
          <label for="inputAngleTrackStation-<?php echo $j; ?>" class="col-xs-6 control-label">Angle at Tracking Station <?php echo $j; ?>:</label>
          <div class="col-xs-6 col-sm-4 col-md-3">
            <div class="input-group">
              <input type="text" class="form-control" id="inputAngleTrackStation-<?php echo $j; ?>">
              <div class="input-group-addon">&#176;</div>
            </div>
          </div>
        </div>

      <?php } ?>

        <div class="form-group">
          <button id="buttonCalculate" class="btn btn-primary center-block">Calculate</button>
        </div>
        <div id=resultsContainer class="col-xs-offset-4 col-xs-4 collapse">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title text-center">Flight Apogee</h3>
            </div>
            <div class="panel-body text-center">
              <span id="results"></span>
              <span>m</span>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>

    </form>
  </div>
</div>
<!-- The custom made javascript file for the Apogee page -->
<script language="javascript" type="text/javascript" src="scripts/apogee.js"></script>

<?php require('footer.php'); ?>

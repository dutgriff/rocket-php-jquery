<?php 
  define('MAXFLIGHTS' , 3);
  define('MAXSTAGES'  , 3);
  define('MAXENGINES' , 3);
?>
<?php require('header.php') ?>
<div class="row">
  <div class="well col-xs-12 col-sm-offset-2 col-sm-8">
    <form class="form-horizontal col-xs-offset-1 col-xs-10" role="form" autocomplete="off">
      <legend class="text-center">Performance Prediction</legend>
      <div id="rocketDiameter" class="form-group">
        <label for="inputRocketDiameter" class="col-xs-6 control-label">Rocket Diameter:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputRocketDiameter" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="dragCoefficient" class="form-group">
        <label for="inputDragCoefficient" class="col-xs-6 control-label">Rocket Drag Coefficient:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputDragCoefficient" type="text" class="form-control" value="0.75">
          </div>
        </div>
      </div>
      <div id="numberOfStages" class="form-group">
        <label for="selectNumberOfStages" class="col-xs-6 control-label">Number of Stages:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select id="selectNumberOfStages" class="form-control">
            
          <?php for($i=1; $i <= MAXSTAGES; $i++) { ?>

            <option><?php echo $i; ?></option>

          <?php } ?>

          </select>
        </div>
      </div>
      
    <?php for($i=1; $i <= MAXSTAGES; $i++) { ?>

      <div class="form-group stage-<?php echo $i; if($i>1) echo ' collapse' ?>">
        <label for="selectNumberOfEngines-stage-<?php echo $i; ?>" class="col-xs-6 control-label">Number of Engines in Stage <?php echo $i; ?>:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control selectNumberOfEnginesPerStage" id="selectNumberOfEngines-stage-<?php echo $i; ?>">
            
          <?php for($j=1; $j <= MAXENGINES; $j++) { ?>

            <option><?php echo $j; ?></option>

          <?php } ?>

          </select>
        </div>
      </div>

    <?php #} // These two lines commented to render empty mass and num of engines grouped by Stage Number instead of by question type ?>
      
    <?php #for($i=1; $i <= MAXSTAGES; $i++) { ?>

      <div class="form-group stage-<?php echo $i; if($i>1) echo ' collapse' ?>">
        <label for="inputEmptyMassOfRocket-stage-<?php echo $i; ?>" class="col-xs-6 control-label">Empty Mass of Rocket in Stage <?php echo $i; ?>:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input type="text" class="form-control inputEmptyMassOfRocket" id="inputEmptyMassOfRocket-stage-<?php echo $i; ?>">
            <div class="input-group-addon">g</div>
          </div>
        </div>
      </div>

    <?php } ?>

      <div id="flightNumber" class="form-group">
        <label for="selectFlightNumber" class="col-xs-6 control-label">Flight Number:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control" id="selectFlightNumber">
            
          <?php for($i=1; $i <= MAXFLIGHTS; $i++) { ?>

            <option><?php echo $i; ?></option>

          <?php } ?>

          </select>
        </div>
      </div>

    <?php for($i=1; $i <= MAXFLIGHTS; $i++) { ?>

      <div id="flight-<?php echo $i; ?>" class="<?php if($i>1) echo ' collapse'; ?>">

      <?php for($j=1; $j <= MAXSTAGES; $j++) { ?>

        <div id="flight-<?php echo $i; ?>-stage-<?php echo $j; ?>" class="stage-<?php echo $j; if($j>1) echo ' collapse'; ?>">

        <?php for($k=1; $k <= MAXENGINES; $k++) { ?>
        
          <div <?php # PHP tags with newlines only is so we don't uglify the html
            ?>id="engineType-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>-engine-<?php echo $k ?>" <?php
            ?>class="form-group engine-<?php echo $k; ?> <?php if($k>1) echo ' collapse'; ?>"<?php
          ?>>
            <label for="selectEngineType-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>-engine-<?php echo $k ?>" class="col-xs-6 control-label">
              Stage <?php echo $j; ?> Engine <?php echo $k; ?> Type:
            </label>
            <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
              <select id="selectEngineType-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>-engine-<?php echo $k ?>" class="form-control">
                <option>1/2A3</option>
                <option>1/2A6</option>
                <option>A3</option>
                <option>A8</option>
                <option>A10</option>
                <option>B4</option>
                <option>B6</option>
                <option>C6</option>
                <option>D12</option>
                <option>E15</option>
              </select>
            </div>
          </div>
          <div <?php
            ?>id="engineCoastTime-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>-engine-<?php echo $k ?>" <?php
            ?>class="form-group engine-<?php echo $k; ?> <?php if($k>1) echo ' collapse'; ?>"<?php
          ?>>
            <label for="inputEngineCoastTime-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>-engine-<?php echo $k ?>" class="col-xs-6 control-label">
              Stage <?php echo $j; ?> Engine <?php echo $k; ?> Coast Time:
            </label>
            <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
              <div class="input-group">
                <input type="text" class="form-control" id="inputEngineCoastTime-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>-engine-<?php echo $k ?>">
                <div class="input-group-addon">s</div>
              </div>
            </div>
          </div>

        <?php } ?>

        </div>

      <?php } ?>

        <div class="form-group">
          <button id="buttonCalculate-flight-<?php echo $i; ?>" class="btn btn-primary center-block">Calculate</button>
        </div>
        <div id="resultsContainer-flight-<?php echo $i; ?>" class="col-md-offset-2 col-md-8 collapse">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title text-center">Flight <?php echo $i; ?> Results</h3>
            </div>
            <div class="panel-body text-center">

            <?php for($j=1; $j <= MAXSTAGES; $j++) { ?>

              <div id="results-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>" class="form-group stage-<?php echo $j; if($j>1) echo ' collapse'; ?>">
                <label class="text-center">Stage <?php echo $j; ?>:</label>
                <div class="row">
                  <label for"buroutAltitude-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>" class="col-xs-6 text-right">Burnout Altitude:</label>
                  <div class="col-xs-6 text-left">
                    <label id="buroutAltitude-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>">
                      <span class="data"></span>
                      <span>m</span>
                    </label>
                  </div>
                </div>
                <div class="row">
                  <label for"buroutSpeed-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>" class="col-xs-6 text-right">Burnout Speed:</label>
                  <div class="col-xs-6 text-left">
                    <label id="buroutSpeed-flight-<?php echo $i; ?>-stage-<?php echo $j; ?>">
                      <span class="data"></span>
                      <span>m/s</span>
                    </label>
                  </div>
                </div>
              </div>

            <?php } ?>

              <div class="row">
                <label for"coastTime-flight-<?php echo $i; ?>" class="col-xs-6 text-right">Coasting time to max height:</label>
                <div class="col-xs-6 text-left">
                  <label id="coastTime-flight-<?php echo $i; ?>">
                    <span class="data"></span>
                    <span>s</span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"coastDistance-flight-<?php echo $i; ?>" class="col-xs-6 text-right">Coast Distance:</label>
                <div class="col-xs-6 text-left">
                  <label id="coastDistance-flight-<?php echo $i; ?>">
                    <span class="data"></span>
                    <span>m</span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"totalAltitude-flight-<?php echo $i; ?>" class="col-xs-6 text-right">Total Altitude:</label>
                <div class="col-xs-6 text-left">
                  <label id="totalAltitude-flight-<?php echo $i; ?>">
                    <span class="data"></span>
                    <span>m</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>

    </form>
  </div>
</div>

<!-- The custom made javascript file for the Prediction page -->
<script language="javascript" type="text/javascript" src="scripts/performance.js"></script>

<?php require('footer.php'); ?>

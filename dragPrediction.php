<?php
  $noseShapes = ["Ogive", "Cone", "Hemisphere"];
  $finishQualities = ['None' ,'Good', 'Excellent'];
  $baseShapes = ['Blunt','Boat Tail'];
?>
<?php require('header.php') ?>
<div class="row">
  <div class="well col-xs-12 col-sm-offset-2 col-sm-8">
    <form class="form-horizontal col-xs-offset-1 col-xs-10" role="form" autocomplete="off">
      <legend class="text-center">Drag Prediction (Beta)</legend>
      <div id="tubeDiameter" class="form-group">
        <label for="inputTubeDiameter" class="col-xs-6 control-label">Tube Diameter:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputTubeDiameter" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="noseShape" class="form-group">
        <label for="select" class="col-xs-6 control-label">Nose Shape:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control" id="selectNoseShape">

            <?php foreach($noseShapes as $i=>$shape) { ?>

              <option value="<?php echo $i; ?>"><?php echo $shape; ?></option>

            <?php } ?>

          </select>
        </div>
      </div>
      <div id="noseLength" class="form-group">
        <label for="inputNoseLength" class="col-xs-6 control-label">Nose Length:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputNoseLength" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="tubeLength" class="form-group">
        <label for="inputTubeLength" class="col-xs-6 control-label">Tube Length:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputTubeLength" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="finishQuality" class="form-group">
        <label for="select" class="col-xs-6 control-label">Finish Quality:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control" id="selectFinishQuality">

            <?php foreach($finishQualities as $i=>$quality) { ?>

              <option value="<?php echo $i; ?>"><?php echo $quality; ?></option>

            <?php } ?>

          </select>
        </div>
      </div>
      <div id="baseShape" class="form-group">
        <label for="select" class="col-xs-6 control-label">Base Shape:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control" id="selectBaseShape">

            <?php foreach($baseShapes as $i=>$shape) { ?>

              <option value="<?php echo $i; ?>"><?php echo $shape; ?></option>

            <?php } ?>

          </select>
        </div>
      </div>
      <div id="baseDiameter" class="form-group collapse">
        <label for="inputBaseDiameter" class="col-xs-6 control-label">Base Diameter:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputBaseDiameter" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="launchLugLength" class="form-group">
        <label for="inputLaunchLugLength" class="col-xs-6 control-label">Launch Lug Length:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputLaunchLugLength" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="finThickness" class="form-group">
        <label for="inputFinThickness" class="col-xs-6 control-label">Fin Thickness:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputFinThickness" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="finRootLength" class="form-group">
        <label for="inputFinRootLength" class="col-xs-6 control-label">Fin Root Length:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputFinRootLength" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="finRadialWidth" class="form-group">
        <label for="inputFinRadialWidth" class="col-xs-6 control-label">Fin Radial Width:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputFinRadialWidth" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="numberOfFins" class="form-group">
        <label for="inputNumberOfFins" class="col-xs-6 control-label">Number Of Fins:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputNumberOfFins" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="finProfileShape" class="form-group">
        <label for="select" class="col-xs-6 control-label">Fin Profile Shape:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control" id="selectFinProfileShape">
            <option>Triangle</option>
            <option>Rectangle</option>
            <option>Tapered</option>
            <option>Elliptical</option>
          </select>
        </div>
      </div>
      <div id="finTipLength" class="form-group collapse">
        <label for="inputFinTipLength" class="col-xs-6 control-label">Fin Tip Length:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <div class="input-group">
            <input id="inputFinTipLength" type="text" class="form-control">
            <div class="input-group-addon">cm</div>
          </div>
        </div>
      </div>
      <div id="finEdgeShape" class="form-group">
        <label for="select" class="col-xs-6 control-label">Fin Edge Shape:</label>
        <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
          <select class="form-control" id="selectFinEdgeShape">
            <option>Square</option>
            <option>Rounded</option>
            <option>Streamlined</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <button id="buttonCalculate" class="btn btn-primary center-block">Calculate</button>
      </div>
      <div id="resultsContainer" class="col-md-offset-2 col-md-8 collapse">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title text-center">Drag Predictions</h3>
          </div>
          <div class="panel-body text-center">
            <label class="text-center">Drag Coefficient</label>
            <div id="results" class="form-group">
              <div class="row">
                <label for"noseAndBody" class="col-xs-6 text-right">Nose and Body:</label>
                <div class="col-xs-6 text-left">
                  <label id="noseAndBody">
                    <span class="data"></span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"base" class="col-xs-6 text-right">Base:</label>
                <div class="col-xs-6 text-left">
                  <label id="base">
                    <span class="data"></span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"finSurface" class="col-xs-6 text-right">Fin Surface:</label>
                <div class="col-xs-6 text-left">
                  <label id="finSurface">
                    <span class="data"></span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"finInterference" class="col-xs-6 text-right">Fin Interference:</label>
                <div class="col-xs-6 text-left">
                  <label id="finInterference">
                    <span class="data"></span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"launchLug" class="col-xs-6 text-right">Launch Lug:</label>
                <div class="col-xs-6 text-left">
                  <label id="launchLug">
                    <span class="data"></span>
                  </label>
                </div>
              </div>
              <div class="row">
                <label for"total" class="col-xs-6 text-right">Total:</label>
                <div class="col-xs-6 text-left">
                  <label id="total">
                    <span class="data"></span>
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
<script language="javascript" type="text/javascript" src="scripts/dragPrediction.js"></script>

<?php require('footer.php'); ?>

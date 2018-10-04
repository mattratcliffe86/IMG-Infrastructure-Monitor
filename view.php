<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Infrastructure Monitor</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<style>
	.top-buffer { 
	  margin-top:20px; 
	}
	html {
	  font-size: 12px;
	}
	@media (min-width: 768px) {
	  html {
		font-size: 14px;
	  }
	}
	.container {
	  max-width: 1024px;
	}
	.page-header {
	  max-width: 700px;
	}
	.card-deck .card {
	  min-width: 220px;
	}
	</style>
  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal"><?php if (!empty($settings['view']['organisation'])) { echo $settings['view']['organisation']; }?></h5>
    </div>

    <div class="page-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Infrastructure Monitor</h1>
      <p class="lead">Simple and Effective.</p>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
<?php 
foreach ($devices as $id => $device) {
?>	  
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h5 class="my-0 font-weight-normal"><?php if (!empty($device['alias'])) { echo $device['alias']; } else { echo $device['host']; } ?></h4>
          </div>
          <div class="card-body">
            <h2 class="card-title"><?php echo $device['heartbeat_icon']; ?>&nbsp;<?php echo $device['service_icon']; ?></h2>
            <ul class="list-unstyled mt-3 mb-4">
              <li><?php if ($device['heartbeat'] === TRUE) { echo 'Online'; } else { echo '<strong>Offline</strong>'; } ?></li>
            </ul>
			<button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#<?php echo 'modal-' . $id; ?>">
			  <i class="fas fa-info-circle"></i>
			</button>
          </div>
        </div>
		<div class="modal fade" id="<?php echo 'modal-' . $id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo 'modal-' . $id . '-label'; ?>" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="<?php echo 'modal-' . $id . '-title'; ?>">Device Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div class="list-group">
				  <span class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
					  <h5 class="mb-1">Device</h5>
					  <small>Host Name, IP Address or Website Address</small>
					</div>
					<p class="mb-1 text-left"><?php echo $device['host']; ?></p>
				  </span>
<?php
if (!empty($device['alias'])) {
?>
				  <span class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
					  <h5 class="mb-1">Alias</h5>
					  <small>Aliased name of the device</small>
					</div>
					<p class="mb-1 text-left"><?php echo $device['alias']; ?></p>
				  </span>
<?php
}
if (!empty($device['port'])) {
?>
				  <span class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
					  <h5 class="mb-1">Port</h5>
					  <small>Port Number</small>
					</div>
					<p class="mb-1 text-left"><?php echo $device['port']; ?></p>
				  </span>
<?php
}
if (!empty($device['method'])) {
?>
				  <span class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
					  <h5 class="mb-1">Method(s)</h5>
					  <small>Method(s) used to determine device status</small>
					</div>
					<p class="mb-1 text-left"><?php echo $device['method']; ?></p>
				  </span>
<?php
}
if (!empty($device['description'])) {
?>
				  <span class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
					  <h5 class="mb-1">Description</h5>
					  <small>Description of the device</small>
					</div>
					<p class="mb-1 text-left"><?php echo $device['description']; ?></p>
				  </span>
<?php
}
if (!empty($device['location'])) {
?>
				  <span class="list-group-item list-group-item-action flex-column align-items-start">
					<div class="d-flex w-100 justify-content-between">
					  <h5 class="mb-1">Location</h5>
					  <small>Location of the device</small>
					</div>
					<p class="mb-1 text-left"><?php echo $device['location']; ?></p>
				  </span>
<?php
}
?>
				</div>
				<div class="card top-buffer">
				  <div class="card-body">
<?php
if (is_array($device['result'])) {
	
	foreach ($device['result'] as $row) {
		
		echo $row . '<br />';
	}
}
else {
	
	echo '<p class="mb-1">' . $device['result'] . '</p>';
}
if (is_array($device['service_result'])) {
	
	foreach ($device['service_result'] as $row) {
		
		echo $row . '<br />';
	}
}
else if (!empty($device['service_result'])) {
	
	echo '<p class="mb-1">' . $device['service_result'] . '</p>';
}
?>
				</div>
			  </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
<?php
}
?>
        </div>

    </div>

    <!-- Placed at the end of the document so the pages load faster -->
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>

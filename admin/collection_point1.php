<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collection Points</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
          <i class="fas fa-users mr-1"></i>
          Collection Points
        </h3>
        <button id="registerNewButton" class="btn btn-primary">Register New</button>
      </div>
      <!-- /.card-header -->

      <!-- New Collection Point Form, hidden initially -->
      <div id="newCollectionPointForm" class="card-body" style="display: none;">
        <h4>New Collection Point</h4>
        <form action="your_form_processing_script.php" method="POST">
          <!-- Add your form fields here -->
          <div class="form-group">
            <label for="collectionPointName">Collection Point Name:</label>
            <input type="text" id="collectionPointName" name="collectionPointName" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="collectionPointAddress">Address:</label>
            <input type="text" id="collectionPointAddress" name="collectionPointAddress" class="form-control" required>
          </div>
          <!-- Add more form fields as needed -->
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>

      <div class="card-body">
        <?php
        // Assuming this function displays the collection points table
        displayOutletTable(1);
        ?>
      </div>
      <!-- /.card-body -->
    </div>
  </div>

  <!-- jQuery script to toggle the visibility of the New Collection Point form -->
  <script>
    $(document).ready(function() {
      $('#registerNewButton').on('click', function() {
        $('#newCollectionPointForm').slideToggle();
      });
    });
  </script>
</body>
</html>

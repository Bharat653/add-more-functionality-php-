<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['submit'])) {

    if (empty($_POST['Start']) || empty($_POST['End']) || empty($_POST['Rs'])) {
      echo "All columns are required";
    }
     else {
      $results = $database->addUnit($_POST['unit_name'] ,$_POST['Start'], $_POST['End'], $_POST['Rs']);

      if (in_array(false, $results, true)) {
        echo "Failed to add unit";
      } else {
        echo "Adding successfully";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
  <form action="index2.php" class="record" method="post">
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
        <h5 class="card-title">Unit Name</h5>
        <input type="text" name="unit_name">
        </div>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="records">
              <div class="record-row">
                <input type="number" placeholder="Start" name="Start[]" class="inputs"/>
                <input type="number" placeholder="End" name="End[]" class="inputs"/>
                <input type="number" placeholder="Rs" name="Rs[]" class="inputs"/>
                <button type="button"  class="addmorebtn">+</button>
                <button type="button"  class="deletemorebtn d-none">-</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <input type="submit" value="submit" name="submit">
  </form>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>

    $(document).on("click", ".addmorebtn", function() {
      var parent = $(this).parents('.records');
      var clone = parent.clone();
      clone.find(".inputs").val("");
      $(this).parents('.records').after(clone);
      shoHide();
    });

    $(document).on('click', '.deletemorebtn', function() {
      var parent = $(this).parents('.records');
      parent.remove();
      shoHide();
    });

    function shoHide(){
      if($('.records').length <= 1){
        $('.addmorebtn').removeClass('d-none');
        $('.deletemorebtn').addClass('d-none');
      }else{
        $('.addmorebtn').addClass('d-none');
        $('.deletemorebtn').removeClass('d-none');
        $('.addmorebtn').last().removeClass('d-none');
      }
    }
  </script>
</body>

</html>

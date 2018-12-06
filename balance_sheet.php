<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Balance Sheet</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/balance_sheet.js"></script>
</head>
<body>
    <?php
        include_once("./database/constants.php");
        include_once("./templates/header.php");

        
            $year = date('Y')-4;
            ?>
    
    <!-- <div class="jumbotron" style="text-align:center"> -->
        <br>
      <h1 style="text-align:center">Statement of Financial Positions</h1> 
      <h3 style="text-align:center">for the period from Jun-xxxx to Dec-xxxx </h3>
    <!-- </div> -->
    <br>
    <div class="container">
        <table class="table table-hover">
    <thead>
      <tr>
        
        <th></th>
        <th><?php echo $year++;?></th>
        <th><?php echo $year++;?></th>
        <th><?php echo $year++;?></th>
        <th><?php echo $year++;?></th>
        <th><?php echo $year++;?>(Current)</th>
      </tr>
    </thead>
    <tbody id="balance_sheet" name="balance_sheet">
    
  </table>
    </div>
</body>
</html>

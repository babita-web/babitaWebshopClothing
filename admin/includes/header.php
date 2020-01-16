
<?php include ("init.php"); ?>
<?php
ob_start ();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Babita's Backend - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
    <link rel="stylesheet" href="component/payalord/xZoom/dist/xzoom.css">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Total Views',     <?php echo $session->count; ?>],

              ['Users',  <?php echo User::count_all (); ?>],
                 ['Products', <?php echo Product::count_all (); ?>],
                    ['Photos', <?php echo Photo::count_all(); ?>],
                   ['Orders',      <?php echo Order::count_all (); ?>],
                    ['Comments',      <?php echo Comment::count_all (); ?>],
                ['Categories',      <?php echo Category::count_all (); ?>],


            ]);

            var options = {
                title: 'My Daily Activities',
                pieHole: 0.0,


                backgroundColor: 'transparent'
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

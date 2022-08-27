<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <title>Document</title>
</head>
<body class="bg-orange-50">
  <?php 
  
  $conn = mysqli_connect("localhost", "root" , "", "testing");


  $sql = "SELECT * FROM test";
    $result = mysqli_query($conn, $sql);
    $value = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  ?>



<table class="w-full mx-auto mt-80 border-collapse border border-slate-400 ...">
  <thead>
    <tr>
      <th class="p-4 border border-slate-300 ...">Name</th>
      <th class="p-4 border border-slate-300 ...">For</th>
      <th class="p-4 border border-slate-300 ...">life span</th>
      <th class="p-4 border border-slate-300 ...">origin</th>
      <th class="p-4 border border-slate-300 ...">temperament</th>
    </tr>
  </thead>
 
  <tbody>

  <?php foreach($value as $val){ ?>

    <tr>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['dog']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['bred_for']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['life']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['Origin']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['temperament']; ?></td>
    </tr>
       
    <?php } ?>
  </tbody>
</body>
</html>
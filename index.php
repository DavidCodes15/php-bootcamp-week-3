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
          // Create a stream
          $opts = array(
            'http'=>array(
              'method'=>"GET",
              'header'=>'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'
            )
          );

          $context = stream_context_create($opts);

          
 ?>


  <?php if(isset($_POST['submit'])){ 
    // connect to the mysql database 
    $connect = mysqli_connect("localhost", "root" , "", "testing");
    $dogName = $_POST['dogName'];    

    
    
   

    // display data within table
    $sql = "SELECT * FROM test WHERE dog = '$dogName' ";
    $result = mysqli_query($connect, $sql);
    $challenge = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $counter = mysqli_num_rows($result);
    

    // echo "<pre>";
    // var_dump($challenge);
    // echo "</pre>";








    // $pdo = new PDO('mysql:host=localhost;port=3306;dbname=challenge_3', 'root', '');
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $statement = $pdo->prepare("SELECT * FROM challenge WHERE dog = '$dogName' ");
    // $statement->execute();
    // $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($products);
    // echo "</pre>";

    // $sql = "SELECT * FROM challenge WHERE dog = '$dogName' ";
    // $result = mysqli_query($connect, $sql);
    // $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // var_dump($product);
    
    
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
  <?php if($counter > 0) {
     $sql = "SELECT * FROM test WHERE dog = '$dogName' ";
     $result = mysqli_query($connect, $sql);
     $challenge = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
  <?php foreach($challenge as $chall) { ?>

    <tr>
      <td class="p-4 border border-slate-300 ..."><?php echo $chall['dog']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $chall['bred_for']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $chall['life']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $chall['Origin']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $chall['temperament']; ?></td>
    </tr>
       
    <?php } ?>
  </tbody>
     
    <?php }else {
      // get the info and then make it an array
      
      $url = "https://api.thedogapi.com/v1/breeds/search?q=$dogName";
      $json_data = file_get_contents($url);
      $decode = json_decode($json_data, true);

      // get this info into mysql database

      
    
    foreach($decode as $code){
      $sql = "INSERT INTO test(dog, bred_for, life, Origin, temperament) VALUES ('".$code['name']."', '".$code['bred_for']."', '".$code['life_span']."', '".$code['origin']."', '".$code['temperament']."')";
      mysqli_query($connect, $sql);
    }

    $sql = "SELECT * FROM test WHERE dog = '$dogName' ";
     $result = mysqli_query($connect, $sql);
     $value = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
     <tbody>
  <?php foreach($value as $val) { ?>

    <tr>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['dog']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['bred_for']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['life']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['Origin']; ?></td>
      <td class="p-4 border border-slate-300 ..."><?php echo $val['temperament']; ?></td>
    </tr>
       
    <?php } ?>
     </tbody>


  <?php  } ?>

    <?php }else { ?>
  <div class="bg-slate-300 w-60 h-80 flex items-center mx-auto mt-7 rounded-2xl shadow-2xl">
    <form action="" method="post" class="flex flex-col pt-4">
      <input class="ml-5 p-2 rounded-xl hover:shadow-2xl cursor-pointer" type="text" name="dogName" placeholder="Enter Dog" required>
      <input type="submit" name="submit" class="ml-5 mt-7 border border-solid border-black p-2 hover:shadow-2xl hover:bg-black hover:text-slate-300" required>
    </form>
    </div>
     <a href="search-history.php" target="_blank"><button class="p-4 border-2 border-solid border-black hover:shadow-2xl hover:bg-slate-300">Search History</button></a>
    <?php } ?>
</body>
</html>
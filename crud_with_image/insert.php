<?php
include 'connection.php';

//super global variable = $_POST, $_GET etc;
//submit এর মধ্যে ক্লিক করলে নিচের html form input থেকে আনা value গুলো কাজ করবে
if(isset($_POST['submit'])){ 

    // html form থেকে name এনে variable এর মধ্যে রেখেছি
    $inputName = $_POST['name'];
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];
    $inputAddress = $_POST['address'];


    // html form থেকে image name এনে variable এর মধ্যে রেখেছি
    $filename = $_FILES["upfile"]["name"]; //fle er নাম
    $tmpname = $_FILES["upfile"]["tmp_name"]; //file er টেম্পরারী নাম
    
    $type = $_FILES["upfile"]["type"]; //file টা কোন টাইপের//image/png
    $size = $_FILES["upfile"]["size"]; //file এর সাইজ কত

    $dirFileConn = 'poto/'.$filename; //directory এর সাথে filename connect করেছি

    if(file_exists($filename)){ //একই নামে কোনো file থাকলে সেটা upload হবেনা
        echo "This file already exists";
    }else{

        if($size<"500000"){ //500000 bit এর কম হলে file upload হবেনা
    
            if($type=="image/png"){ //png file ছাড়া file upload হবেনা
                $upload = move_uploaded_file($tmpname, $dirFileConn); //tmp_name & directory এরসাথে filename connect করে file upload করতে হবে
            }else{
                echo "This file must be image/png";
            }
        }else{
            echo "This file lesthen 500000 bit";
        }
    }
    

    // INSERT INTO = table এর নামে এবং column এর নামে google থেকে copy করেছি
    // value = html form থেকে যে ডাটা গুলো ভারিয়েবলের মধ্যে রেখেছি সেই গুলো
    $insert = "INSERT INTO student_cv (name, email, password, address, file)
VALUES ('$inputName', '$inputEmail', '$inputPassword', '$inputAddress', '$filename')";


    $query = mysqli_query($conn, $insert);
    if($query){
        header('location:show.php'); //data insertহওয়ার পরে show.php file এ আমাদের নিয়ে যাবে
    }else{
        echo "Data Not Inserted";
    }
}




?>


<h3>Insert Data</h3>
<h3><a href="show.php">Show Data</a></h3>

<!--//todo: html form  -->
<form action="insert.php" method="POST" enctype="multipart/form-data">

<!--//todo: Name input  -->
<label>Name: </label>
  <input type="text" name="name" id="nameinput" placeholder="Enter Your name" required><br><br>

  <!--//todo: E-mail input  -->
<label>E-mail: </label>
  <input type="email" name="email" id="emailinput" placeholder="Enter Your E-mail" required><br><br>

  <!--//todo: Password input  -->
<label>Password: </label>
  <input type="password" name="password" id="passwordinput" placeholder="Enter Your Password" required><br><br>

  <!--//todo: Address select option  -->
<label>Address: </label>
<select name="address" id="addressinput">
    <option value="">Select Area</option>
    <option value="Bangalpara">Bangalpara</option>
    <option value="Kishoreganj">Kishoreganj</option>
    <option value="Dhaka">Dhaka</option>
    <option value="Bogra">Bogra</option>
    <option value="Libya">Libya</option>
</select><br><br>

<!--//todo: File input  -->
  <input type="file" name="upfile" id="fileinput"><br><br>

  <!--//todo: submit input  -->
  <input type="submit" value="Submit" name="submit">
</form>

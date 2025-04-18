<?php
include 'connection.php';
// todo: id & time auto update হবে 

// super global variable
if(isset($_GET['editid'])){

  // show.php থেকে যে id টা পাঠানো হয়েছে সেটা এখানে রিসিভ করেছি
  $editid = $_GET['editid'];
  $select = "SELECT * FROM student_cv WHERE id=$editid"; //যেই id টা এসেছে সেই id এর সকল ডাটা(row) সিলিক্ট করেছি

  $query = mysqli_query($conn, $select);  //select করা row এর ডাটাকে query করেছি
  $getAllData = mysqli_fetch_array($query); //query করা(select করা) সকল ডাটাকে array আকারে করেছি

  //student_cv table এর সকল field(column) গুলোকে এনে variable এর মধ্যে রেখেছি, html form এর মধ্যে show করানোর জন্য
  $getid = $getAllData['id'];
  $getname = $getAllData['name'];
  $getemail = $getAllData['email'];
  $getpassword = $getAllData['password'];
  $getaddress = $getAllData['address'];
  $getfile = $getAllData['file'];

}



// todo: Update Data
// student_cv table এর যে সকল ডাটা html form er এর মধ্যে পাঠানো হয়েছে সেই গুলোকে update করতে চাচ্ছি
//submit এর মধ্যে ক্লিক করলে নিচের html form input থেকে আনা value গুলো কাজ করবে
if(isset($_POST['submit'])){

  // html form থেকে name এনে variable এর মধ্যে রেখেছি, insert.php থেক 2Ta input বেশি আছে ১(id input), 2(img input)
    $inputId = $_POST['inputId'];
    $select = "SELECT * FROM student_cv WHERE id=$inputId";

    $query = mysqli_query($conn, $select);
    $fetchAllData = mysqli_fetch_array($query);
    $getfile = $fetchAllData['file']; //উপরে $_GET(global variable) এর $getfile variable এখানে copy করে বসিয়েছি না হলে কাজ করবে না
    unlink("poto/".$getfile); //unlink এর মাধ্যমে student_cv table এর id থেকে delete করেছি & directory থেকেও Delete করেছি ;


    $inputName = $_POST['name'];
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];
    $inputAddress = $_POST['address'];


    $filename = $_FILES['upfile']['name'];
    $tmpname = $_FILES['upfile']['tmp_name'];

    $dirAndFileConn = 'poto/'.$filename;

    $upload = move_uploaded_file($tmpname, $dirAndFileConn);

    //Data update করার sql google থেকে এনেছি
    $update = "UPDATE student_cv SET name='$inputName', email='$inputEmail', password='$inputPassword', address='$inputAddress', file='$filename' WHERE id='$inputId'";



$query2 = mysqli_query($conn, $update);

if($query2){
  header('location:show.php'); //update করার পরে show.php page এর মধ্যে আমাদেরকে নিয়ে যাবে
}else{
  echo "Data Not Updated";
}

}


?>

<h3>Edit id</h3>

<form action="edit.php" method="POST" enctype="multipart/form-data">

<!--//todo id input insert.php page এর মধ্যে নাই এই পেইজে সেট করেছি student_cv table এর id Ta show করার জন্য  -->
<label>ID: </label>
  <input type="text" name="inputId" id="nameinput" value='<?php echo $getid;?>' required><br><br>

<label>Name: </label>
  <input type="text" name="name" id="nameinput" value='<?php echo $getname;?>' required><br><br>

<label>E-mail: </label>
  <input type="email" name="email" id="emailinput" value='<?php echo $getemail;?>' required><br><br>

<label>Password: </label>
  <input type="text" name="password" id="passwordinput" value='<?php echo $getpassword;?>'required><br><br>

<label>Address: </label>
<select name="address" id="addressinput">
    <option value="">Select Area</option>
    <option value="Bangalpara"<?php if($getaddress=='Bangalpara'){echo'Selected';}?>>Bangalpara</option>;
    <option value="Kishoreganj"<?php if($getaddress=='Kishoreganj'){echo'Selected';}?>>Kishoreganj</option>
    <option value="Dhaka"<?php if($getaddress=='Dhaka'){echo'Selected';}?>>Dhaka</option>
    <option value="Bogra"<?php if($getaddress=='Bogra'){echo'Selected';}?>>Bogra</option>
    <option value="Libya"<?php if($getaddress=='Libya'){echo'Selected';}?>>Libya</option>
</select><br><br>


<!--//todo: old file মানে directory এর মধ্যে যে file টা আছে সেটা show করার জন্য-->
  <img height='50' src="poto/<?php echo $getfile;?>">

  <input type="file" name="upfile" id="fileinput"><br><br>

  <input type="submit" value="Submit" name="submit">
</form>




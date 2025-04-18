<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php


include 'connection.php';

$select = "SELECT * FROM student_cv"; //student_cv table এর সকল ডাটা select করেছি
$query = mysqli_query($conn, $select); //select করা ডাটা গুলো query করেছি

// student_cv table এর সকল ডাটাকে table আকারে দেখতে চাচ্ছি তাই table create করেছি, নিচের গুলো field(column) এর নামে
echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Password</th>
                        <th>Address</th>
                        <th>File</th>
                        <th>Current Time</th>
                        <th colspan='2'>Action</th>

                    </tr>";


//record(row) এর Data গুলোকে array আকারে করেছি
//while loop করেছি যাতে student_cv table এর সব record(row) দেখতে পারি
while($getAllData = mysqli_fetch_array($query)){ 

    //student_cv table এর সকল field(column) গুলোকে এনে variable এর মধ্যে রেখেছি
    $getid = $getAllData['id'];      
    $getname = $getAllData['name']; 
    $getemail= $getAllData['email'];    
    $getpassword = $getAllData['password']; 
    $getaddress = $getAllData['address'];   
    $getfile = $getAllData['file']; 
    $gettime = $getAllData['reg_date']; 
    
    //Edit, Delete এ ক্লিক করলে তাদের পেইজে আমাদেরকে নিয়ে যাবে সাথে id টাও নিয়ে যাবে
    // Delete এ ক্লিক করলে একটা confirm বক্স আসবে কারন onclick event সেট করেছি,নিচে js এর কোড আছে

    // student_cv table এর column গুলোকে table আকারে দেখতে চাচ্ছি তাই variable গুলোকে <td> এর মধ্যে রেখেছি
    echo "<tr>
                <td>$getid </td>
                <td>$getname </td>
                <td>$getemail </td>
                <td>$getpassword </td>
                <td>$getaddress </td>
                <td><img height='30' src='poto/$getfile'> </td>
                <td>$gettime </td>
                <td><a href='edit.php?editid=$getid'>Edit</a></td>
                <td><a href='delete.php?deleteid=$getid' onclick='return myfunction()'>Delete</a></td>
            </tr>";
}






?>
<h3>Show Data</h3>
<h3><a href="insert.php">Insert Data</a></h3>
<h3><a href="edit.php">Edit Data</a></h3>


<!-- delete এর জন্য js এর confirm বক্স এখানে সেট করেছি-->
    <script>
        function myfunction(){
            return confirm("Are you sure");

        }
    </script>

</body>
</html>
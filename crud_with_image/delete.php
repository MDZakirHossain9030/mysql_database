<?php
include 'connection.php';

// super global variable
if(isset($_GET['deleteid'])){ //Delete এ ক্লিক করলে নিচের কাজ করবে

// show.php থেকে যে id টা পাঠানো হয়েছে সেটা এখানে রিসিভ করেছি
    $deleteid = $_GET['deleteid']; 

    $select = "SELECT * FROM student_cv WHERE id=$deleteid"; //যেই id টা এসেছে শুধু সেই id এর সকল ডাটা(row) সিলিক্ট করেছি

    $query = mysqli_query($conn, $select); //select করা row এর ডাটাকে query করেছি 

    $getAllData = mysqli_fetch_array($query); //যেই id এর সকল ডাটা select করেছি সেই id এর সকল ডাটাকে array আকারে করে নিয়েছি
    unlink("poto/".$getAllData['file']); //unlink এর মাধ্যমে student_cv table এর id থেকে delete করেছি & directory থেকেও Delete করেছি ;


    //student_cv table এর যে id রিসিভ করেছি সেই id  data Delete করেছি
    $delete = "DELETE FROM student_cv WHERE id =$deleteid"; 
    $query = mysqli_query($conn, $delete);
    if($query){
        header('location:show.php');// data Delete হওয়ার পরে সেটা আবার show.php পেইজে আমাদের নিয়ে যাবে
    }else{
        echo "Data Not Deleted";
    }

}
?>

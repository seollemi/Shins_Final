<?php
    
    // Include constants.php file here
    include('constants.php');

    // 1. Get the id of admin to be deleted
    $id = $_GET['id'];

    // Check if the id is 1 and prevent deletion
    if($id == 1) {
        // Create session variable to display message
        $_SESSION['delete'] = "<div class='error'>Cannot delete this admin.</div>";
        // Redirect to manage admin page
        header('location:'.SITEURL.'manage-admin.php');
    } else {
        // 2. Create SQL query to delete admin
        $sql = "DELETE FROM tbl_admin WHERE id=$id";
        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed successfully or not
        if($res==true)
        {
            // Query executed successfully and admin deleted
            // Create session variable to display message
            $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
            // Redirect to manage admin page
            header('location:'.SITEURL.'manage-admin.php');
        }
        else
        {
            // Failed
            $_SESSION['delete'] = "<div class='error'>Failed to Delete admin. Try again later.</div>";
            header('location:'.SITEURL.'manage-admin.php');
        }
    }
    // 3. Redirect to manage admin page with message (success/error)
?>

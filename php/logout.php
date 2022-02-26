<?php
session_start();

//Destroy session and go back to start
if(!session_destroy()){
    die("Error: Could not destroy session!");
}else{
    echo "<script>
   alert('logged out!');
   window.location.replace('../');
  </script>";
}
?>
<?php 
if(isset($_POST['post-submit'])){
    require 'dbc.inc.php';

    $cd = $_POST['cd'];
    $nd = $_POST['nd'];
    $file = $_FILES['file-img'];

    $fileName = $_FILES['file-img']['name'];
    $fileTmpName = $_FILES['file-img']['tmp_name'];
    $fileSize = $_FILES['file-img']['size'];
    $fileError = $_FILES['file-img']['error'];
    $fileType = $_FILES['file-img']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
                if(empty($cd) || empty($nd)){
                    header("Location: ../admin.php?error=emptyfields");
                    exit();
                }else{
                    $sql = "INSERT INTO dangtai (chude,noidung) VALUES (?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../admin.php?&error=sqlerror");
                        exit();
                    }else{
                        mysqli_stmt_bind_param($stmt, "ss", $cd, $nd);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);

                        $sql2 = "SELECT * FROM dangtai where chude = '$cd'";
                        $result2 = mysqli_query($conn, $sql2);
                        if(mysqli_num_rows($result2) > 0){
                        while($row2 = mysqli_fetch_assoc($result2)){
                            $fileNameNew = "post-".$cd.".png";
                            $fileDestination = 'post-img/'.$fileNameNew;
                            move_uploaded_file($fileTmpName,$fileDestination);
                            header("Location: ../admin.php?post=success");
                            exit();
                        }
                    }   
                    }
                }
                
            }

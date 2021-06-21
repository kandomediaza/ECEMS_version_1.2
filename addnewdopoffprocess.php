  <?php 

    require_once('connection.php');

    if (isset($_POST['submit'])) {
        try {
            $tbl_image_id = $_POST['tbl_image_id'];
             $date = $_POST['date'];
             $customer_name = $_POST['customer_name'];
             $customer_phone = $_POST['customer_phone'];
            $image_file = $_FILES['image_file']['name'];
            $type = $_FILES['image_file']['type'];
            $size = $_FILES['image_file']['size'];
            $temp = $_FILES['image_file']['tmp_name'];

            $path = "uploadedimages/" . $image_file; // set upload folder path

            if (empty($customer_name)) {
                $errorMsg = "Please enter customers name";
            } else if (empty($image_file)) {
                $errorMsg = "please Select Image";
            } else if ($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") {
                if (!file_exists($path)) { // check file not exist in your upload folder path
                    if ($size < 5000000) { // check file size 5MB
                        move_uploaded_file($temp, 'uploadedimages/'.$image_file); // move upload file temperory directory to your upload folder
                    } else {
                        $errorMsg = "Your file too large please upload 5MB size"; // error message file size larger than 5mb
                    }
                } else {
                    $errorMsg = "File already exists... Check upload folder"; // error message file not exists your upload folder path
                }
            } else {
                $errorMsg = "Upload JPG, JPEG, PNG & GIF file formate...";
            }

            if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare('INSERT INTO dropoffs(tbl_image_id, date, customer_name, customer_phone, image_file) VALUES (:tbl_image_id, :date, :customer_name, :customer_number, :image_file)');
                $insert_stmt->bindParam(':tbl_image_id', $tbl_image_id);
                $insert_stmt->bindParam(':date', $date);
                $insert_stmt->bindParam(':customer_name', $customer_name);
                $insert_stmt->bindParam(':customer_phone', $customer_phone);
                $insert_stmt->bindParam(':image_file', $image_file);

                if ($insert_stmt->execute()) {
                    $insertMsg = "File Uploaded successfully...";
                    header('refresh:3;dropoffs.php');
                }
            }

        } catch(PDOException $e) {
            $e->getMessage();
        }
    }


?>
  <?php 
            if(isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <strong><?php echo $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <?php 
            if(isset($insertMsg)) {
        ?>
            <div class="alert alert-success">
                <strong><?php echo $insertMsg; ?></strong>
            </div>
        <?php } ?>

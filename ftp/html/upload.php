<!DOCTYPE html>
<html>
<head>
  <title>Upload a file to FTP server</title>
</head>
<body>
  <header>
    <!-- <div class="logo">FTP</div> -->
    <nav>
      <ul>
        <?php
          if (isset($_POST['submit'])) {
            // FTP connection settings
            $ftp_server = "ftp";
            $ftp_username = "IT";
            $ftp_password = "1234";

            // connect to FTP server
            $conn_id = ftp_connect($ftp_server) or die("Could not connect to FTP server");

            // login to FTP server
            if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
              // get the uploaded file
              $file = $_FILES['file']['name'];
              $file_tmp = $_FILES['file']['tmp_name'];

              // upload the file
              if (!empty($file)) {
                // อัปโหลดไฟล์ไปยัง FTP server
                if (ftp_put($conn_id, $file, $file_tmp, FTP_BINARY)) {
                  echo "<script>alert('อัพโหลดไฟล์เรียบร้อยแล้ว');</script>";
                } else {
                  echo "<script>alert('เกิดข้อผิดพลาดขณะอัพโหลดไฟล์');</script>";
                }
              } else {
                echo "<script>alert('กรุณาเลือกไฟล์ที่ต้องการอัปโหลด');</script>";
              }
            } else {
              echo "Filename cannot be empty";
            }
            // close the FTP connection
            ftp_close($conn_id);
          }
        ?>
      </ul>
    </nav>
  </header>

  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="อัพโหลด">
  </form>
  
  <p>กรุณาเลือกไฟล์ที่ต้องการ UPLOAD</p>
</body>
</html>

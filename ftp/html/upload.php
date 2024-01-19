<!DOCTYPE html>
<html>
<head>
  <body>
  <title>Upload a file to FTP server</title>
  <link rel="stylesheet" href="css/style.css">
<head>
            <div class="logo">FTP</div>
            <li>นาย ติณณภพ สีหาชาลี</li>
            <li>นาย หัสดินทร์ นะเรืองรัมย์</li>
</head>
       <body>
       <header>
        <nav>
        <ul>
  <?php
    if (isset($_POST['submit'])) {
      // FTP connection settings
      $ftp_server = "ftp";
      $ftp_username = "bru";
      $ftp_password = "363";

      // connect to FTP server
      $conn_id = ftp_connect($ftp_server) or die("Could not connect to FTP server");

      // login to FTP server
      if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
        // get the uploaded file
        $file = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $remote_file = 'C:\Users\acer\OneDrive\เดสก์ท็อป\Max' . $file;

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
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="อัพโหลด">
  </form>
  </ul>
  </nav>
  </header>
  </body>
</html>

<caption>
<h1>สาขาเทคโนโลยีสารสนเทศ</h1>
</caption>

</body>


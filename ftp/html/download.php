<?php
// กำหนดข้อมูลสำหรับเชื่อมต่อ FTP
$ftp_server = "ftp";
$ftp_username = "IT";
$ftp_password = "1234";

// เชื่อมต่อ FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");

if ($ftp_conn) {
  
    // เข้าสู่ระบบ FTP
    $login = ftp_login($ftp_conn, $ftp_username, $ftp_password);

    if ($login) {
        // ดึงรายชื่อไฟล์ทั้งหมดในเซิร์ฟเวอร์ FTP
        $file_list = ftp_nlist($ftp_conn, ".");

        // ตรวจสอบการร้องขอดาวน์โหลดไฟล์
        if (isset($_GET["file"])) {
            $filename = $_GET["file"];
            $remote_file = $filename;
            $local_file = tempnam(sys_get_temp_dir(), 'download_');

            // ดาวน์โหลดไฟล์
            if (ftp_get($ftp_conn, $local_file, $remote_file, FTP_BINARY)) {
                // กำหนด Content-Type และ Content-Disposition
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_file($finfo, $local_file);
                finfo_close($finfo);

                header('Content-Type: ' . $mime_type);
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                readfile($local_file);

                // ปิดการเชื่อมต่อ FTP
                ftp_close($ftp_conn);
                exit(); // ออกจากการทำงานหลังจากดาวน์โหลดไฟล์เสร็จสิ้น
            } else {
                // หากไม่สามารถดาวน์โหลดไฟล์ได้
                header("HTTP/1.1 500 Internal Server Error");
                exit();
            }
        }

        // แสดงลิงก์ไปยังไฟล์ทั้งหมดในเซิร์ฟเวอร์ FTP
        echo "<h2>ไฟล์ทั้งหมดใน Server</h2>";
        echo "<font face='Arial' size='6'>";
        echo "<ul>";
        foreach ($file_list as $file) {
            echo "<li><a href=\"download.php?file=$file\"> $file</a></li>";
        }
        echo "</ul>";
    } else {
        echo "FTP Login Failed";
    }
} else {
    echo "Error: FTP connection failed";
}
?>
<!-- HTML ส่วนของปุ่มดาวน์โหลด -->
<body>
    <b><font face = "Arial" size = "5"  >คลิกที่ไฟล์เพื่อดาวน์โหลด</font>
</body>

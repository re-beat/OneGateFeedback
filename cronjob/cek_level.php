<?php 
include '../koneksi.php';
$subject = 'Keluhan naik level';
include '../pesan/header.php';

$level1 = mysqli_query($koneksi, "UPDATE tb_aduan set level=0 where TIMESTAMPDIFF(MINUTE, waktu,now()) >= 30 and level=-1") or die(mysqli_error($koneksi));

$level2 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen WHERE 
TIMESTAMPDIFF(DAY, waktu,now()) >= 1 and status='Open' and level = 1");

while($row = mysqli_fetch_array($level2)){
    $text_level2 = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Feedback memasuki level 2</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback dengan nomor aduan '.$row['id_aduan'].' telah memasuk Level 2<br>
        Silahkan pantau pada tautan berikut <a href="'.$link.'Admin/detail_aduan.php?id='.$row["id_aduan"].'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun where id_unit = '".$row['id_unit']."'") or die(mysqli_error($koneksi));
    $mail->msgHTML($text_level2, __DIR__);
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun where id_departemen ='".$row['id_departemen']."' and status='Senior Manager'") or die(mysqli_error($koneksi));
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}

mysqli_query($koneksi,"UPDATE tb_aduan set level=2 where TIMESTAMPDIFF(DAY, waktu,now()) >= 1 and status='Open' and level = 1") or die(mysqli_error($koneksi));


$level3 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen 
WHERE TIMESTAMPDIFF(DAY, waktu,now()) >= 2 and status='Open' and level = 2");

while($row = mysqli_fetch_array($level3)){
    $text_level3 = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>Feedback memasuki level 3</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback dengan nomor aduan '.$row['id_aduan'].' telah memasuk Level 3<br>
        Silahkan pantau pada tautan berikut <a href="'.$link.'Admin/detail_aduan.php?id='.$row["id_aduan"].'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun where id_unit = '".$row['id_unit']."'") or die(mysqli_error($koneksi));
    $mail->msgHTML($text_level3, __DIR__);
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun where id_departemen ='".$row['id_departemen']."' and status='Senior Manager'") or die(mysqli_error($koneksi));
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun 
    where status='AOC Head'") or die(mysqli_error($koneksi));
    
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}

mysqli_query($koneksi,"UPDATE tb_aduan set level=3 where TIMESTAMPDIFF(DAY, waktu,now()) >= 2 and status='Open' and level = 2") or die(mysqli_error($koneksi));


$level4 = mysqli_query($koneksi, "SELECT * FROM tb_aduan 
inner join tb_unit on tb_unit.id_unit = tb_aduan.id_unit 
inner join tb_departemen on tb_departemen.id_departemen = tb_unit.id_departemen 
WHERE TIMESTAMPDIFF(DAY, waktu,now()) >= 3 and status='Open' and level = 3");

while($row = mysqli_fetch_array($level4)){
    
    $text_level4 = '<!DOCTYPE html>
    <html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <title>Feedback Memasuki Level 4</title>
    </head>
    <body>
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
      <div align="left">
        Feedback dengan nomor aduan '.$row['id_aduan'].' telah memasuk Level 4<br>
        Silahkan pantau pada tautan berikut <a href="'.$link.'Admin/detail_aduan.php?id='.$row["id_aduan"].'">Klik Disini</a>
      </div>
    </div>
    </body>
    </html>';
    $mail->msgHTML($text_level4, __DIR__);
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun where id_unit = '".$row['id_unit']."'") or die(mysqli_error($koneksi));
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun where id_departemen ='".$row['id_departemen']."' and status='Senior Manager'") or die(mysqli_error($koneksi));
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
    $email = mysqli_query($koneksi, "SELECT Email, tb_akun.nama as nama from tb_akun 
    where status='General Manager' or status='AOC Head'") or die(mysqli_error($koneksi));
    
    while($row = mysqli_fetch_array($email)){
        $mail->addAddress($row['Email'], $row['nama']);
        if(!$mail->send()){
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}

mysqli_query($koneksi,"UPDATE tb_aduan set level=4 where TIMESTAMPDIFF(DAY, waktu,now()) >= 3 and status='Open' and level = 3") or die(mysqli_error($koneksi));
?>
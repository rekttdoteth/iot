<?php
@session_start();
include "inc/koneksi.php";
if(@$_SESSION['admin']||@$_SESSION['operator']){?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Log Masuk</title>
            <style type="text/css">
                body{
                    font-family:arial;
                    font-size:14px;
                     background-color:#222;
                }
                #utama{
                    width:300px;
                    margin:0 auto;
                    margin-top:12%;
                   
                }
                #judul{
                    padding:15px;
                    text-align:center;
                    color:#fff;
                    font-size:20px;
                    background-color:#339966;
                    border-top-right-radius:10px;
                    border-top-left-radius:10px;
                    border-bottom:3px solid #336666;
                }
                #inputan{
                    background-color:#ccc;
                    padding:20px;
                    border-bottom-right-radius:10px;
                    border-bottom-left-radius:10px;
                    }
                input{
                    padding:10px;
                    border:0;
                    }
                .lg{
                    width:240px;
                    }
                .btn{
                    background-color:#339966;
                    border-radius:10px;
                    color:#fff;
                    width:260px;
                    }
                .btn:hover{
                    background-color:#336666;
                    cursor:pointer;
                    }
            </style>
        </head>
        <body>
            <div id="utama">
            <div id="judul">Login eProfil</div>
            <div id="inputan">
                <form action="" method="post">
                    <div><input type="text" name="user" placeholder="Isi No. KP" class="lg"></div>
                    <div style="margin-top:10px;"><input type="password" name="pass" placeholder="Isi Katalaluan" class="lg"></div>
                    <div style="margin-top:10px;"><input type="submit" name="login" value="login" class="btn" ></div>
                </form>
              <?php
              $user = @$_POST['user'];
              $pass = @$_POST['pass'];
              $login = @$_POST['login'];
              if($login){
              if($user == "" || $pass == ""){
                 ?><script type="text/javascript">alert("username tidak boleh kosong");</script><?php
                 }else{
                  $sql = mysql_query("select * from tb_login where username ='$user' and password = md5('$pass')")or die(mysql_error());
                  $data = mysql_fetch_array($sql);
                  $cek = mysql_num_rows($sql);}
                  if($cek>= 1){
                  if($data['level']=="admin"){
                  @$_SESSION['admin']= $data['kode_user'];
                  header("location: index.php");
                  } else if($data['level']=="operator"){
                  @$_SESSION['operator']= $data['kode_user'];
                  header("location: index.php");
                  }
              }
              ?>
            </div>
            </div>
        </body>
    </html>
<?php
}
?>
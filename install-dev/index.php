<?php
/**
       * --------------------------------------------------------       
       *  |         _____     _   _                           |           
       *  |        | ____|   | | | |                          |            
       *  |        |  _|     | | | |                          |            
       *  |        | |___    | |_| |                          |            
       *  |        |_____|    \___/                           |            
       *  |                                                   |            
       *  | Author:Exist   Email:2035411586@qq.com            |            
       *  | QQ-Group:569208814                                |           
       *  | WebSite:http://frame.eqmemory.cn                  |            
       *  | EU Framework is suitable for Apache2 protocol.    |            
       * --------------------------------------------------------                
*/
require_once dirname(dirname(__FILE__)).'/'.'autoload.php';
use library\EssentialUnifiedInc\EUInc;
use library\EssentialUnifiedMysql\EUMysql;
if(EUInc::SearchFile(EUF_ROOT."/install-dev/essentialunified.lock")):
   header("location:../");
   exit();
endif;
$httpcode=EUInc::HttpCode("http://frame.eqmemory.cn");
$sysinfo=EUInc::GetSystemInfo();
$do=EUInc::SqlCheck($_GET["do"]);
if($do=="db-test"){
   $data=array();
   $db=EUMysql::TestDataBase($_POST["DBHOST"],$_POST["DBPORT"],$_POST["DBUSER"],$_POST["DBPASS"],$_POST["DBNAME"]);
   if(!$db){
      echo"EU-NO";
   }else{
      echo"EU-YES";
   }
}
if($do=="db-save"){
   $info = file_get_contents(EUF_ROOT."/.eu.config"); 
   foreach($_POST as $k=>$v){ 
       $info = preg_replace("/{$k}=(.*)/","{$k}={$v}",$info); 
   }
   file_put_contents(EUF_ROOT."/.eu.config",$info);
   echo "<script>alert('数据库配置成功!');window.location.href='?do=sql'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>EU框架可视化</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.staticfile.org/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.staticfile.org/jquery/3.1.0/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/bootstrap/4.5.3/js/bootstrap.min.js"></script>
    <style>p {margin-bottom:0rem;font-size:14px;}.fontsmall{font-size:12px;}#license p{font-size:11px;}</style>
</head>
<body>
<div class="container">
    <div class="row m-b-md">
           <div class="col-md-12"><img src="<?php echo$config["APPURL"];?>/app/assets/eu-logo.png"></div>
           <div class="col-md-8">
              <div class="border p-2">
               <?php if(empty($do)){?>
                  <p>你即将安装EU框架可视化包，请再次核对协议及请求，并使网络保持通畅。</p>
                  <p>通讯状态：<?php echo$httpcode;?> <?php echo $httpcode=="200" ? "" : "， 因通讯障碍，在线安装可视化包将有极大几率失败。";?></p>
                  <p>PHP版本：<?php echo$sysinfo["PHP"];?></p>
                  <hr/>
               <form action="?do=db-save" method="post" name="form">
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="email">应用域名/IP:</label>
                     <input class="form-control" name="APPURL" id="APPURL" value="<?php echo$config["APPURL"];?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email">EU令牌:</label>
                     <input class="form-control" name="EUCODE" id="EUCODE" value="<?php echo$config["EUCODE"];?>">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="email">数据库服务器:</label>
                     <input class="form-control" name="MYSQL_HOST" id="MYSQL_HOST" value="<?php echo$config["MYSQL_HOST"];?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email">端口:</label>
                     <input class="form-control" name="MYSQL_PORT" id="MYSQL_PORT" value="<?php echo$config["MYSQL_PORT"];?>">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="email">数据库用户:</label>
                     <input class="form-control" name="MYSQL_USER" id="MYSQL_USER" value="<?php echo$config["MYSQL_USER"];?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email">数据库密码:</label>
                     <input class="form-control" name="MYSQL_PASS" id="MYSQL_PASS" value="<?php echo$config["MYSQL_PASS"];?>">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="email">数据库名称:</label>
                     <input class="form-control" name="MYSQL_DB" id="MYSQL_DB" value="<?php echo$config["MYSQL_DB"];?>">
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                  <button type="button" class="btn btn-primary mr-3" onclick="test()">测试数据库连接</button>    
                  <button type="submit" class="btn btn-success">保存设置</button>
                  </div>
               </div>
               </form>
               <script>
                function test(){
                   $.ajax({
                   url:'?do=db-test',
                   type:"post",
                   data:{
                        'DBHOST':$("#MYSQL_HOST").val(),
                        'DBPORT':$("#MYSQL_PORT").val(),
                        'DBNAME':$("#MYSQL_DB").val(),
                        'DBUSER':$("#MYSQL_USER").val(),
                        'DBPASS':$("#MYSQL_PASS").val()
                    },
                    dataType: "text",
                   success: function(data){
                        if(data.indexOf("EU-YES")!=-1){
                         alert("数据库连接成功!");
                      }else{
                         alert("数据库连接失败!");
                      }
                   },
                   failure:function(d){
                      alert("Error");
                   }
                   });
                }
                </script>
               <?php
                  }elseif($do=="sql"){
               ?>
                  <p>你即将导入SQL到数据库，请保持网络通畅。</p>
                  <p>通讯状态：<?php echo$httpcode;?> <?php echo $httpcode=="200" ? "" : "， 因通讯障碍，在线安装可视化包将有极大几率失败。";?></p>
                  <hr/>
                  <?php
                  if($_GET["t"]=="db-sql"){
                     $sql=file_get_contents("./EUDev.sql");
                     $arr=explode(';',$sql);
                     $total=count($arr)-1;
                     $c=0;
                     for($i=0;$i<$total;$i++){
                        $k=$i+1;
                        $result=EUMysql::RunSql($arr[$i]);
                        if($result){
                           echo"<p class='fontsmall'>第".$k."条SQL执行成功!</p>";
                        }else{
                           $c=$c+1;
                           echo"<p class='fontsmall' style='color:red;'>第".$k."条SQL执行失败:".$arr[$i]."</p>";
                        }
                        if($k==$total && $c==0){
                           echo "<script>alert('导入SQL成功!');window.location.href='?do=dev'</script>";
                        }
                     }
                  }
                  ?>
                  <form action="?do=sql&t=db-sql" method="post" name="form">
                  <button type="submit" class="btn btn-success">导入数据</button>
                  </form>
               <?php
                  }elseif($do=="dev"){
               ?>
               <p>你即将部署可视包源码，请保持网络通畅。</p>
               <p>通讯状态：<?php echo$httpcode;?> <?php echo $httpcode=="200" ? "" : "， 因通讯障碍，在线安装可视化包将有极大几率失败。";?></p>
               <p>请将app目录及update目录开启可写权限。权限校验：
                  app: <?php 
                  if(EUInc::FileMode(EUF_ROOT."/app")):
                      $a=0;
                      echo"<font color=green>可写</font>";
                  else:
                      $a=1;
                      echo"<font color=red>不可写</font>";
                  endif;
                  ?> ，
                  update: <?php
                  if(EUInc::FileMode(EUF_ROOT."/update")):
                      $b=0;
                      echo"<font color=green>可写</font>";
                  else:
                      $b=1;
                      echo"<font color=red>不可写</font>";
                  endif;
                  ?> 
            </p>
               <hr/>
               <?php
               $k=intval($a)+intval($b);
               if($k>0){
                  echo"<p>请再次检查文件夹权限!</p>";
               }else{
                  if($_GET["t"]=="db-dev"){
                     $res=EUInc::SaveFile("http://frame.eqmemory.cn/down/EUDev.zip",EUF_ROOT."/update","EUDev.zip",1);
                     if(!empty($res)){
                        $zip=new ZipArchive;
                        if($zip->open(EUF_ROOT."/update/EUDev.zip")===TRUE){ 
                            $zip->extractTo(EUF_ROOT."/update/");
                            $zip->close();
                            EUInc::MoveDir(EUF_ROOT."/update/EUDev/",EUF_ROOT);
                            EUInc::DelDir(EUF_ROOT."/update/EUDev/");
                            unlink(EUF_ROOT."/update/EUDev.zip");
                            file_put_contents("./essentialunified.lock","lock");
                            echo "<script>alert('EU可视化部署成功!');window.location.href='../app/dev/'</script>";
                        }else{
                            echo "<script>alert('文件夹权限不足!');window.location.href='?do=dev'</script>";
                           exit();
                        }
                     }else{
                        echo "<script>alert('请检查网络是否通畅!');window.location.href='?do=dev'</script>";
                     }
                  }
               ?> 
                  <form action="?do=dev&t=db-dev" method="post" name="form">
                     <button type="submit" class="btn btn-success">部署可视包</button>
                  </form>
               <?php }?>
               <?php }?>
              </div>
           </div>
           <div class="col-md-4" id="license">
              <div class="border-bottom mb-2">
                  <strong>EU使用协议</strong>
              </div>
              <p>
                  您需要明确，EU核心（框架）是基于Apache2.0协议使用，
                  您可以通过<a target="_blank" href="http://www.apache.org/licenses/LICENSE-2.0">http://www.apache.org/licenses/LICENSE-2.0</a>了解或<a target="_blank" href="http://www.apache.org/licenses/LICENSE-2.0.txt">下载</a>到详尽的协议内容。
              </p>
              <p>
              You need to be clear that the EU core (framework) is based on the Apache 2.0 protocol, 
              and you can read or <a target="_blank" href="http://www.apache.org/licenses/LICENSE-2.0.txt">download</a> the detailed protocol from the <a target="_blank" href="http://www.apache.org/licenses/LICENSE-2.0">http://www.apache.org/licenses/license-2.0</a>.
              </p>
              <p>
                 您需要明确，EU可视包（EU开发后端）可以免费使用，可以用于商业用途，但必须保证原始著作权人的相应权利不被损害，不得将其任何一部分进行版权注册、抵押或发放许可证，还应当保留相关版权信息。
              </p>
              <p>
                 You need to be clear that the EU visual package (EU development backend) can be used free of charge, can be used for commercial purposes, but must ensure that the corresponding rights of the original copyright owners are not infringed, no part of the copyright shall be registered, mortgaged or licensed, and the relevant copyright information shall be retained.
              </p>
              <p>您自愿使用EU，必须了解可能存在的风险，需要明确EU著作权人与开源参与者不对任何使用EU的行为或目的提供任何明确的或隐含的赔偿或担保。</p>
              <p>
                 If you voluntarily use EU, 
                 you must understand the possible risks and make it clear that 
                 the EU copyright owner and open source participants will not provide any explicit or implicit compensation or guarantee for any behavior or purpose of using EU.
              </p>
              <p>
                 安装EU即表明您已经明确理解并同意相应协议，包括在您所在国的法律法规所允许的范围内合法使用EU，并且独立承担所有法律责任及义务。 
                 那么，您可以完全无后顾之忧地使用EU。
              </p>
              <p>
                 Install EU that you have a clear understanding and consent to the corresponding agreement, 
                 can be in your country's laws and regulations within the scope of use EU, can independently assume all legal responsibilities and obligations. 
                 Then, you can use EU with no worries at all.
              </p>
           </div>
    </div>
</div>
</body>
</html>
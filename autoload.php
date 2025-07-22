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
/**
 * 框架根路径
 */
define('EUF_ROOT', dirname(__FILE__));
/**
 * 应用根路径
 */
define('APP_ROOT', dirname(__FILE__).'/app');
/**
 * 开启SESSION
 */
session_start();
/**
 * 类自动加载
 */
require EUF_ROOT.'/library/EssentialUnifiedLoad.php';
use library\EssentialUnifiedInc\EUInc;
use library\EssentialUnifiedTemp\EUTemp;
use library\EssentialUnifiedRoute\EURoute;
/**
 * 加载配置
 */
$config=EUInc::GetConfig();
/**
 * 禁止配置联网
 */
if(!empty($config["APPURL"]) && EUInc::HttpCode($config["APPURL"]."/.eu.config")=="200"):
    EUInc::GoUrl("-1","Error:The configuration must be disconnected from the network.");
endif;
/**
 * 公共模块
 */
define('PUB_PATH', APP_ROOT.'/modules/'.$config["DEFAULT_MOD"]);
/**
 * 公共模板
 */
define('PUB_TEMP', PUB_PATH.'/skin');
/**
 * 识别路由
 */
foreach(EURoute::Analy(EUInc::CurPageUrl()) as $key=>$val){
    $_GET[$key]=$val;
}
/**
 * 加载模块
 */
$m=empty($_GET["m"]) ? $config["DEFAULT_MOD"] : EUInc::SqlCheck($_GET["m"]);
/**
 * 加载页面
 */
$p=empty($_GET["p"]) ? $config["DEFAULT_PAGE"] : EUInc::SqlCheck(str_replace(".php","",$_GET["p"]));
/**
 * 当前模块
 */
$modpath=APP_ROOT."/modules/".$m;
/**
 * 模板节点
 */
$endpath=EUInc::TempEndPath();
/**
 * 配置模块化模板及模板工程模板
 */ 
$frontwork=APP_ROOT."/template/".$config["TEMPFRONT"];
$adminwork=APP_ROOT."/template/".$config["TEMPADMIN"];
$isdevelop=EUInc::Contain("app/dev",EUInc::CurPageUrl());
/**
 * 开发端
 */
if($config["TEMPADMIN"]!='0' && $isdevelop):
    $skin=$adminwork."/skin/".$m;
    $cache=$skin."/cache";
/**
 * 客户端
 */
elseif($config["TEMPFRONT"]!='0' && !$isdevelop):
    $skin=$frontwork."/skin/".$m;
    $cache=$skin."/cache";
/**
 * 默认配置
 */
else:
    $skin=$modpath."/skin";
    $cache=$modpath."/cache";
endif;
$app=new EUTemp($config["TEMPCACHE"],$skin."/".$endpath,$cache."/".$endpath);
/**
 * 基础绑定
 */
$app->Runin(array("appname","appurl","module","page","editor"),array($config["APPNAME"],$config["APPURL"],$m,$p,$config["EDITOR"]));
/**
 * 语言配置
 */
$app->Runin(array("lang","thelang"),array(explode(",",$config["LANG_OPTION"]),$config["LANG"]));
if(!empty($_COOKIE['Language'])):
    $language=EUInc::SqlCheck($_COOKIE['Language']);
else:
    if($config["LANG"]=="big5"):
        $language="zh";
        setcookie("Language","zh");
        setcookie("chinaspeak","big5");
    else:
        $language=$config["LANG"];
        setcookie("Language",$config["LANG"]);
        setcookie("chinaspeak","");
    endif;
endif;
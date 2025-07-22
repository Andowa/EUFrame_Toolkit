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

require_once dirname(__FILE__).'/'.'autoload.php';
/**
 * 写入前端公共模板路径
 */
$app->Runin("pubtemp",PUB_TEMP."/front");
/**
 * 写入模板工程前端公共路径
 */
$app->Runin("template",$frontwork."/skin/".$config["DEFAULT_MOD"]."/front");
/**
 * 拼接当前文件
 */
$modfile=$modpath."/front/".$p.".php";
/**
 * 判断文件真实性
 */
if(library\EssentialUnifiedInc\EUInc::SearchFile($modfile)){
    /**
     * 引用前端模板
     */
    require_once $modfile;
}else{
    /**
     * 配置公共错误提示
     */
    require_once PUB_PATH.'/front/error.php';
    exit();
}
if($config["DEBUG"]){
    library\EssentialUnifiedDebug\EUDebug::Debug($config["DEBUG_BAR"]);
}
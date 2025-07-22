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
 * Compatible with PSR0
 * 
 */
class Loader{
    public static function AutoLoad($class){
        $class=preg_replace('/(.*)\\\{1}([^\\\]*)/i','$1',$class);
        /*EU built-in function library*/
        $lib_load_file=str_replace('\\','/',EUF_ROOT.'\\'. $class).'.php';
        /*App custom function library*/
        $app_load_file=str_replace('\\','/',APP_ROOT.'\\'. $class).'.php';
        if(file_exists($lib_load_file)){
            require_once $lib_load_file;
        }elseif(file_exists($app_load_file)){
            require_once $app_load_file;
        }
    }
}
spl_autoload_register("Loader::AutoLoad");
/**
 * Compatible with PSR4
 * Composer dependency Library
 */
if(library\EssentialUnifiedInc\EUInc::SearchFile(EUF_ROOT."/vendor/autoload.php")):
    require_once EUF_ROOT.'/vendor/autoload.php';
endif;
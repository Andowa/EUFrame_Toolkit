<?php
namespace library\EssentialUnifiedLang;
use library\EssentialUnifiedInc\EUInc;
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
 * 解析本地化语言包
 */
class EULang{
    /**
     * 获取语言文件列表
     * @return array
     */
    public static function GetLang(){
        $lang=array();
        $path = EUF_ROOT."/lang/";
        $current_dir = opendir($path);
        while(($file = readdir($current_dir)) !== false) {
            $sub_dir = "".$path."/".$file."";
            if($file == '.' || $file == '..') {
                continue;
            }elseif(is_dir($sub_dir)){
                GetLang($sub_dir);
            }elseif(EUInc::Contain("json",$file)){
                $lang[]=EUInc::StrSubstr("lg-",".json",basename($file));
            }
        }
        return $lang;
    }    
    /**
     * 获取单词对应语言包翻译，解析L部分
     * @param string $word 单词
     * @param string $type 语言
     * @return string
     */
    public static function LangData($word,$type=''){
        global$language;
        if(!empty($type)):
            $langdata=json_decode(file_get_contents(EUF_ROOT."/lang/lg-".$type.".json"),true);
        else:
            $langdata=json_decode(file_get_contents(EUF_ROOT."/lang/lg-".$language.".json"),true);
        endif;
        if(array_key_exists($word,$langdata["l"])){
        $langword=$langdata["l"]["".$word.""];
            return $langword;
        }else{
            return $word;
        }
    }
    /**
     * 在模块中获取单词对应语言包翻译，解析L部分
     * @param string $word 单词
     * @return string
     */
    public static function ModLangData($word,$module=''){
        global$language;
        global$modpath;
        if(!empty($module)){
            $langdata=json_decode(file_get_contents(APP_ROOT."/modules/".$module."/lang/lg-".$language.".json"),true);
        }else{
            $langdata=json_decode(file_get_contents($modpath."/lang/lg-".$language.".json"),true);
        }
        if(array_key_exists($word,$langdata["l"])){
            $langword=$langdata["l"]["".$word.""];
            return $langword;
        }else{
            return $word;
        }
    }
    /**
     * 获取语言包设置参数部分，解析S部分
     * @param string $word 单词
     * @param string $type 语言
     * @return string
     */
    public static function LangSet($word,$type=''){
        global$language;
        if(!empty($type)):
            $langdata=json_decode(file_get_contents(EUF_ROOT."/lang/lg-".$type.".json"),true);
        else:
            $langdata=json_decode(file_get_contents(EUF_ROOT."/lang/lg-".$language.".json"),true);
        endif;
        $langword=$langdata["s"]["".$word.""];
        return $langword;
    }
    /**
     * 获取语言包所有内容
     * @param string $path 语言包路径
     * @return array
     */
    public static function Lang($path = EUF_ROOT.'/lang/'){
        $current_dir = opendir($path);
        while(($file = readdir($current_dir)) !== false) {
            if(EssentialUnifiedCMS::contain(".json",$file)!==false):
                $filename=explode(".json",$file);
                $lgfilename=str_replace("lg-","",str_replace($path,"",$filename[0]));
                $lgfile[]=array("speak"=>LangSet("speak",$lgfilename),"lgname"=>$lgfilename);
            endif;
        }
        return $lgfile;
    }
}
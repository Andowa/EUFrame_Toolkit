<?php
namespace library\EssentialUnifiedMongo;
use library\EssentialUnifiedInc;
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
 * 操作MongoDB
 */
class EUMongo{
    /**
     * 连接MongoDB
     */
    public static function GetMongo() {
        $config=EssentialUnifiedInc\EUInc::GetConfig();
        if(PHP_VERSION>=7){
            $db=new \MongoDB\Driver\Manager("mongodb://".$config["MONGO_USER"].":".$config["MONGO_PASS"]."@".$config["MONGO_HOST"].":".$config["MONGO_PORT"]."/".$config["MONGO_DB"]);
        }else{
            $db=new \MongoDB\Driver\Manager("mongodb://".$config["MONGO_HOST"].":".$config["MONGO_PORT"]."/".$config["MONGO_DB"]);
        }
        return $db;
    }
    /**
     * 判断文档是否存在
     * @param string $table
     * @return bool
     */
    public static function ModTable($table){
        $db=EUMongo::GetMongo();
        $filter=["name"=>['$regex'=>'\sw\d']];
        $query=["limit"=>1];
        if(empty(EUMongo::QueryData($table,$filter,$query))){
            return false;
        }else{
            return true;
        }
    }
    /**
     * 获取数据
     * @param  string $table 表
     * @param  array  $filter 条件
     * @param  array  $writeOps 参数
     * @return array
     */
    public static function QueryData($table,array $filter,array $writeOps=[]){
        $cmd = [
            "find"=> $table,
            "filter"=> $filter
        ];
        $cmd += $writeOps;
        return EUMongo::Command($cmd);
    }
    /**
     * 插入数据
     * @param string $table 表
     * @param array  $documents 文档数据
     * @param array  $writeOps  参数
     * @return array
     */
    public static function InsertData($table,array $documents,array $writeOps=[]){
        $cmd = [
            "insert"=> $table,
            "documents"=> $documents,
        ];
        $cmd += $writeOps;
        return EUMongo::Command($cmd);
    }
    /**
     * 删除数据
     * @param  string $table
     * @param  array  $deletes 删除条件
     * @param  array  $writeOps 参数
     * @return array
     */
    public static function DelData($table,array $deletes,array $writeOps=[]) {
        foreach($deletes as &$_){
            if(isset($_["q"]) && !$_["q"]){
                $_["q"] = (Object)[];
            }
            if(isset($_["limit"]) && !$_["limit"]){
                $_["limit"] = 0;
            }
        }
        $cmd = [
            "delete"=> $table,
            "deletes"=> $deletes,
        ];
        $cmd += $writeOps;
        return EUMongo::Command($cmd);
    }
    /**
     * 更新数据
     * @param  string $table writeOps
     * @param  array  $updates 条件
     * @param  array  $writeOps 参数
     * @return array
     */
    public static function UpdateData($table,array $updates,array $writeOps=[]) {
        $cmd = [
            "update"=> $table,
            "updates"=> $updates,
        ];
        $cmd += $writeOps;
        return EUMongo::Command($cmd);
    }
    /**
     * 执行MongoDB命令
     * @param array $param 命令
     * @return array
     */
    public static function Command(array $param) {
        $config=EssentialUnifiedInc\EUInc::GetConfig();
        $db=EUMongo::GetMongo();
        $cmd = new \MongoDB\Driver\Command($param);
        $data=$db->executeCommand($config["MONGO_DB"],$cmd);
        return $data->toArray();
    }
    /**
     * 获取当前连接信息
     * @return array
     */
    public static function GetMongoManager() {
        $db=EUMongo::GetMongo();
        return $db;
    }
}
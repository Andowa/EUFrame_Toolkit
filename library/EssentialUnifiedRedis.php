<?php
namespace library\EssentialUnifiedRedis;
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
 * 操作Redis
 */
class EURedis{
    /**
     * 连接Redis
     */
    public static function GetRedis(){
        $config=EssentialUnifiedInc\EUInc::GetConfig();
        $db=new \Redis();
        $db->connect($config["REDIS_HOST"],$config["REDIS_PORT"]);
        if($config["REDIS_PASS"]!="EU"):
            $db->auth($config["REDIS_PASS"]);
        endif;
        return $db;
    }
    /**
     * 判断元素是否存在
     * @param string $key 键
     * @return bool
     */
    public static function ModTable($key){
        $db=EURedis::GetRedis();
        $res=$db->exists($key);
        if(!$res){
            return false;
        }else{
            return true;
        }
    }
    /**
     * 查询数据
     * @param string|array $key 键，单查xxx或多查array("xxx","yyy")
     * @param string $type 是否批量查询。0为单查，1为多查。
     * @return array
     */
    public static function QueryData($key,$type='0'){
        $db=EURedis::GetRedis();
        if($type==0):
            return json_decode($db->get($key),true);
        else:
            return json_decode($db->mget(json_encode($key)),true);
        endif;
    }
    /**
     * 创建数据
     * @param string $key 键
     * @param string|array $data 值
     * @param int $time 秒，0不设置过期时间，1设置过期时间为DBCACHE_TIME
     * @return bool
     */
    public static function InsertData($key,$data,$time='0'){
        $db=EURedis::GetRedis();
        $data=is_array($data) ? json_encode($data) : $data;
        $config=EssentialUnifiedInc\EUInc::GetConfig();
        if($time==0):
            $db->set($key,$data);
        else:
            $db->set($key,$data,$config["DBCACHE_TIME"]);
        endif;
    }
    /**
     * 编辑数据
     * @param string $key 键
     * @param string|array $data 值
     * @param int $time 秒，0不设置过期时间，1设置过期时间为REDIS_TIME
     * @return bool
     */
    public static function UpdateData($key,$data,$time='0'){
        $db=EURedis::GetRedis();
        $data=is_array($data) ? json_encode($data) : $data;
        if(!EURedis::ModTable($key)):
            return false;
        else:
            if($time==0):
                $db->set($key,$data);
            else:
                $db->set($key,$data,$config["DBCACHE_TIME"]);
            endif;
        endif;
    }
    /**
     * 删除数据
     * @param string $key 键
     */
    public static function DelData($key){
        $db=EURedis::GetRedis();
        $db->del($key);
    }
    /**
     * 批量删除指定前缀的键
     * @param string $pix 前缀
     */
    public static function DelKeys($pix){
        $db=EURedis::GetRedis();
        $keys=$db->keys($pix.'*');
        if(!empty($keys)):
            foreach($keys as $key):
                $db->del($key);
            endforeach;
            return true;
        else:
            return false;
        endif;
    }
    /**
     * 查询所有键及键前缀模糊查询
     * @return array
     */
    public static function QueryKey($key=''){
        $db=EURedis::GetRedis();
        if(!empty($key)){
            return $db->keys($key."*");
        }else{
            return $db->keys("*");
        }
    }
    /**
     * 创建队列任务
     * @param array $array 加入队列的数组
     */
    public static function AddQueue($array){
        $db=EURedis::GetRedis();
        foreach($array as $k=>$v){
            $db->rpush("queue",$v);
        }
    }
    /**
     * 执行队列任务
     * @return array
     */
    public static function RunQueue(){
        $db=EURedis::GetRedis(); 
        $value=$db->lpop('queue');
        if($value):
            echo$value;
        else:
            echo"Queue Complete";
        endif;
    }
    /**
     * 清空当前数据库
     * @return bool
     */
    public static function Clear(){
        $db=EURedis::GetRedis();
        return $db->flushdb();
    }
}
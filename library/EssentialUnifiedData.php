<?php
namespace library\EssentialUnifiedData;
use library\EssentialUnifiedInc;
use library\EssentialUnifiedPdo;
use library\EssentialUnifiedMysql;
use library\EssentialUnifiedMssql;
use library\EssentialUnifiedPgsql;
use library\EssentialUnifiedSqlite;
use library\EssentialUnifiedMongo;
use library\EssentialUnifiedRedis;
use library\EssentialUnifiedMemcache;
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
 * 统一操作数据
 */
class EUData{
    /**
     * 获取主数据库
     */
    public static function GetDb(){
        $config=EssentialUnifiedInc\EUInc::GetConfig();
        return $config["DBTYPE"];
    }
    /**
     * 连接数据库
     */
    public static function GetDatabase(){
        if(EUData::GetDb()=="pdo"){
            return EssentialUnifiedPdo\EUPdo::GetPdo();
        }elseif(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::GetMysql();
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMssql\EUMssql::GetMssql();
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::GetPgsql();
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::GetSqlite();
        }else{
            return false;
        }
    }
    /**
     * 判断表是否存在
     * @param string $table
     * @return bool
     */
    public static function ModTable($table){
        if(EUData::GetDb()=="pdo"){
            return EssentialUnifiedPdo\EUPdo::ModTable($table);
        }elseif(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::ModTable($table);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMssql\EUMssql::ModTable($table);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::ModTable($table);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::ModTable($table);
        }else{
            return false;
        }
    }
    /**
     * 执行SQL或命令
     * @param string $sql SQL语句/命令
     * @return bool
     */
    public static function RunSql($sql){
        if(EUData::GetDb()=="pdo"){
            return EssentialUnifiedPdo\EUPdo::RunSql($sql);
        }elseif(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::RunSql($sql);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMysql\EUMssql::RunSql($sql);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::RunSql($sql);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::RunSql($sql);
        }else{
            return false;
        }
    }
    /**
     * 查询数据
     * @param string $table 被查询表名
     * @param string $field 查询字段，多个字段以‘,’分割
     * @param string $where 查询条件
     * @param string $order 排序方式，例：id desc/id asc
     * @param string|int $limit 数据显示数目，例：0,5/1
     * @param string $lang 是否开启语言识别，默认0关闭，当需要开启时，该参数填写>0的数字，自动获取全局的语言参数，也可以直接填写语言参数zh/en/ja等
     * @param string $cache 是否开启缓存，默认0关闭，需要开启时，该参数填写key名称
     * @return array 返回数组，例：array("querydata"=>array(),"curnum"=>0,"querynum"=>0)
     */
    public static function QueryData($table,$field='',$where='',$order='',$limit='',$lang='0',$cache='0'){
        if($cache==0){
            if(EUData::GetDb()=="pdo"){
                $data=EssentialUnifiedPdo\EUPdo::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="mysql"){
                $data=EssentialUnifiedMysql\EUMysql::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="mssql"){
                $data=EssentialUnifiedMssql\EUMssql::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="pgsql"){
                $data=EssentialUnifiedPgsql\EUPgsql::QueryData($table,$field,$where,$order,$limit,$lang);
            }elseif(EUData::GetDb()=="sqlite"){
                $data=EssentialUnifiedSqlite\EUSqlite::QueryData($table,$field,$where,$order,$limit,$lang);
            }else{
                $data=array();
            }
            return $data;
        }else{
            EUData::GetCache($table,$field,$where,$order,$limit,$lang,$cache);
        }
    }
    /**
     * 执行SQL并返回数据集
     * @param string $sql SQL语句/命令
     * @return bool
     */
    public static function JoinQuery($sql){
        if(EUData::GetDb()=="pdo"){
            return EssentialUnifiedPdo\EUPdo::JoinQuery($sql);
        }elseif(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::JoinQuery($sql);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMysql\EUMssql::JoinQuery($sql);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::JoinQuery($sql);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::JoinQuery($sql);
        }else{
            return false;
        }
    }
    /**
     * 创建数据
     * @param string $table 表名
     * @param array $data 字段及值的数组，例：array("字段1"=>"值1","字段2"=>"值2")
     * @return bool 当结果为真时返回最新添加的记录id
     */
    public static function InsertData($table,$data){
        if(EUData::GetDb()=="pdo"){
            return EssentialUnifiedPdo\EUPdo::InsertData($table,$data);
        }elseif(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::InsertData($table,$data);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMysql\EUMssql::InsertData($table,$data);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::InsertData($table,$data);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::InsertData($table,$data);
        }else{
            return false;
        }
    }
    /**
     * 更新数据
     * @param string $table 表名
     * @param array $data 字段及值的数组，例：array("字段1"=>"值1","字段2"=>"值2")
     * @param string $where 条件
     * @return bool
     */
    public static function UpdateData($table,$data,$where){
        if(EUData::GetDb()=="pdo"){
            return EssentialUnifiedPdo\EUPdo::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMysql\EUMssql::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::UpdateData($table,$data,$where);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::UpdateData($table,$data,$where);
        }else{
            return false;
        }
    }
    /**
     * 删除数据
     * @param string $table 表名
     * @param string $where 条件
     * @return bool
     */
    public static function DelData($table,$where){
        if(EUData::GetDb()=="pdo"){
            return EssentialUnifiedPdo\EUPdo::DelData($table,$where);
        }elseif(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::DelData($table,$where);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMysql\EUMssql::DelData($table,$where);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::DelData($table,$where);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::DelData($table,$where);
        }else{
            return false;
        }
    }
    /**
     * 复制数据
     * @param string $table 表名
     * @param array $where 条件
	 * @param string autokey 自动编号字段
     * @return bool 当结果为真时返回最新添加的记录id
     */
    public static function CopyData($table,$where,$autokey='id'){
        if(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::CopyData($table,$where,$autokey);
        }else{
            return false;
        }
    }
    /**
     * 获取数据标签
     * @param string $table 表名
     * @param string $field 标签字段，只能为1个
     * @param string $where 条件
     * @param string $order 排序方式
     * @param string $lang 是否自动开启语言，默认0关闭
     * @param string $cache 是否开启redis缓存，默认0关闭，需要开启时，该参数填写key名称
     * @return array 返回数组，例：array('tags'=>$taglist)
     */
    public static function TagData($table,$field='',$where='',$order='',$lang='0'){
        if(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::TagData($table,$field,$where,$order,$lang);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMysql\EUMssql::TagData($table,$field,$where,$order,$lang);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::TagData($table,$field,$where,$order,$lang);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::TagData($table,$field,$where,$order,$lang);
        }else{
            return array();
        }
    }
    /**
     * 获取数据首图
     * @param string $table 表名
     * @param string $field 检索字段，只能为1个
     * @param string $where 条件
     * @param string $cache 是否开启redis缓存，默认0关闭，需要开启时，该参数填写key名称
     * @return array 返回数组，在其数组中返回指定字段的第一张图片imageurl
     */
    public static function FigureData($table,$field,$where='',$limit=''){
        if(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::FigureData($table,$field,$where,$limit);
        }elseif(EUData::GetDb()=="mssql"){
            return EssentialUnifiedMysql\EUMssql::FigureData($table,$field,$where,$limit);
        }elseif(EUData::GetDb()=="pgsql"){
            return EssentialUnifiedPgsql\EUPgsql::FigureData($table,$field,$where,$limit);
        }elseif(EUData::GetDb()=="sqlite"){
            return EssentialUnifiedSqlite\EUSqlite::FigureData($table,$field,$where,$limit);
        }else{
            return array();
        }
    }
    /**
     * 搜索数据
     * @param string $keyword 关键词
     * @return array 返回数组
     */
    public static function SearchData($keyword){
        if(EUData::GetDb()=="mysql"){
            return EssentialUnifiedMysql\EUMysql::SearchData($keyword);
        }else{
            return array();
        }	
    }
    /**
     * 获取及更新缓存
     * @param string $cache 键或元素
     * @param string $data 数据
     * @return array
     */
    public static function GetCache($table,$field,$where,$order,$limit,$lang,$cache){
        $config=EssentialUnifiedInc\EUInc::GetConfig();
        $dbcache=$config["DBCACHE"];
        if($dbcache=="redis"):
            if(EssentialUnifiedRedis\EURedis::ModTable($cache)):
                return EssentialUnifiedRedis\EURedis::QueryData($cache);
            else:
                $data=EUData::QueryData($table,$field,$where,$order,$limit,$lang,0);
                EssentialUnifiedRedis\EURedis::InsertData($cache,$data,1);
                return $data;
            endif;
        elseif($dbcache=="mongo"):
            if(EssentialUnifiedMongo\EUMongo::ModTable($cache)):
                return EssentialUnifiedMongo\EUMongo::QueryData($cache);
            else:
                $data=EUData::QueryData($table,$field,$where,$order,$limit,$lang,0);
                EssentialUnifiedMongo\EUMongo::InsertData($cache,$data);
                return $data;
            endif;
        elseif($dbcache=="memcache"):
            if(EssentialUnifiedMemcache\EUMemcache::ModTable($cache)):
                return EssentialUnifiedMemcache\EUMemcache::QueryData($cache);
            else:
                $data=EUData::QueryData($table,$field,$where,$order,$limit,$lang,0);
                EssentialUnifiedMemcache\EUMemcache::InsertData($cache,$data,1);
                return $data;
            endif;
        else:
            return array();
        endif;
    }
    /**
     * 获取记录数目
     * @param string $sql SQL语句
     * @return int 
     */
    public static function QueryNum($sql){
            if(EUData::GetDb()=="pdo"){
                $data=EssentialUnifiedPdo\EUPdo::QueryNum($sql);
            }elseif(EUData::GetDb()=="mysql"){
                $data=EssentialUnifiedMysql\EUMysql::QueryNum($sql);
            }elseif(EUData::GetDb()=="mssql"){
                $data=EssentialUnifiedMssql\EUMssql::QueryNum($sql);
            }elseif(EUData::GetDb()=="pgsql"){
                $data=EssentialUnifiedPgsql\EUPgsql::QueryNum($sql);
            }elseif(EUData::GetDb()=="sqlite"){
                $data=EssentialUnifiedSqlite\EUSqlite::QueryNum($sql);
            }else{
                $data=array();
            }
            return $data;
    }
}
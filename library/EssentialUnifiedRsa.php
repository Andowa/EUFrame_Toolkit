<?php
namespace library\EssentialUnifiedRsa;
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
 * 实例化RSA加密解密
 */
class EURsa{
    function __construct($private_key,$public_key){
        $this->private_key=$private_key;
        $this->public_key=$public_key;
    }
    /**
     * 获取私钥
     * @return bool|resource
     */
    public function GetPrivateKey() {
        $privKey = $this->private_key;
        return openssl_pkey_get_private($privKey);
    }
    /**
     * 获取公钥
     * @return bool|resource
     */
    public function GetPublicKey(){
        $publicKey = $this->public_key;
        return openssl_pkey_get_public($publicKey);
    }
    /**
     * 私钥加密
     * @param string $data
     * @return null|string
     */
    public function PrivEncrypt($data=''){
        if (!is_string($data)) {
            return null;
        }
        return openssl_private_encrypt($data,$encrypted,$this->GetPrivateKey()) ? base64_encode($encrypted) : null;
    }
    /**
     * 公钥加密
     * @param string $data
     * @return null|string
     */
    public function PublicEncrypt($data=''){
        if (!is_string($data)) {
            return null;
        }
        return openssl_public_encrypt($data,$encrypted,$this->GetPublicKey()) ? base64_encode($encrypted) : null;    
    }
    /**
     * 私钥解密
     * @param string $encrypted
     * @return null
     */
    public function PrivDecrypt($encrypted=''){
        if (!is_string($encrypted)) {
            return null;
        }
        return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, $this->GetPrivateKey())) ? $decrypted : null;    
    }
    /**
     * 公钥解密
     * @param string $encrypted
     * @return null
     */
    public function PublicDecrypt($encrypted=''){
        if (!is_string($encrypted)) {
            return null;
        }
    return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, $this->GetPublicKey())) ? $decrypted : null;    
    }
}
<?php
/** 
 * 公钥加密 
 * 
 * @param string 明文  
 * @return string 密文（base64编码） 
 */  
function encodeing($sourcestr)  
{
    $key_content = file_get_contents('./public.key');  
    $pubkeyid    = openssl_get_publickey($key_content);  

    //php.ini 要开启openssl哦
    if (openssl_public_encrypt($sourcestr, $crypttext, $pubkeyid))  
    {
        return base64_encode("".$crypttext);  
    }
}

/** 
 * 私钥解密 
 * 
 * @param string 密文（二进制格式且base64编码）
 * @param string 密文是否来源于JS的RSA加密 
 * @return string 明文 
 */  
function decodeing($crypttext)  
{
    $key_content = file_get_contents('./private.key');  
    $prikeyid    = openssl_get_privatekey($key_content);  
    $crypttext   = base64_decode($crypttext);
    //php.ini 要开启openssl哦
    if (openssl_private_decrypt($crypttext, $sourcestr, $prikeyid, OPENSSL_PKCS1_PADDING))  
    {
        return "".$sourcestr;  
    }
    return ;  
}


if(isset($_POST['password']))
{
	$txt = decodeing($_POST['password']);  
	echo $txt;
}

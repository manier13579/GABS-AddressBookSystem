<?php

//直接访问本文件，重定向到首页
if (substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1) == 'function.php') {
    header('Location:http://'.$_SERVER['HTTP_HOST']);
    exit;
}

if (date_default_timezone_get() != '1Asia/Shanghai') {
    date_default_timezone_set('Asia/Shanghai');
}
//返回当前日期YYYYMMDD
function todayDate()
{
    $showtime = date('Ymd');

    return $showtime;
}

//返回当前时间HHMMSS
function todayTime()
{
    $showtime = date('His');

    return $showtime;
}

//返回第二天日期
function nextDate($date)
{
    $y = substr($date, 0, 4);
    $m = substr($date, 4, 2);
    $d = substr($date, 6, 2);
    $newDate = strtotime(''.$y.'-'.$m.'-'.$d.'');
    $showtime = date('Ymd', strtotime('+1 days', $newDate));

    return $showtime;
}

//获取当前微秒级时间戳
function getMillisecond()
{
    list($t1, $t2) = explode(' ', microtime());

    return sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000000);
}

/**
 * 将字符串分割为数组(支持中文).
 *
 * @param string $str 字符串
 *
 * @return array 分割得到的数组
 */
function mb_str_split($str)
{
    return preg_split('/(?<!^)(?!$)/u', $str);
}

//公钥加密函数
function jiami($data)
{
    $public_key = '-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAJy3y+gQj8yz3s7H92+9gjuEu0MflllS
WPQfZXhiqh9YOvwWr2DPJTTxvMLknj6VtzFUdoDHhEzyZl8HaVIjTZMCAwEAAQ==
-----END PUBLIC KEY-----';
    openssl_public_encrypt($data, $encrypted, $public_key);
    //加密后的内容通常含有特殊字符，需要base64编码转换下
    $encrypted = base64_encode($encrypted);

    return $encrypted;
}

//私钥解密函数
function jiemi($data)
{
    $private_key = '-----BEGIN PRIVATE KEY-----
MIIBVAIBADANBgkqhkiG9w0BAQEFAASCAT4wggE6AgEAAkEAnLfL6BCPzLPezsf3
b72CO4S7Qx+WWVJY9B9leGKqH1g6/BavYM8lNPG8wuSePpW3MVR2gMeETPJmXwdp
UiNNkwIDAQABAkAGD9n0TQey7FY2+2cnzFXIRZcUvpkLNXM5Zil/oZlhAvIrNN4r
pwrr3B0x6RhR3GR+NPutOf3AaLeeqPM2Jw3BAiEA0FYQccq1O3ECvToour0qcC6O
0/59Vs3awu9kgi7lRjMCIQDAkofEjWUXBFv07ZcBZuOEJd379ieKqpHuBtsqSHq7
IQIgZrrJiRLnotPrAdv30X0NvBt5GlfW/kKrqIvbB8aQD7kCICujSNbWf7jmiPwI
tvZfXWE9v37wOeenXWhF73Y2dHFhAiEAlcjL9oo82Djk3Htx61JebYONdkP8e0gQ
aghcf19hRYU=
-----END PRIVATE KEY-----';
    openssl_private_decrypt(base64_decode($data), $decrypted, $private_key);

    return $decrypted;
}

//兼容linux生成GUID的方法
function getGUID(){
	if (function_exists('com_create_guid')){
		return com_create_guid();
	}else{
		mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
		$charid = strtoupper(md5(uniqid(rand(), true)));
		$hyphen = chr(45);// "-"
		$uuid = chr(123)// "{"
			.substr($charid, 0, 8).$hyphen
			.substr($charid, 8, 4).$hyphen
			.substr($charid,12, 4).$hyphen
			.substr($charid,16, 4).$hyphen
			.substr($charid,20,12)
			.chr(125);// "}"
		return $uuid;
	}
}//this function fix linux can not use com_create_guid bug, create by iefreer
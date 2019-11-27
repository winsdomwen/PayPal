/**
* 记录自定义日志
* @author gyj  <375023402@qq.com>
* @createtime 2018-08-24 14:12:01
* @param $msg 错误信息
* @param $type 写入类型 wechat aliyun
* @return [type] [description]
*/
if(!function_exists('log_result')){
  function log_result($msg='',$type='normal')
  {
    $dir = dirname(LOG_PATH)."/log/".$type."/";
    if(!is_dir($dir)){
        mkdir($dir,0777);
    }
    $dir .= date('Ym')."/";
    $file = $dir.date('d').".log";
    if(!is_dir($dir)){
        mkdir($dir,0777);
    }
    file_put_contents($file,date('Y-m-d H:i:s')."\r\n".$msg."\r\n---------------------------------------------------------------\r\n", FILE_APPEND);
  }
  
}
/**
 * 发送post请求
 * @author ganyuanjiang  <3164145970@qq.com>
 * @createtime 2017-07-26 14:06:04
 * @param string $url 请求地址
 * @param array $post_data post键值对数据
 * @return string
 */
if (!function_exists('https_request')) {
    
  function https_request($url,$data=null){
    header("Content-type: text/html; charset=utf-8");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tmpInfo = curl_exec($ch);
    if (curl_errno($ch)) {
      return curl_error($ch);
    }

    curl_close($ch);
    return $tmpInfo;

  }
}
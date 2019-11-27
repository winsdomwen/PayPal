/**
     * 支付回调函数
     * @author gyj <375023402@qq.com>
     * @createtime 2018-08-24T11:38:23+0800
     * @return     
     */
    public function notify(){
        if(!$this->request->isPost()) die();

        //记录支付回调信息
        if(!empty($_POST)){
                $notify_str = "支付回调信息:\r\n";
            foreach ($_POST as $key => $value) {
                $notify_str.=$key."=".$value.";\r\n";
            }
        }
        log_result($notify_str,"paypal");

        //ipn验证
        $data = $_POST;
        $data['cmd'] = '_notify-validate';
        $url = config('paypal.gateway');//支付异步验证地址
        $res = https_request($url,$data);
        //记录支付ipn验证回调信息
        log_result($res,'paypal');
        
        if (!empty($res)) {
            if (strcmp($res, "VERIFIED") == 0) {

                if ($_POST['payment_status'] == 'Completed' || $_POST['payment_status'] == 'Pending') {
                    //付款完成，这里修改订单状态
                    $order_res = $this->order_pay($_POST);
                    if(!$order_res){
                        log_result('update order result fail','paypal');
                    }
                    return 'success';
                }
            } elseif (strcmp($res, "INVALID") == 0) {
                //未通过认证，有可能是编码错误或非法的 POST 信息
                return 'fail';
            }
        } else {
            //未通过认证，有可能是编码错误或非法的 POST 信息

            return 'fail';

        }
        return 'fail';
    }
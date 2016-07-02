<?php
namespace Home\Logic;

use Org\Util\Restfull;
use Think\Log;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/26
 * Time: 19:32
 */

 class UserLogic
{
        //主帐号,对应开官网发者主账号下的 ACCOUNT SID
     const accountSid= "8a48b551506925be01506fbdf15d168d";

    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
     const accountToken= "5a3e04fa351e43759392a27c476d6c20";
        //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
     const appId="8a48b551506925be01506fbeb4591690";
        //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    const serverIP="sandboxapp.cloopen.com";


    //请求端口，生产环境和沙盒环境一致
     const serverPort="8883";

    //REST版本号，在官网文档REST介绍中获得。
     const softVersion='2013-12-26';
    /**
     * 发送模板短信
     * @param to 手机号码集合,用英文逗号分开
     * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
     * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
     */
    public static function sendTemplateSMS($to,$datas,$tempId)
    {
        // 初始化REST SDK
       //global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
        $rest = new Restfull(UserLogic::serverIP,UserLogic::serverPort,UserLogic::softVersion);

        $rest->setAccount(UserLogic::accountSid,UserLogic::accountToken);
        $rest->setAppId(UserLogic::appId);
        // 发送模板短信
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);
        Log::write("AAAADDDD:".json_encode($result),Log::INFO);
        if($result == NULL ) {
            echo "result error!";
            exit(0);
        }
        if($result->statusCode!=0) {
            return -1;
        }else{
           return 1;
        }
    }
}
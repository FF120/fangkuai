<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function Index(){
        echo "·½¿é»¶Ó­Äú¡£¡£¡£";
        $this->redirect('Product/index');
    }
}
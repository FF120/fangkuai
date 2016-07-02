<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 文章控制器类
 * @author 黄涛
 *
 */
class ArticleController extends Controller {
    public function index(){
    	$this->display();
    }
    
    public function add_article() {
        if(!empty($_POST)){
            //实例化文章Model
            $article = new \Admin\Model\ArticleModel();
            //校验且收集表单数据
            $datas = $article->create();
            $datas['create_time'] = date('y-m-d H:i:s', time());
            if($datas){
                $result = $article->add($datas);
                if($result){
                    //$this->redirect([分组/控制器/操作方法]地址，参数， 延迟时间，提示信息);
                    $this->redirect('list_article', array(), 2, '添加文章成功');
                } else{
                    $this->redirect('list_article', array(), 2, '添加文章失败');
                }
            } else{
                dump($article->getError());
                $this->assign('errorInfo', $article->getError());
                $this->display();
            }
        } else{
            $this->display();
        }
    }
    
    /**
     * 修改文章
     * @param $article_id 文章id
     */
    public function update_article($article_id) {
        if(!empty($_POST)){
            //实例化文章Model
            $article = new \Admin\Model\ArticleModel();
            //校验且收集表单数据
            $datas = $article->create();
            $result = $article->save($datas);
            
            if($result){
                //$this->redirect([分组/控制器/操作方法]地址，参数， 延迟时间，提示信息);
                $this->redirect('list_article', array(), 2, '修改文章成功');
            } else{
                $this->redirect('update_article', $datas, 2, '修改文章失败');
            }
        }else {//如果$_POST为空，则为跳转到修改页面
            //实例化文章Model
            $article = new \Admin\Model\ArticleModel();
            //根据文章id查询出文章信息
            $articleInfo = $article->find($article_id);
        
            $this->assign("articleInfo", $articleInfo);
            $this->display();
        }
    }
    
    /**
     * 删除文章
     * @param $article_id 文章id
     */
    public function delete_article() {
        if(!empty($_POST)){
            //实例化文章Model
            $article = new \Admin\Model\ArticleModel();
            $article_id = $_POST['article_id'];
            $result = $article->delete($article_id);
            if($result){
                $this->ajaxReturn(1);
            } else{
                $this->ajaxReturn(0);
            }
        }
    }
    
    /*
     * 文章信息列表
     */
    public function list_article() {
        $sql = "select * from fk_article where 1=1 ";
        if(!empty($_GET)){
            if(isset($_GET['title']) && $_GET['title'] != ""){
                $sql = $sql . " and title like '%".$_GET['title']."%'";
            }
            if(isset($_GET['category']) && $_GET['category'] != ""){
                $sql = $sql . " and category=".$_GET['category'];
                //控制查询下拉列表框
                $this->assign("category", $_GET['category'] + 100);
            }
        }
        //实例化文章Model
        $article = new \Admin\Model\ArticleModel();
        $countSql = "select count(*) as num from " . "(" .$sql." )a";
        //查询总记录数
        $total = $article->query($countSql)[0]['num'];
        //每页条数
        $per = 10;
    
        //实例化分页对象
        $page_obj = new \Admin\Common\Page($total, $per);
    
        //查询现货产品数据
        $sql = $sql." order by create_time desc " . $page_obj->limit;
        $articleInfos = $article->query($sql);
    
        $pagelist = $page_obj->fpage();
    
        //将变量输出到模板
        $this->assign("articleInfos", $articleInfos);
        //分页对象输出到模板
        $this->assign('pagelist', $pagelist);
        //显示模板
        $this->display();
    }
}
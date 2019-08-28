<?php
header('content-type:text/html;charset=utf-8');
//导入导入中文分词工具包分词类
require './pscws4/pscws4.class.php';
class Chinese{
	//分词方法 $str 分词的字符串
	public static function fenci($str){
		// 实例化
		$cws = new PSCWS4();
		//设置字符集
		$cws->set_charset('utf8');
		//设置中华词典（分词的规则）
		$cws->set_dict('./pscws4/etc/dict.utf8.xdb');
		//设置utf8规则
		$cws->set_rule('./pscws4/etc/rules.utf8.ini');
		//忽略标点符号
		$cws->set_ignore(true);
		//传递字符串
		$cws->send_text($str);
		//获取全部的分词结果
		$data=$cws->get_result();
		//打印
		// echo "<pre>";
		// var_dump($data);
		//关闭
		$cws->close();
		return $data;
		
	}
}

//数据库的连接
$pdo=new PDO("mysql:host=localhost;dbname=php217","root","");
$pdo->exec("set names utf8");
//执行sql语句
$list=$pdo->query("select id,name from goods");
//获取结果集
$data1=$list->fetchAll(PDO::FETCH_ASSOC);
//遍历
foreach($data1 as $key=>$value){
	//调用方法 做分词
	$data2=Chinese::fenci($value['name']);
	// var_dump($data2);
	//把分词的结果存储在goods_word
	foreach($data2 as $k=>$v){
		$pdo->exec('insert into goods_word(word,goods_id)values("'.$v['word'].'","'.$value['id'].'")');
	}
}


 ?>
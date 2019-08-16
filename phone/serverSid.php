<?php
//载入ucpass类
require_once('lib/Ucpaas.class.php');

//初始化必填
//填写在开发者控制台首页上的Account Sid
$options['accountsid']='baf281e9006ae0b0e3300773c5ca264d';
//填写在开发者控制台首页上的Auth Token
$options['token']='d467caca8a3be9f4e676917783a42958';

//初始化 $options必填
$ucpass = new Ucpaas($options);
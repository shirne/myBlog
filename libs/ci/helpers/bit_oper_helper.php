<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 字符串当作二进制操作函数
 * 长度没有限制，返回字符串按较长的参数长度
 * 虽然部分函数没有严格检查参数只含 1, 0两个字符
 * 但最好在字符串中只使用这两个字符
 * 目前用于权限模块的检查
 */


//字符串当作二进制位与
if(!function_exists('bit_and'))
{
	function bit_and($n1, $n2){
		$l1=strlen($n1);
		$l2=strlen($n2);
		if($l1 > $l2){
			$n2 = str_repeat('0',$l1-$l2).$n2;
		}
		if($l1 < $l2){
			$n1 = str_repeat('0',$l2-$l1).$n1;
			$l1 = strlen($n1);
		}
		
		for($i=0;$i<$l1;$i++){
			$rst[]=($n1[$i]=='1' && $n2[$i]=='1')?'1':'0';
		}
		
		return implode('',$rst);
	}
}
//字符串当作二进制位或
if(!function_exists('bit_or'))
{
	function bit_or($n1, $n2){
		$l1=strlen($n1);
		$l2=strlen($n2);
		if($l1 > $l2){
			$n2 = str_repeat('0',$l1-$l2).$n2;
		}
		if($l1 < $l2){
			$n1 = str_repeat('0',$l2-$l1).$n1;
			$l1 = strlen($n1);
		}
		
		for($i=0;$i<$l1;$i++){

			$rst[]=($n1[$i]=='1' || $n2[$i]=='1')?'1':'0';
		}
		
		return implode('',$rst);
	}
}

//字符串当作二进制异或
if(!function_exists('bit_xor'))
{
	function bit_xor($n1, $n2){
		$l1=strlen($n1);
		$l2=strlen($n2);
		if($l1 > $l2){
			$n2 = str_repeat('0',$l1-$l2).$n2;
		}
		if($l1 < $l2){
			$n1 = str_repeat('0',$l2-$l1).$n1;
			$l1 = strlen($n1);
		}
		
		for($i=0;$i<$l1;$i++){
			$rst[]=($n1[$i] == $n2[$i])?'0':'1';
		}
		
		return implode('',$rst);
	}
}
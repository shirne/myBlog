<?php

//phpinfo();
//
$str='<a>sdadsad<b>sadasdasd<c>';
preg_match_all('/<(\w)>/ies',$str,$reg);
var_dump($reg);

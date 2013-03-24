<?php
#doc
#    classname:    Model_Log
#    scope:        PUBLIC
#
#/doc

class Model_Files extends MB_Model
{
    function __construct ()
    {
        parent::__construct('admin_log');
    }
    ###
    
    public function add($id,$user, $oprt, $msg=''){
        $row=array(
            'created'=>time(),
            'userid'=>$id,
            'user'=>$user,
            'ip'=>$this->input->ip_address(),
            'log'=>"{$oprt}：$msg"
        );
        $this->save($row);
    }
}
###

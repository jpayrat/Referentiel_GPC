<?php

namespace RefGPC\_systemClass;


class controleurCallView
{
    public function render($filename, $variables) {

        //echo 'plop'.get_class($this);
        extract($variables);
        require(PATH.'_vues/'.$filename.'.php');
    }

}
<?php

namespace PALLAS\App\Models;

class Tagmm
{
public $id_tag;
public $id_post;

    public function __construct($tagmm)
    {
        $this->id_post = (int)$tagmm['id_post'];
        $this->title = (int)$tagmm['id_tag'];
    }
}

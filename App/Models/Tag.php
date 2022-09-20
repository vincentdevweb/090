<?php

namespace PALLAS\App\Models;

class Tag {
    public $id;
    public $name;

    public function __construct($tag_post) {
        $this->id = NULL;
        $this->name = (string)$tag_post['tag'];
    }

}
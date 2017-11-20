<?php

namespace App;

interface ApiModelInterface {

    /**
     * Returns an array of API-safe data
     *
     * @return array
     */
    public function toApi() : array;

}
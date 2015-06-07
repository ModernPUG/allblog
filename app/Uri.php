<?php
/**
 * Created by PhpStorm.
 * User: DrJones
 * Date: 15. 6. 7.
 * Time: 오후 12:36
 */

namespace App;


class Uri {
    public function getHost($url) {
        return new \Wandu\Http\Uri($url);
    }

}
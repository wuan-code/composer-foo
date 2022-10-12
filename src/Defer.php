<?php

/**
 * 自定义命名空间，很composer.json里面的psr-4配置保持一致
 */
namespace WuanCode\ComposerFoo;

use Closure;

/**
 * 参照go 的defer作用，未实现多线程的功能
 */
class Defer {
    /**
     * @var array
     */
    protected  $closures = [];


    /**
     * @param Closure $closure
     */
    public function pushClosure (Closure $closure) {
        array_push($this->closures, $closure);
    }

    /**
     * __destruct
     */
    public function __destruct () {
        foreach (array_reverse($this->closures) as $closure) {
            $closure();
        }
    }
}
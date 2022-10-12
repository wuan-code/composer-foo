<?php

use  WuanCode\ComposerFoo\Tests\TestCase;

class DeferTest extends TestCase {

    public function testDefer () {
        /**
         * PHP 的GC(Garbage Collector)垃圾处理机制 ：
         *       在PHP中，没有任何变量指向这个对象时，这个对象就成为垃圾，PHP会将其在内存中销毁。垃圾加收可以防止内存溢出。
         * __destruct() 析构函数，是在垃圾对象被回收时执行。
         * 所以，必须要有变量，且变量不能重复，否则重复之前的变量就被回收了
         */
        [$_, $__] = [exec_time(), exec_memory()];       //  根据析构函数来实现闭包操作。
        sleep(1);
        $this->assertTrue(true);
    }
}
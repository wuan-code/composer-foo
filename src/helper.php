<?php

use Symfony\Component\Console\Output\ConsoleOutput;
use WuanCode\ComposerFoo\Defer;

if (!function_exists('exec_time')) {
    /**
     * 执行时间
     * @param string $consoleName
     * @return Defer
     */
    function exec_time (string $consoleName = ''): Defer {
        $initMicroTime = microtime(true);
        $title = " {$consoleName}处理用时:";
        $closure = function () use ($title, $initMicroTime) {
            $time = date('Y-m-d H:i:s');
            $useTime = ceil((microtime(true) - $initMicroTime) * 1000);
            $timeStr = $useTime.'ms';
            if ($useTime > 1000) {
                $secondTime = ceil($useTime / 1000);
                $timeStr .= $secondTime > 0 ? " || {$secondTime}s " : "";
            }
            outPutByMode("<info>[$time]{$title}{$timeStr}</info>");
        };
        return deferHelper($closure);
    }
}

if (!function_exists('exec_memory')) {
    /**
     * 执行内存
     * @param string $consoleName
     * @return Defer
     */
    function exec_memory (string $consoleName = ''): Defer {
        $initMemory = memory_get_usage();
        $title = " {$consoleName}内存使用:";
        $closure = function () use ($title, $initMemory) {
            $time = date('Y-m-d H:i:s');
            $useMemory = round((memory_get_usage() - $initMemory) / 1024 / 1024, 2);
            outPutByMode("<info>[$time]{$title}{$useMemory} MB</info>");
        };
        return deferHelper($closure);
    }
}

if (!function_exists('deferHelper')) {
    /**
     * @param Closure $closure
     * @return Defer
     */
    function deferHelper (\Closure $closure): Defer {
        $defer = new Defer();
        $defer->pushClosure($closure);
        return $defer;
    }
}


if (!function_exists('outPutByMode')) {
    /**
     * 根据运行模式，执行输出
     * @param $outPutStr
     * @return void
     */
    function outPutByMode ($outPutStr) {
        $mode = php_sapi_name();
        if ($mode == 'cli') {
            (new ConsoleOutput)->writeln($outPutStr);
            return;
        }
        echo $outPutStr;
    }
}
<?php
if (PHP_OS_FAMILY === "Windows") {
    shell_exec('copylibs.cmd');
} else {
    shell_exec('./copylibs.cmd');
}

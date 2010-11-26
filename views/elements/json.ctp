<?php
$outputT = '%1$s';
if(!empty($this->params['url']['callback'])){
    $outputT = $this->params['url']['callback'].'(%1$s)';
}

echo sprintf($outputT, $javascript->object($output));

echo 'mine!';
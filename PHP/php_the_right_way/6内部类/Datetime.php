<?php

$raw = '22.10.2022';
$start = DateTime::createFromFormat('d.m.Y',$raw);
var_dump($start);
echo 'Start date:'.$start->format('Y-m-d')."\n";
echo 'Start datestamp:'.$start->getTimestamp()."\n";

$end = clone $start;
//var_dump(new DateInterval('P1M5D'));

$end->add(new DateInterval('P30D'));
echo 'End date:'.$end->format('Y-m-d')."\n";

$diff = $end->diff($start);
echo 'Diff: '.$diff->format('%m month, %d days (total: %a days)')."\n";

$reflection = new ReflectionClass($diff);
$res = $reflection->getMethod('format')->getDocComment();

// 由于迭代器判断时不包含等于的情况，所以给结束时间+1s，来保证输出最后一天
$end = $end->modify('+1 second');
$periodIterator = new DatePeriod($start, new DateInterval('P10D'), $end);
//var_dump($periodIterator);
foreach ($periodIterator as $item) {
    echo $item->format('Y-m-d')."\n";
}
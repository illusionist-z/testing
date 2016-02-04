<?php
$config = new Phalcon\Config(array(
	'salary' => array(
        'basic_salary_ssc' => 300000,
        'deduce' => 1000000,
        'overrate' => 30000000
        
    ),
    'position' => array(
        '1' => 'Manager',
        '2' => 'Leader',
        '3' => 'Senior developer',
        '4' => 'Junior developer',
        '5' => 'Office staff'
    ),
    
));

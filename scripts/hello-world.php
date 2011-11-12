<?php

	$hello = array(
		'Hello',
		'Hi there',
		'Howdy',
		'Good day',
		'Greetings',
		'Top of the morning to you',
		'Wassup',
		'Welcome',
		'Bonjour',
		'Zdravstvuitye',
		'Ahlan wa sahlan',
		'Shalom',
		'Jambo',
		'Ni hao',
		'Selamat datang',
		'Guten Tag',
		'Konnichiwa',
		'nuqnaH',
		"Ce'ad mi'le fa'ilte",
		'Fit like',
		'Buenos dias');

	$preposition = array(
		'',
		'my',
		'thou',
		'you',
		'O');

	$adjective = array(
		'alluring',
		'big',
		'boring',
		'brilliant',
		'clumsy',
		'crotchetty',
		'dear',
		'dichotomous',
		'dogmatic',
		'esteemed',
		'heliotrope',
		'illiterate',
		'little',
		'lovely',
		'magenta',
		'nefarious',
		'oblate',
		'odd',
		'old',
		'quantum',
		'schizophrenic',
		'smart',
		'strange',
		'teenage',
		'trendy',
		'verbose',
		'violet',
		'young');

	$noun = array(
		'aardvark',
		'addict',
		'alien',
		'baby',
		'chatbot',
		'chav',
		'computer',
		'dingo',
		'geek',
		'genius',
		'Googler',
		'hacker',
		'intellectual',
		'Jedi',
		'Klingon',
		'lamprey',
		'lark',
		'Microsoftie',
		'nethead',
		'padawan',
		'platypus',
		'poppet',
		'reindeer',
		'robot',
		'student',
		'surfer',
		'trooper',
		'turkey',
		'wolverine',
		'wombat',
		'yak'
		);

	echo $hello[array_rand($hello)];
	echo ', ';
	echo $preposition[array_rand($preposition)];
	echo ' ';
	echo $adjective[array_rand($adjective)];
	echo ' ';
	echo $noun[array_rand($noun)];
	echo '.';

?>
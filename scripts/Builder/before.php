<?php

declare(strict_types = 1);

function makeSqlForUsersBetween18And20(string $dialect) {
    if ($dialect === 'mysql') {
        return "SELECT name, email, password FROM users WHERE age > '18' AND age < '20' LIMIT 10, 20;";
    } elseif ($dialect === 'postgresql') {
        return "SELECT name, email, password FROM users WHERE age > '18' AND age < '30' LIMIT 10 OFFSET 20;";
    } else {
        return '';
    }
}

echo "Testing MySQL query builder:\n";
echo makeSqlForUsersBetween18And20('mysql');

echo "\n\n";

echo "Testing PostgresSQL query builder:\n";
echo makeSqlForUsersBetween18And20('postgresql');
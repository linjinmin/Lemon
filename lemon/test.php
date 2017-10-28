<?php

namespace lemon;

include './Query/Query.php';
include './Container/Container.php';

use lemon\Query\Query;

$query = new Query();
var_dump($query->query('350182'));

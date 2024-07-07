<?php

require 'db_connect.php';

require 'database/seeders/RoleSeeder.php';

require 'database/seeders/PermissionSeeder.php';

require 'database/seeders/RoleHasPermissionSeeder.php';

require 'database/seeders/UserSeeder.php';

$roleSeeder = new RoleSeeder($conn);
$roleSeeder->seed();

$permissionSeeder = new PermissionSeeder($conn);
$permissionSeeder->seed();

$roleHasPermissionSeeder = new RoleHasPermissionSeeder($conn);
$roleHasPermissionSeeder->seed();

$userSeeder = new UserSeeder($conn);
$userSeeder->seed();
<?php

require 'db_connect.php';

require 'database/migrations/CreateUser.php';

require 'database/migrations/CreateRole.php';

require 'database/migrations/CreatePermission.php';

require 'database/migrations/CreateUserHasRole.php';

require 'database/migrations/CreateRoleHasPermission.php';

require 'database/migrations/CreateUserProfile.php';


$createUser = new CreateUser($conn);
$createUser->migrate();

$createRole = new CreateRole($conn);
$createRole->migrate();

$createPermission = new CreatePermission($conn);
$createPermission->migrate();

$createUserHasRole = new CreateUserHasRole($conn);
$createUserHasRole->migrate();

$createRoleHasPermission = new CreateRoleHasPermission($conn);
$createRoleHasPermission->migrate();

$createUserProfile = new CreateUserProfile($conn);
$createUserProfile->migrate();
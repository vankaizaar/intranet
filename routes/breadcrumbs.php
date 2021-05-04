<?php

declare(strict_types=1);

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//Screens

// Platform 

// Platform > Staff Directory
Breadcrumbs::for('icpac.staff.view', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Staff Directory'), route('icpac.staff.view'));
});


// Platform > System > Users
Breadcrumbs::for('platform.systems.users', function ($trail) {
    $trail->parent('platform.systems.index');
    $trail->push(__('Users'), route('platform.systems.users'));
});

// Platform > System > Users > Create
Breadcrumbs::for('platform.systems.users.create', function ($trail) {
    $trail->parent('platform.systems.users');
    $trail->push(__('Create'), route('platform.systems.users.create'));
});

// Platform > System > Users > Edit
Breadcrumbs::for('platform.systems.users.edit', function ($trail, $user) {
    $trail->parent('platform.systems.users');
    $trail->push(__('Edit'), route('platform.systems.users.edit', $user));
});

// Platform > Your Profile
Breadcrumbs::for('icpac.user.edit', function ($trail, $user) {
    $trail->parent('platform.index');
    $trail->push(__('Your Profile'), route('icpac.user.edit', $user));
});

// Platform > Your Password
Breadcrumbs::for('icpac.user.password.edit', function ($trail, $user) {
    $trail->parent('platform.index');
    $trail->push(__('Your Password'), route('icpac.user.password.edit', $user));
});


// Platform > System > Roles
Breadcrumbs::for('platform.systems.roles', function ($trail) {
    $trail->parent('platform.systems.index');
    $trail->push(__('Roles'), route('platform.systems.roles'));
});

// Platform > System > Roles > Create
Breadcrumbs::for('platform.systems.roles.create', function ($trail) {
    $trail->parent('platform.systems.roles');
    $trail->push(__('Create'), route('platform.systems.roles.create'));
});

// Platform > System > Roles > Role
Breadcrumbs::for('platform.systems.roles.edit', function ($trail, $role) {
    $trail->parent('platform.systems.roles');
    $trail->push(__('Role'), route('platform.systems.roles.edit', $role));
});

// Platform -> Example
Breadcrumbs::for('platform.example', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Example'));
});

// Platform -> Departments
Breadcrumbs::for('department.list', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Departments'), route('department.list'));
});

// Platform > Departments > Create
Breadcrumbs::for('department.create', function ($trail) {
    $trail->parent('department.list');
    $trail->push(__('Create'), route('department.create'));
});

// Platform > Departments > View
Breadcrumbs::for('department.view', function ($trail, $department) {
    $trail->parent('department.list');
    $trail->push(__('View'), route('department.view', $department));
});

// Platform > Departments > Edit
Breadcrumbs::for('department.edit', function ($trail, $department) {
    $trail->parent('department.list');
    $trail->push(__('Edit'), route('department.edit', $department));
});

// Platform -> Projects
Breadcrumbs::for('project.list', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Projects'), route('project.list'));
});

// Platform > Projects > Create
Breadcrumbs::for('project.create', function ($trail) {
    $trail->parent('project.list');
    $trail->push(__('Create'), route('project.create'));
});

// Platform > Projects > View
Breadcrumbs::for('project.view', function ($trail, $project) {
    $trail->parent('project.list');
    $trail->push(__('View'), route('project.view', $project));
});

// Platform > Projects > Edit
Breadcrumbs::for('project.edit', function ($trail, $project) {
    $trail->parent('project.list');
    $trail->push(__('Edit'), route('project.edit', $project));
});

// Platform -> Projects
Breadcrumbs::for('projectfile.list', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Projects Files'), route('project.list'));
});

// Platform > Projects > Create
Breadcrumbs::for('projectfile.create', function ($trail) {
    $trail->parent('projectfile.list');
    $trail->push(__('Create'), route('projectfile.create'));
});

// Platform > Projects > View
Breadcrumbs::for('projectfile.view', function ($trail, $projectfile) {
    $trail->parent('projectfile.list');
    $trail->push(__('View'), route('projectfile.view', $projectfile));
});

// Platform > Projects > Edit
Breadcrumbs::for('projectfile.edit', function ($trail, $projectfile) {
    $trail->parent('projectfile.list');
    $trail->push(__('Edit'), route('projectfile.edit', $projectfile));
});


// Platform -> Document Category
Breadcrumbs::for('documentcategory.list', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Document Categories'), route('documentcategory.list'));
});

// Platform > Document Category > Create
Breadcrumbs::for('documentcategory.create', function ($trail) {
    $trail->parent('documentcategory.list');
    $trail->push(__('Create'), route('documentcategory.create'));
});

// Platform > Document Category > View
Breadcrumbs::for('documentcategory.view', function ($trail, $documentcategory) {
    $trail->parent('documentcategory.list');
    $trail->push(__('View'), route('documentcategory.view', $documentcategory));
});

// Platform > Document Category > Edit
Breadcrumbs::for('documentcategory.edit', function ($trail, $documentcategory) {
    $trail->parent('documentcategory.list');
    $trail->push(__('Edit'), route('documentcategory.edit', $documentcategory));
});


// Platform -> Documents
Breadcrumbs::for('document.list', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Document'), route('documentcategory.list'));
});

// Platform > Documents > Create
Breadcrumbs::for('document.create', function ($trail) {
    $trail->parent('document.list');
    $trail->push(__('Create'), route('document.create'));
});

// Platform > Documents > View
Breadcrumbs::for('document.view', function ($trail, $document) {
    $trail->parent('document.list');
    $trail->push(__('View'), route('document.view', $document));
});

// Platform > Documents > Edit
Breadcrumbs::for('document.edit', function ($trail, $document) {
    $trail->parent('document.list');
    $trail->push(__('Edit'), route('document.edit', $document));
});

// Platform -> Rooms
Breadcrumbs::for('room.list', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Meeting Rooms'), route('room.list'));
});

// Platform > Rooms > Create
Breadcrumbs::for('room.create', function ($trail) {
    $trail->parent('room.list');
    $trail->push(__('Create'), route('room.create'));
});

// Platform > Rooms > View
Breadcrumbs::for('room.view', function ($trail, $room) {
    $trail->parent('room.list');
    $trail->push(__('View'), route('room.view', $room));
});

// Platform > Rooms > Edit
Breadcrumbs::for('room.edit', function ($trail, $room) {
    $trail->parent('room.list');
    $trail->push(__('Edit'), route('room.edit', $room));
});


// Platform -> RoomBookings
Breadcrumbs::for('roombooking.list', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Meeting Room Booking'), route('room.list'));
});

// Platform > Rooms > Create
Breadcrumbs::for('roombooking.create', function ($trail) {
    $trail->parent('roombooking.list');
    $trail->push(__('Create'), route('roombooking.create'));
});

// Platform > Rooms > View
Breadcrumbs::for('roombooking.view', function ($trail, $roombooking) {
    $trail->parent('roombooking.list');
    $trail->push(__('View'), route('roombooking.view', $roombooking));
});

// Platform > Rooms > Edit
Breadcrumbs::for('roombooking.edit', function ($trail, $roombooking) {
    $trail->parent('roombooking.list');
    $trail->push(__('Edit'), route('roombooking.edit', $roombooking));
});

// Platform > events 
Breadcrumbs::for('icpac.calendar.view', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Events'), route('icpac.calendar.view'));
});

// Platform > events > create
Breadcrumbs::for('icpac.event.create', function ($trail) {
    $trail->parent('icpac.calendar.view');
    $trail->push(__('Create'), route('icpac.event.create'));
});


// Platform > events > list
Breadcrumbs::for('icpac.event.list', function ($trail) {
    $trail->parent('icpac.calendar.view');
    $trail->push(__('List'), route('icpac.event.list'));
});

// Platform > events > edit
Breadcrumbs::for('icpac.event.edit', function ($trail, $events) {
    $trail->parent('icpac.calendar.view');
    $trail->push(__('Edit'), route('icpac.event.edit',$events));
});

// Platform > Positions
Breadcrumbs::for('platform.systems.positions', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('Positions'), route('platform.systems.positions'));
});


// Platform > Positions > edit
Breadcrumbs::for('platform.systems.positions.edit', function ($trail, $events) {
    $trail->parent('platform.systems.positions');
    $trail->push(__('Edit'), route('platform.systems.positions.edit',$events));
});


// Platform > Positions > create
Breadcrumbs::for('platform.systems.positions.create', function ($trail) {
    $trail->parent('platform.systems.positions');
    $trail->push(__('Create'), route('platform.systems.positions.create'));
});

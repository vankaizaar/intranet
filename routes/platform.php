<?php

declare (strict_types=1);

use App\Orchid\Screens\icpac\Department\DepartmentEditScreen;
use App\Orchid\Screens\icpac\Department\DepartmentListScreen;
use App\Orchid\Screens\icpac\Department\DepartmentPublicListScreen;
use App\Orchid\Screens\icpac\Department\DepartmentViewScreen;
use App\Orchid\Screens\icpac\DocumentCategory\DocumentCategoryEditScreen;
use App\Orchid\Screens\icpac\DocumentCategory\DocumentCategoryListScreen;
use App\Orchid\Screens\icpac\DocumentCategory\DocumentCategoryPublicListScreen;
use App\Orchid\Screens\icpac\DocumentCategory\DocumentCategoryViewScreen;
use App\Orchid\Screens\icpac\Document\DocumentEditScreen;
use App\Orchid\Screens\icpac\Document\DocumentListScreen;
use App\Orchid\Screens\icpac\Document\DocumentViewScreen;
use App\Orchid\Screens\icpac\Event\EventEditScreen;
use App\Orchid\Screens\icpac\Event\EventListScreen;
use App\Orchid\Screens\icpac\Event\EventsPageScreen;
use App\Orchid\Screens\icpac\Event\EventViewScreen;
use App\Orchid\Screens\icpac\MediaCategory\MediaCategoryEditScreen;
use App\Orchid\Screens\icpac\MediaCategory\MediaCategoryListScreen;
use App\Orchid\Screens\icpac\MediaCategory\MediaCategoryViewScreen;
use App\Orchid\Screens\icpac\Media\MediaEditScreen;
use App\Orchid\Screens\icpac\Media\MediaListScreen;
use App\Orchid\Screens\icpac\Media\MediaViewScreen;
use App\Orchid\Screens\icpac\Position\PositionEditScreen;
use App\Orchid\Screens\icpac\Position\PositionListScreen;
use App\Orchid\Screens\icpac\Projectfile\ProjectfileEditScreen;
use App\Orchid\Screens\icpac\Projectfile\ProjectfileListScreen;
use App\Orchid\Screens\icpac\Projectfile\ProjectfileViewScreen;
use App\Orchid\Screens\icpac\Project\ProjectEditScreen;
use App\Orchid\Screens\icpac\Project\ProjectListScreen;
use App\Orchid\Screens\icpac\Project\ProjectPublicListScreen;
use App\Orchid\Screens\icpac\Project\ProjectViewScreen;
use App\Orchid\Screens\icpac\RoomBooking\RoomBookingEditScreen;
use App\Orchid\Screens\icpac\RoomBooking\RoomBookingListScreen;
use App\Orchid\Screens\icpac\RoomBooking\RoomBookingViewScreen;
use App\Orchid\Screens\icpac\Room\RoomEditScreen;
use App\Orchid\Screens\icpac\Room\RoomListScreen;
use App\Orchid\Screens\icpac\Room\RoomPublicListScreen;
use App\Orchid\Screens\icpac\Room\RoomViewScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\PasswordEditScreen;
use App\Orchid\Screens\User\StaffListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileEditScreen;
use App\Orchid\Screens\User\UserCreateScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
 */

// Main
$this->router->screen('/main', PlatformScreen::class)->name('platform.main');

// Users...
$this->router->screen('users/{users}/password/edit', PasswordEditScreen::class)->name('icpac.user.password.edit');
$this->router->screen('users/{users}/profile/edit', UserProfileEditScreen::class)->name('icpac.user.edit');
$this->router->screen('users/{users}/edit', UserEditScreen::class)->name('platform.systems.users.edit');
$this->router->screen('users/create', UserCreateScreen::class)->name('platform.systems.users.create');
$this->router->screen('users', UserListScreen::class)->name('platform.systems.users');

//Positions
$this->router->screen('positions/{positions?}/edit', PositionEditScreen::class)->name('platform.systems.positions.edit');
$this->router->screen('positions/create', PositionEditScreen::class)->name('platform.systems.positions.create');
$this->router->screen('positions', PositionListScreen::class)->name('platform.systems.positions');

// Roles...
$this->router->screen('roles/{roles}/edit', RoleEditScreen::class)->name('platform.systems.roles.edit');
$this->router->screen('roles/create', RoleEditScreen::class)->name('platform.systems.roles.create');
$this->router->screen('roles', RoleListScreen::class)->name('platform.systems.roles');

//Departments
$this->router->screen('departments/{departments?}/view', DepartmentViewScreen::class)->name('department.view');
$this->router->screen('departments/{departments?}/edit', DepartmentEditScreen::class)->name('department.edit');
$this->router->screen('departments/create', DepartmentEditScreen::class)->name('department.create');
$this->router->screen('departments/public', DepartmentPublicListScreen::class)->name('department.list');
$this->router->screen('departments', DepartmentListScreen::class)->name('icpac.department.list');

//Projects
$this->router->screen('projects/{projects?}/view', ProjectViewScreen::class)->name('project.view');
$this->router->screen('projects/{projects?}/edit', ProjectEditScreen::class)->name('project.edit');
$this->router->screen('projects/create', ProjectEditScreen::class)->name('project.create');
//$this->router->screen('projects/public', ProjectPublicListScreen::class)->name('project.list');
$this->router->get('projects/public', function () {
    return view('vendor.platform.test');
})->name('project.list');
$this->router->screen('projects', ProjectListScreen::class)->name('icpac.project.list');

//Media Categories
$this->router->screen('mediacategories/{mediacategories?}/view', MediaCategoryViewScreen::class)->name('icpac.mediacategory.view');
$this->router->screen('mediacategories/{mediacategories?}/edit', MediaCategoryEditScreen::class)->name('icpac.mediacategory.edit');
$this->router->screen('mediacategories/create', MediaCategoryEditScreen::class)->name('icpac.mediacategory.create');
$this->router->screen('mediacategories', MediaCategoryListScreen::class)->name('icpac.mediacategory.list');

//Media
$this->router->screen('medias/{medias?}/view', MediaViewScreen::class)->name('icpac.media.view');
$this->router->screen('medias/{medias?}/edit', MediaEditScreen::class)->name('icpac.media.edit');
$this->router->screen('medias/create', MediaEditScreen::class)->name('icpac.media.create');
$this->router->screen('medias', MediaListScreen::class)->name('icpac.media.list');

//Document Categories
$this->router->screen('documentcategories/{documentcategories?}/view', DocumentCategoryViewScreen::class)->name('documentcategory.view');
$this->router->screen('documentcategories/{documentcategories?}/edit', DocumentCategoryEditScreen::class)->name('documentcategory.edit');
$this->router->screen('documentcategories/create', DocumentCategoryEditScreen::class)->name('documentcategory.create');
$this->router->screen('documentcategories/public', DocumentCategoryPublicListScreen::class)->name('documentcategory.list');
$this->router->screen('documentcategories', DocumentCategoryListScreen::class)->name('icpac.documentcategory.list');

//Document
$this->router->screen('documents/{documents?}/view', DocumentViewScreen::class)->name('document.view');
$this->router->screen('documents/{documents?}/edit', DocumentEditScreen::class)->name('document.edit');
$this->router->screen('documents/create', DocumentEditScreen::class)->name('document.create');
$this->router->screen('documents', DocumentListScreen::class)->name('document.list');

//Projectfile
$this->router->screen('projectfiles/{projectfiles?}/view', ProjectfileViewScreen::class)->name('projectfile.view');
$this->router->screen('projectfiles/{projectfiles?}/edit', ProjectfileEditScreen::class)->name('projectfile.edit');
$this->router->screen('projectfiles/create', ProjectfileEditScreen::class)->name('projectfile.create');
$this->router->screen('projectfiles', ProjectfileListScreen::class)->name('projectfile.list');

//Event
$this->router->screen('events/calendar/view', EventsPageScreen::class)->name('icpac.calendar.view');
$this->router->screen('events/{events?}/view', EventViewScreen::class)->name('icpac.event.view');
$this->router->screen('events/{events?}/edit', EventEditScreen::class)->name('icpac.event.edit');
$this->router->screen('events/create', EventEditScreen::class)->name('icpac.event.create');
$this->router->screen('events', EventListScreen::class)->name('icpac.event.list');

//Room
$this->router->screen('rooms/{rooms?}/view', RoomViewScreen::class)->name('room.view');
$this->router->screen('rooms/{rooms?}/edit', RoomEditScreen::class)->name('room.edit');
$this->router->screen('rooms/create', RoomEditScreen::class)->name('room.create');
$this->router->screen('rooms/public', RoomPublicListScreen::class)->name('room.list');
$this->router->screen('rooms', RoomListScreen::class)->name('icpac.room.list');

//Room Booking
$this->router->screen('roombookings/{roombookings?}/view', RoomBookingViewScreen::class)->name('roombooking.view');
$this->router->screen('roombookings/{roombookings?}/edit', RoomBookingEditScreen::class)->name('roombooking.edit');
$this->router->screen('roombookings/create', RoomBookingEditScreen::class)->name('roombooking.create');
$this->router->screen('roombookings', RoomBookingListScreen::class)->name('roombooking.list');

// Staff
$this->router->screen('staff', StaffListScreen::class)->name('icpac.staff.view');

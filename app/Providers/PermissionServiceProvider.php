<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $allSystemPermissions = ItemPermission::group('Section Administrative Permissions')
            ->addPermission('edit_document', 'Edit Documents')
            ->addPermission('edit_department', 'Edit Departments')
            ->addPermission('edit_projects', 'Edit Projects')
            ->addPermission('edit_project_files', 'Edit Project Files')
            ->addPermission('edit_document_categories', 'Edit Document Categories')
            ->addPermission('edit_meeting_rooms', 'Edit Meeting Rooms')
            ->addPermission('edit_meeting_rooms_bookings', 'Edit Meeting Rooms Bookings')
            ->addPermission('edit_events', 'Edit Events');

        $positionsPermissions = ItemPermission::group('Systems')
            ->addPermission('platform.systems.positions', 'Positions');

        $dashboard->registerPermissions($positionsPermissions);
        $dashboard->registerPermissions($allSystemPermissions);

    }
}

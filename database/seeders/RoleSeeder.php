<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::query()->truncate();
        Schema::enableForeignKeyConstraints();
        if (Role::count() == 0) {
            $data = [
                ['name' => 'Admin'],
                ['name' => 'Employee'],
            ];
            Role::insert($data);
        }

        $permissions = [
            array(
                "key" => "dashboards-default",
                "path" => "/dashboards/default",
                "title" => "Dashboard",
                "icon" => "DashboardOutlined",
                "breadcrumb" => false,
                "submenu" => [],
            ),
            array(
                "key" => "dashboards-master",
                "path" => "",
                "title" => "Master",
                "icon" => "OrderedListOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-coursetype",
                        "path" => "/dashboards/coursetype",
                        "title" => "Department",
                        "icon" => "UnorderedListOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Department List", "Add Department", "Department edit", "Department delete"),
                    ),
                    array(
                        "key" => "dashboards-designation",
                        "path" => "/dashboards/designation",
                        "title" => "Designation",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Designation List", "Add Designation", "Designation edit", "Designation delete"),
                    ),
                    array(
                        "key" => "dashboards-leave",
                        "path" => "/dashboards/leave",
                        "title" => "Leave",
                        "icon" => "FormOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Leave List", "Add Leave", "Leave edit", "Leave delete"),
                    ),
                    array(
                        "key" => "dashboards-documents",
                        "path" => "/dashboards/documents",
                        "title" => "Documents",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Documents List", "Add Documents", "Documents edit", "Documents delete"),
                    ),
                    array(
                        "key" => "dashboards-status",
                        "path" => "/dashboards/status",
                        "title" => "Status",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Status List", "Add Status", "Status edit", "Status delete"),
                    ),
                    array(
                        "key" => "dashboards-getstatus",
                        "path" => "/dashboards/getstatus",
                        "title" => "GET Status",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Get Status List", "Add Get Status", "Get Status edit", "Get Status delete"),
                    ),
                ),
            )
        ];
    }
}

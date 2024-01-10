<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::query()->delete(); //->truncate()
        Schema::disableForeignKeyConstraints();
        Permission::query()->truncate();
        Schema::enableForeignKeyConstraints();
        if (Role::count() == 0) {
            $data = [
                ['name' => 'Admin'],
                ['name' => 'Student'],
                ['name' => 'Partner'],
                ['name' => 'Get Employee'],
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
                        "title" => "Course Type",
                        "icon" => "UnorderedListOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Course Type List", "Add Course Type", "Course Type edit", "Course Type delete"),
                    ),
                    array(
                        "key" => "dashboards-course",
                        "path" => "/dashboards/course",
                        "title" => "Course",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Course List", "Add Course", "Course edit", "Course delete"),
                    ),
                    array(
                        "key" => "dashboards-question",
                        "path" => "/dashboards/question",
                        "title" => "Question",
                        "icon" => "FormOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Question List", "Add Question", "Question edit", "Question delete"),
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
            ),
            array(
                "key" => "dashboards-university",
                "path" => "",
                "title" => "University",
                "icon" => "BankOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-college",
                        "path" => "/dashboards/college",
                        "title" => "College",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("College List", "College edit", "College delete", "College Bulk Upload", "College Course List", "College Course Add", "College Course Edit", "College Course Delete"),
                    ),
                    array(
                        "key" => "dashboards-college-add",
                        "path" => "/dashboards/college-add",
                        "title" => "Add College",
                        "icon" => "FileAddOutlined",
                        "breadcrumb" => false,
                        "submenu" => array(),
                    )
                ),
            ),
            array(
                "key" => "dashboards-leads",
                "path" => "",
                "title" => "Leads",
                "icon" => "UserOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-student",
                        "path" => "/dashboards/student",
                        "title" => "Student List",
                        "icon" => "UserOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Student edit", "Student detail", "Student delete", "Create Application", "Application List", "Delete Application", "View Application", "Application Get Status Edit", "Add Document", "Document Upload", "delete Document", "Document Download", "Update Document Status", "University Document", "Add University Document", "Remove University Document", "University Document Download"),
                    ),
                    array(
                        "key" => "dashboards-student-add",
                        "path" => "/dashboards/student-add",
                        "title" => "Add Student",
                        "icon" => "UsergroupAddOutlined",
                        "breadcrumb" => false,
                        "submenu" => []
                    ),
                    array(
                        "key" => "dashboards-search-apply",
                        "path" => "/dashboards/search-apply",
                        "title" => "Search and Apply",
                        "icon" => "FileSearchOutlined",
                        "breadcrumb" => false,
                        "submenu" => []
                    )
                ),
            ),
            array(
                "key" => "dashboards-setting",
                "path" => "",
                "title" => "Settings",
                "icon" => "SettingOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-role",
                        "path" => "/dashboards/roles",
                        "title" => "Roles",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Role List", "Add Role", "Edit Role", "Delete Role"),
                    ),
                    array(
                        "key" => "dashboards-permission",
                        "path" => "/dashboards/permissions",
                        "title" => "Permissions",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("List Permission", "Edit Permission"),
                    ),
                    array(
                        "key" => "dashboards-user",
                        "path" => "/dashboards/users",
                        "title" => "Users",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Add User", "Edit User", "Delete User", "Get Employee List", "Partner List", "Add Partner Employee"),
                    ),
                ),
            ),
            array(
                "key" => "dashboards-invoice",
                "path" => "",
                "title" => "Invoice",
                "icon" => "DollarOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-invoice-list",
                        "path" => "/dashboards/invoice",
                        "title" => "Invoice List",
                        "icon" => "DollarOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Add Invoice", "edit Invoice", "delete Invoice"),
                    )
                ),
            ),
            array(
                "key" => "dashboards-payouts",
                "path" => "",
                "title" => "Payouts",
                "icon" => "FileTextOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-payouts-list",
                        "path" => "/dashboards/payouts",
                        "title" => "Payout List",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Add Payout", "Edit Payout", "Delete Payout", "Payout Bulk Upload"),
                    )
                ),
            ), array(
                "parent_id" => 45,
                "title" => "Update Student Status",
                "submenu" => []
            ),
            array(
                "key" => "dashboards-notice",
                "path" => "",
                "title" => "Notice",
                "icon" => "NotificationOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-notice-list",
                        "path" => "/dashboards/notice",
                        "title" => "Notice List",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => array("Edit Notice", "Delete Notice"),
                    )
                ),
                array(
                    "key" => "dashboards-notice-add",
                    "path" => "/dashboards/notice-add",
                    "title" => "Add Notice",
                    "icon" => "FileAddOutlined",
                    "breadcrumb" => false,
                    "submenu" => []
                )
            ),
            array(
                "parent_id" => 45,
                "title" => "Assign Student",
                "submenu" => []
            ), array(
                "parent_id" => 45,
                "title" => "Credentials List",
                "submenu" => [],
            ),
            array(
                "parent_id" => 45,
                "title" => "Credentials Add",
                "submenu" => []
            ),
            array(
                "parent_id" => 45,
                "title" => "Credentials Delete",
                "submenu" => []
            ),
            array(
                "parent_id" => 45,
                "title" => "History",
                "submenu" => []
            ),
            array(
                "key" => "dashboards-report",
                "path" => "",
                "title" => "MIS",
                "icon" => "FileTextOutlined",
                "breadcrumb" => false,
                "submenu" => array(
                    array(
                        "key" => "dashboards-report-student",
                        "path" => "/dashboards/mis/student",
                        "title" => "Student",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => [],
                    ),
                    array(
                        "key" => "dashboards-report-application",
                        "path" => "/dashboards/mis/application",
                        "title" => "Application",
                        "icon" => "FileTextOutlined",
                        "breadcrumb" => false,
                        "submenu" => []
                    )
                ),
            ),
        ];

        foreach ($permissions as $permission) {
            $perObj = new Permission;
            $perObj->parent_id = $permission['parent_id'] ?? null;
            $perObj->title = $permission['title'] ?? "";
            $perObj->key = $permission['key'] ?? "";
            $perObj->path = $permission['path'] ?? "";
            $perObj->icon = $permission['icon'] ?? "";
            $perObj->breadcrumb = $permission['breadcrumb'] ?? "";
            $perObj->save();
            foreach ($permission['submenu'] ?? [] as $chield) {
                $chieldObj = new Permission;
                // $chieldObj->parent_id = $perObj->id;
                $chieldObj->title = $chield['title'] ?? $chield;
                $chieldObj->key = $chield['key'] ?? "";
                $chieldObj->path = $chield['path'] ?? "";
                $chieldObj->icon = $chield['icon'] ?? "";
                $chieldObj->breadcrumb = $chield['breadcrumb'] ?? "";
                $chieldObj->save();
                foreach ($chield['submenu'] ?? [] as $subChield) {
                    $subChieldObj = new Permission;
                    $subChieldObj->parent_id = $chieldObj->id;
                    $subChieldObj->title = $subChield['title'] ?? $subChield;
                    $subChieldObj->save();
                }
            }
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Route;
use App\Role;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function (){
            DB::table('routes')->delete();
            $admin = Role::where('role_code', 'SYS_ADMIN')->first();
            #### Dashboard
            $dashboard = new Route();
            $dashboard->route_name = 'Dashboard';
            $dashboard->save();
            $dashboard_id = $dashboard->id;

            #### Dashboard child
            $analytics_dash = new Route();
            $analytics_dash->route_name = 'Analytics Dashboard';
            $analytics_dash->url = 'dashboard';
            $analytics_dash->parent_route = $dashboard_id;
            $analytics_dash->save();
            $analytics_dash->roles()->attach($admin);

            #### MasterFiles
            $masterfile= new Route();
            $masterfile->route_name = 'MasterFiles';
            $masterfile->save();
            $masterfile_id = $masterfile->id;

            //add new masterfile
            $mf = new Route();
            $mf->route_name = 'Create MasterFile';
            $mf->url = 'new-mf';
            $mf->parent_route = $masterfile_id;
            $mf->save();
            $mf->roles()->attach($admin);

            //all masterfile
            $mf = new Route();
            $mf->route_name = 'All MasterFiles';
            $mf->url = 'all-masterfiles';
            $mf->parent_route = $masterfile_id;
            $mf->save();
            $mf->roles()->attach($admin);

            #### Suppliers
            $supplier = new Route();
            $supplier->route_name = 'Suppliers';
            $supplier->save();
            $supp_id = $supplier->id;

            // manage suppliers
            $supplier = new Route();
            $supplier->route_name = 'Manage Suppliers';
            $supplier->url = 'suppliers';
            $supplier->parent_route = $supp_id;
            $supplier->save();
            $supplier->roles()->attach($admin);

            // manage supplier items
            $supplier = new Route();
            $supplier->route_name = 'Manage Supplier Items';
            $supplier->url = 'supplier-items';
            $supplier->parent_route = $supp_id;
            $supplier->save();
            $supplier->roles()->attach($admin);

            // manage Invoices
            $supplier = new Route();
            $supplier->route_name = 'Manage Invoices';
            $supplier->url = 'invoices';
            $supplier->parent_route = $supp_id;
            $supplier->save();
            $supplier->roles()->attach($admin);



            #### Configurations
            $system_configurations = new Route();
            $system_configurations->route_name = 'System Configurations';
            $system_configurations->save();
            $system_configurations_id = $system_configurations->id;

            #### configurations children
            $manage_buses = new Route();
            $manage_buses->route_name = 'Manage Vehicles';
            $manage_buses->url = 'all-buses';
            $manage_buses->parent_route = $system_configurations_id;
            $manage_buses->save();
            $manage_buses->roles()->attach($admin);

            //manage expenses
            $manage_expenses = new Route();
            $manage_expenses->route_name = 'Manage Expenses';
            $manage_expenses->url = 'expenses';
            $manage_expenses->parent_route = $system_configurations_id;
            $manage_expenses->save();
            $manage_expenses->roles()->attach($admin);

            //Record transaction
            $manage_expenses = new Route();
            $manage_expenses->route_name = 'Create Transaction';
            $manage_expenses->url = 'accounts';
            $manage_expenses->parent_route = $system_configurations_id;
            $manage_expenses->save();
            $manage_expenses->roles()->attach($admin);


            #### Reports
            $report_menu =new Route();
            $report_menu->route_name = 'Reports';
            $report_menu->save();
            $report_menu_id = $report_menu->id;

            // daily report
            $report = new Route();
            $report->route_name = 'Daily Report';
            $report->url = 'daily-report';
            $report->parent_route = $report_menu_id;
            $report->save();

            // on demand report
            $report = new Route();
            $report->route_name = 'On-Demand Report';
            $report->url = 'all-transactions';
            $report->parent_route = $report_menu_id;
            $report->save();


            #### system
            $system = new Route();
            $system->route_name = 'System Management';
            $system->save();
            $system_id = $system->id;

            #### system children
            $routes = new Route();
            $routes->route_name = 'System Routes';
            $routes->url = 'routes';
            $routes->parent_route = $system_id;
            $routes->save();
            $routes->roles()->attach($admin);

            $menu = new Route();
            $menu->route_name = 'System Menu';
            $menu->url = 'menu';
            $menu->parent_route = $system_id;
            $menu->save();
            $menu->roles()->attach($admin);

            $system_config = new Route();
            $system_config->route_name = 'System Config';
            $system_config->url = 'system_config';
            $system_config->parent_route = $system_id;
            $system_config->save();
            $system_config->roles()->attach($admin);

            $backup = new Route();
            $backup->route_name = 'Database Backup';
            $backup->url = 'backups';
            $backup->parent_route = $system_id;
            $backup->save();
            $backup->roles()->attach($admin);

            #### user management
            $user_mngt = new Route();
            $user_mngt->route_name = 'User Management';
            $user_mngt->save();
            $user_mngt_id = $user_mngt->id;

            #### user management children
            $all_user = new Route();
            $all_user->route_name = 'All Users';
            $all_user->url = 'routes';
            $all_user->parent_route = $user_mngt_id;
            $all_user->save();
            $all_user->roles()->attach($admin);

            $roles = new Route();
            $roles->route_name = 'User Roles';
            $roles->url = 'user_roles';
            $roles->parent_route = $user_mngt_id;
            $roles->save();
            $roles->roles()->attach($admin);

            $audit_trail = new Route();
            $audit_trail->route_name = 'Audit Trail';
            $audit_trail->url = 'audit_trail';
            $audit_trail->parent_route = $user_mngt_id;
            $audit_trail->save();
            $audit_trail->roles()->attach($admin);

        });
    }
}

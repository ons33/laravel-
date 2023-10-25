<?php




namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\User; // Import the User model
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create a new user
        $user = User::create([

            'name' => 'Admin',
            'email' => 'onss3319@gmail.com',
            'password' => bcrypt('anti0987')
        ]);

        // Create the 'Admin' role
        $role = Role::create(['name' => 'Admin']);

        // Get all available permissions
        $permissions = Permission::pluck('id')->all();

        // Assign all permissions to the 'Admin' role
        $role->syncPermissions($permissions);

        // Assign the 'Admin' role to the user
        $user->assignRole($role->name);
    }
}






<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\MetaData;
use App\Models\Brand;
use App\Models\Branch;
use App\Models\Status;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Subcategory;
use App\Models\VoucherBranch;
use App\Models\CustomerVoucher;
use App\Models\CustomerWishlist;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $user = User::find(1);
        $user2 = User::find(3);
        $user->update(['active' => 1, 'email' => 'abdoayad00@gmail.com']);
        $user2->update(['active' => 1, 'email' => 'mrabdullah@gmail.com']);

        $roleAdmin = Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Sales']);
        Role::create(['name' => 'Accountant']);
        Role::create(['name' => 'Support']);
        $roleSadmin = Role::create(['name' => 'Super-Admin']);

        $user->assignRole('Super-Admin');
        $user2->assignRole('Super-Admin');

        $permission  =  Permission::create(['name' => 'View Dashboard']);
        $permission2 =  Permission::create(['name' => 'View Brands']);
        $permission3 =  Permission::create(['name' => 'View Categories']);
        $permission4 =  Permission::create(['name' => 'View Vouchers']);
        $permission5 =  Permission::create(['name' => 'View Customers']);
        $permission6=  Permission::create(['name' => 'View Sales']);
        $permission7 =  Permission::create(['name' => 'View Rating']);
        $permission8 =  Permission::create(['name' => 'View Invoices']);
        $permission18 =  Permission::create(['name' => 'View Settings']);

        $permission9 =  Permission::create(['name' => 'Delete User']);
        $permission10 =  Permission::create(['name' => 'Delete Brand']);
        $permission21 =  Permission::create(['name' => 'Make Invoice']);
        $permission11 =  Permission::create(['name' => 'Delete Category']);
        $permission12 =  Permission::create(['name' => 'Delete Voucher']);
        $permission13 =  Permission::create(['name' => 'Delete Customer']);

        $permission14 =  Permission::create(['name' => 'Activate Voucher']);
        $permission15 =  Permission::create(['name' => 'Activate Brand']);
        $permission16 =  Permission::create(['name' => 'Feature Customer']);
        $permission17 =  Permission::create(['name' => 'Feature Brand']);

        $permission19 =  Permission::create(['name' => 'Add Role']);
        $permission20 =  Permission::create(['name' => 'Add Category']);

        $permission22=  Permission::create(['name' => 'Add Voucher']);
        $permission23 =  Permission::create(['name' => 'Edit Voucher']);


        $permission0 =  Permission::create(['name' => 'View Users']);
        $permission1 =  Permission::create(['name' => 'View Roles']);
        $permission24 =  Permission::create(['name' => 'Block Customer']);
        $permission25 =  Permission::create(['name' => 'Delete Rating']);
        $permission26 =  Permission::create(['name' => 'Add Advertise']);
        $permission27 =  Permission::create(['name' => 'Delete Advertise']);
        $permission28 =  Permission::create(['name' => 'Edit Landing']);

        $permission29 =  Permission::create(['name' => 'Push Notifications']);


        Status::create(['name' => 'vaild']);
        Status::create(['name' => 'redeemed']);
        Status::create(['name' => 'expired']);

        MetaData::create(['name' => 'offerli' , 'address' => 'Gadda' ,'vat_no' => '101010101' ,'Com_Reg_No' => '10101010' ,'bank_commission'=>2.5 ]);

        $roleSadmin->givePermissionTo($permission);
        $roleSadmin->givePermissionTo($permission0);
        $roleSadmin->givePermissionTo($permission1);
        $roleSadmin->givePermissionTo($permission2);
        $roleSadmin->givePermissionTo($permission3);
        $roleSadmin->givePermissionTo($permission4);
        $roleSadmin->givePermissionTo($permission5);
        $roleSadmin->givePermissionTo($permission6);
        $roleSadmin->givePermissionTo($permission7);
        $roleSadmin->givePermissionTo($permission8);
        $roleSadmin->givePermissionTo($permission9);
        $roleSadmin->givePermissionTo($permission10);
        $roleSadmin->givePermissionTo($permission11);
        $roleSadmin->givePermissionTo($permission12);
        $roleSadmin->givePermissionTo($permission13);
        $roleSadmin->givePermissionTo($permission14);
        $roleSadmin->givePermissionTo($permission15);
        $roleSadmin->givePermissionTo($permission16);
        $roleSadmin->givePermissionTo($permission17);
        $roleSadmin->givePermissionTo($permission18);
        $roleSadmin->givePermissionTo($permission19);
        $roleSadmin->givePermissionTo($permission20);
        $roleSadmin->givePermissionTo($permission21);
        $roleSadmin->givePermissionTo($permission22);
        $roleSadmin->givePermissionTo($permission23);
        $roleSadmin->givePermissionTo($permission24);
        $roleSadmin->givePermissionTo($permission25);
        $roleSadmin->givePermissionTo($permission26);
        $roleSadmin->givePermissionTo($permission27);
        $roleSadmin->givePermissionTo($permission28);
        $roleSadmin->givePermissionTo($permission29);


        $user = User::find(2);
        $user->update(['active' => 1, 'email' => 'test@example.net']);
        $user->assignRole('Admin');

        $roleAdmin->givePermissionTo($permission);
        $roleAdmin->givePermissionTo($permission0);
        $roleAdmin->givePermissionTo($permission1);
        $roleAdmin->givePermissionTo($permission2);

        // Payment::factory(4)->create();

        Payment::create(['name' => 'Cash']);
        Payment::create(['name' => 'Visa']);
        // Payment::create(['name' => 'Wallet']);

        Brand::factory(20)->create();
        Voucher::factory(10)->create();
        Branch::factory(10)->create();
        Customer::factory(10)->create();
        CustomerVoucher::factory(10)->create();
        CustomerWishlist::factory(10)->create();
        VoucherBranch::factory(10)->create();

        // Category::factory()->create();
        Category::create(['name' => 'Service' , 'slug' => 'service' ]);
        Category::create(['name' => 'Deal' , 'slug' => 'deal' ]);
        Category::create(['name' => 'event' , 'slug' => 'event' ]);
        Subcategory::factory(10)->create();



        $customer= Customer::find(5);
        $customer->update(['email' => 'karimcustomer@gmail.com']);

        $brand= brand::find(5);
        $brand->update(['email' => 'karimbrand@gmail.com']);

    }
}

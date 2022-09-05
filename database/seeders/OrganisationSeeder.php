<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\OrganisationRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisations')->delete();

        $organisation = new Organisation();
        $organisation->org_name                     = 'SOLANKI';
        $organisation->org_company_id               = '1';
        $organisation->org_tax_id                   = '78943729020';
        $organisation->org_street1                  = 'Dubai';
        $organisation->org_street2                  = 'Dubai';
        $organisation->org_city                     = 'Dubai';
        $organisation->org_state                    = 'Dubai';
        $organisation->org_country_id               = 1;
        $organisation->org_postal                   = 181529;
        $organisation->org_phone                    = '507844941';
        $organisation->org_contact_person           = 'Mr.Hardik';
        $organisation->org_contact_person_number    = '507844941';
        $organisation->org_currency                 = 'AED';
        $organisation->org_fasical_year             = 'April - March';
        $organisation->is_auto_approval_set         = 1;
        $organisation->org_status                   = 1;
        $organisation->is_trial_period              = 0;
        $organisation->save();

        $createRole = new OrganisationRole;
        $createRole->organisation_id    = $organisation->id;
        $createRole->name               = 'superadmin';
        $createRole->save();

        $roles = array('org-admin', 'Supervisor', 'manager');

        $organisation_id = $organisation->id;

        collect($roles)->each(function ($role, $key) use ($organisation_id) {
            $createRole = new OrganisationRole();
            $createRole->organisation_id = $organisation_id;
            $createRole->name = $role;
            $createRole->save();
        });
    }
}

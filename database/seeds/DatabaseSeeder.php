<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\ClientBrief;
use App\Models\ContactUs;
use App\Models\FastFact;
use App\Models\HeaderAndFooter;
use App\Models\ServiceBrief;
use App\Models\TeamBrief;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        if(!Admin::where('id',1)->first()){
            DB::table('admins')->truncate();
            Admin::create([
                "id"=>1,
                'name' => "admin",
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ]);
        }
        if(!HeaderAndFooter::where('id',1)->first()){
            DB::table('headers_and_footers')->truncate();
            HeaderAndFooter::create([
                "id"=>1,
                'title_en' => "header"
            ]);
        }
        if(!ClientBrief::where('id',1)->first()){
            DB::table('client_brief')->truncate();
            ClientBrief::create([
                "id"=>1,
                'brief_en' => "brief"
            ]);
        }
        if(!ServiceBrief::where('id',1)->first()){
            DB::table('service_brief')->truncate();
            ServiceBrief::create([
                "id"=>1,
                'brief_en' => "brief"
            ]);
        }
        if(!TeamBrief::where('id',1)->first()){
            DB::table('team_brief')->truncate();
            TeamBrief::create([
                "id"=>1,
                'brief_en' => "brief"
            ]);
        }
        if(!ContactUs::where('id',1)->first()){
            DB::table('contact_us')->truncate();
            ContactUs::create([
                "id"=>1,
                'address_en' => "address"
            ]);
        }

        if(!FastFact::where('id',1)->first()){
            DB::table('fast_facts')->truncate();
            FastFact::create([
                "id"=>1,
                'description_en' => "description_en"
            ]);
        }
    }
}

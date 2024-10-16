<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_addr');
            $table->timestamps();
        });

        $data_items = [
            [
                'site_name' => 'Kidsberry',
                'site_addr' => 'https://pay.kidsberry.org/'
            ],
            [
                'site_name' => '4youstore',
                'site_addr' => 'https://4youstore.ru/'
            ],
            [
                'site_name' => 'Bergensons',
                'site_addr' => 'https://bergensons.ru/'
            ],
            [
                'site_name' => 'Djecoshop',
                'site_addr' => 'https://djecoshop.ru/'
            ],
            [
                'site_name' => 'Liberty Jones',
                'site_addr' => 'https://liberty-jones.ru/'
            ],
            [
                'site_name' => 'Paolareinas',
                'site_addr' => 'https://paolareinas.ru/'
            ],
            [
                'site_name' => 'Smart Solution',
                'site_addr' => 'https://smart-solution.me/'
            ],
            [
                'site_name' => 'Activebags',
                'site_addr' => 'https://activebags.ru/'
            ],
            [
                'site_name' => 'Likelunch',
                'site_addr' => 'https://likelunch.ru/'
            ],
            [
                'site_name' => 'Globber',
                'site_addr' => 'https://globber.me/'
            ],
            [
                'site_name' => 'Der Die Das',
                'site_addr' => 'https://der-die-das.ru/'
            ],
            [
                'site_name' => 'Belmilbags',
                'site_addr' => 'https://belmilbags.ru'
            ],
            [
                'site_name' => 'Bladesport',
                'site_addr' => 'https://bladesport.ru/'
            ],
            [
                'site_name' => 'Briorails',
                'site_addr' => 'https://briorails.ru/'
            ],
            [
                'site_name' => 'Caribee',
                'site_addr' => 'https://caribee.ru/'
            ],
            [
                'site_name' => 'Catbags',
                'site_addr' => 'https://catbags.ru/'
            ],
            [
                'site_name' => 'Collecta Toys',
                'site_addr' => 'https://collecta-toys.ru/'
            ],
            [
                'site_name' => 'Emile Henry',
                'site_addr' => 'https://emile-henry.me/'
            ],
            [
                'site_name' => 'Ergobags',
                'site_addr' => 'https://ergobags.ru/'
            ],
            [
                'site_name' => 'Gotzdolls',
                'site_addr' => 'https://gotzdolls.ru/'
            ],
            [
                'site_name' => 'Guzzini',
                'site_addr' => 'https://guzzini.me/'
            ],
            [
                'site_name' => 'Hamabags',
                'site_addr' => 'https://hamabags.ru/'
            ],
            [
                'site_name' => 'Herlitzbags',
                'site_addr' => 'https://herlitzbags.ru/'
            ],
            [
                'site_name' => 'Hipe Sport',
                'site_addr' => 'https://hipe-sport.ru/'
            ],
            [
                'site_name' => 'Italtrike',
                'site_addr' => 'https://italtrike.ru/'
            ],
            [
                'site_name' => 'Kanteen',
                'site_addr' => 'https://kanteen.ru/'
            ],
            [
                'site_name' => 'Karmakiss',
                'site_addr' => 'https://karmakiss.ru/'
            ],
            [
                'site_name' => 'Kidsen',
                'site_addr' => 'https://kidsen.ru/'
            ],
            [
                'site_name' => 'Kilner Russia',
                'site_addr' => 'https://kilner-russia.ru/'
            ],
            [
                'site_name' => 'Larochere France',
                'site_addr' => 'https://larochere-france.ru/'
            ],
            [
                'site_name' => 'Larsenshop',
                'site_addr' => 'https://larsenshop.ru/'
            ],
            [
                'site_name' => 'Legbags',
                'site_addr' => 'https://legbags.ru/'
            ],
            [
                'site_name' => 'Lsa Shop',
                'site_addr' => 'https://lsa-shop.ru/'
            ],
            [
                'site_name' => 'Luigibormioli',
                'site_addr' => 'https://luigibormioli.ru/'
            ],
            [
                'site_name' => 'Masoncash',
                'site_addr' => 'https://masoncash.me/'
            ],
            [
                'site_name' => 'Monbento',
                'site_addr' => 'https://monbento.me/'
            ],
            [
                'site_name' => 'Moulin Roty',
                'site_addr' => 'https://moulin-roty.ru/'
            ],
            [
                'site_name' => 'Myplantoys',
                'site_addr' => 'https://myplantoys.ru/'
            ],
            [
                'site_name' => 'Myplaymobil',
                'site_addr' => 'https://myplaymobil.ru/'
            ],
            [
                'site_name' => 'Opn France',
                'site_addr' => 'https://opn-france.ru/'
            ],
            [
                'site_name' => 'Paposhop',
                'site_addr' => 'https://paposhop.ru/'
            ],
            [
                'site_name' => 'Ravensburgers',
                'site_addr' => 'https://ravensburgers.ru/'
            ],
            [
                'site_name' => 'Reisenthelshop',
                'site_addr' => 'https://reisenthelshop.ru/'
            ],
            [
                'site_name' => 'Safaritoys',
                'site_addr' => 'https://safaritoys.ru/'
            ],
            [
                'site_name' => 'Schleichtoys',
                'site_addr' => 'https://schleichtoys.ru/'
            ],
            [
                'site_name' => 'Sento Sphere',
                'site_addr' => 'https://sento-sphere.ru/'
            ],
            [
                'site_name' => 'Sikutoys',
                'site_addr' => 'https://sikutoys.ru/'
            ],
            [
                'site_name' => 'Skandesign',
                'site_addr' => 'https://skandesign.ru/'
            ],
            [
                'site_name' => 'Trunkibags',
                'site_addr' => 'https://trunkibags.ru/'
            ],
            [
                'site_name' => 'Typhoonstore',
                'site_addr' => 'https://typhoonstore.ru/'
            ],
            [
                'site_name' => 'Umbrashop',
                'site_addr' => 'https://umbrashop.ru/'
            ],
            [
                'site_name' => 'Vtechtoys',
                'site_addr' => 'https://vtechtoys.ru/'
            ],
            [
                'site_name' => 'Wildtoys',
                'site_addr' => 'https://wildtoys.ru/'
            ],
            [
                'site_name' => 'Y-volution',
                'site_addr' => 'https://y-volution.ru/'
            ],
        ];
        foreach ($data_items as $item) {
            DB::table('sites')->insert($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};

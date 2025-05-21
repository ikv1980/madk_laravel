<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarMarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Вызов сидера отдельно
        // php artisan db:seed --class=CarMarkSeeder
        $items = [
            ["1","AC"],["2","Acura 2"],["3","Adler"],["4","Aiways"],["5","Alfa Romeo"],["6","Alpina"],["7","Alpine"],["9","AMC"],["11","Arcfox"],["12","Ariel"],["13","Aro"],["14","Asia"],["15","Aston Martin"],["17","Audi"],["18","Aurus"],["19","Austin"],["20","Austin Healey"],["23","Avatr"],["24","BAIC"],["27","Baojun"],["28","Batmobile"],["29","BAW"],["31","Bentley"],["35","Bitter"],["37","BMW"],["38","Borgward"],["39","Brabus"],["40","Brilliance"],["41","Bristol"],["42","Bufori"],["43","Bugatti"],["44","Buick"],["45","BYD"],["46","Byvin"],["47","Cadillac"],["50","Caterham"],["51","Chana"],["52","Changan"],["53","Changfeng"],["55","Chery"],["56","Chevrolet"],["57","Chrysler"],["58","Ciimo (Dongfeng-Honda)"],["59","Citroen"],["64","Cupra"],["65","Dacia"],["66","Dadi"],["67","Daewoo"],["68","Daihatsu"],["69","Daimler"],["71","Datsun"],["73","De Tomaso"],["75","Delage"],["77","Denza"],["78","Derways"],["79","DeSoto"],["81","Dodge"],["82","Dongfeng"],["83","Doninvest"],["84","Donkervoort"],["85","DS"],["86","DW Hower"],["87","Eagle"],["90","Enovate (Enoreve)"],["92","Evolute"],["93","Excalibur"],["94","EXEED"],["96","FAW"],["97","Ferrari"],["98","Fiat"],["99","Fisker"],["101","Ford"],["102","Forthing"],["103","Foton"],["104","FSO"],["106","GAC"],["107","GAC Aion"],["108","GAC Trumpchi"],["109","Geely"],["110","Genesis"],["111","Geo"],["112","GMC"],["113","Goggomobil"],["117","Great Wall"],["118","Hafei"],["119","Haima"],["120","Hanomag"],["122","Haval"],["123","Hawtai"],["125","Hennessey"],["126","Hindustan"],["127","HiPhi"],["129","Holden"],["130","Honda"],["131","Hongqi"],["132","Horch"],["133","Hozon"],["135","HuangHai"],["137","Hudson"],["138","Hummer"],["139","Hycan"],["140","Hyundai"],["142","IM Motors (Zhiji)"],["144","Infiniti"],["145","Innocenti"],["148","Iran Khodro"],["149","Isdera"],["150","Isuzu"],["152","JAC"],["153","Jaecoo"],["154","Jaguar"],["155","Jeep"],["156","Jensen"],["157","Jetour"],["158","Jetta"],["159","Jinbei"],["160","JMC"],["161","JMEV"],["163","KAIYI"],["164","Karma"],["165","Kawei"],["166","KG Mobility"],["167","Kia"],["168","Koenigsegg"],["171","Lada (ВАЗ)"],["172","Lamborghini"],["173","Lancia"],["174","Land Rover"],["175","Landwind"],["176","Leapmotor"],["177","Lexus"],["179","Lifan"],["181","Lincoln"],["182","Livan"],["183","LiXiang"],["185","Lotus"],["189","Luxgen"],["190","Lynk & Co"],["191","Mahindra"],["192","Marcos"],["193","Marlin"],["194","Marussia"],["195","Maruti"],["196","Maserati"],["198","Maxus"],["199","Maybach"],["200","Mazda"],["201","McLaren"],["202","Mega"],["203","Mercedes-Benz"],["204","Mercury"],["206","Metrocab"],["207","MG"],["209","Microcar"],["211","Mini"],["212","Mitsubishi"],["213","Mitsuoka"],["215","Morgan"],["216","Morris"],["218","Nio"],["219","Nissan"],["220","Noble"],["221","Oldsmobile"],["222","OMODA"],["223","Opel"],["224","Ora"],["226","Oshan"],["229","Packard"],["230","Pagani"],["231","Panoz"],["232","Perodua"],["233","Peugeot"],["234","PGO"],["237","Plymouth"],["239","Polestar"],["240","Pontiac"],["241","Porsche"],["242","Premier"],["243","Proton"],["244","Puch"],["245","Puma"],["248","Qiyuan"],["249","Qoros"],["252","Ram"],["253","Ravon"],["256","Renault"],["257","Renault Samsung"],["258","Rezvani"],["259","Rimac"],["261","Rising Auto"],["262","Rivian"],["263","Roewe"],["264","Rolls-Royce"],["267","Rover"],["268","Saab"],["269","Saipa"],["270","Saleen"],["272","Saturn"],["273","Scion"],["275","SEAT"],["277","Seres Aito"],["278","Shanghai Maple"],["279","ShuangHuan"],["280","Simca"],["281","Skoda"],["282","Skywell"],["284","Smart"],["285","Solaris"],["287","Soueast"],["289","Spyker"],["290","SsangYong"],["293","Subaru"],["294","Suzuki"],["295","SWM"],["296","Talbot"],["297","Tank"],["298","Tata"],["299","Tatra"],["301","Tesla"],["304","Tianma"],["306","Tofas"],["307","Toyota"],["308","Trabant"],["310","Triumph"],["311","TVR"],["312","Ultima"],["313","Vauxhall"],["314","Vector"],["315","Venturi"],["316","Venucia"],["317","VGV"],["318","VinFast"],["319","Volkswagen"],["320","Volvo"],["321","Vortex"],["322","Voyah"],["324","W Motors"],["325","Wanderer"],["326","Wartburg"],["327","Weltmeister"],["328","Westfield"],["329","Wey"],["330","Wiesmann"],["331","Willys"],["332","Wuling"],["337","Xin Kai"],["338","Xpeng"],["342","Zastava"],["343","Zeekr"],["345","Zenvo"],["347","Zotye"],["348","ZX"],["349","Автокам"],["352","ГАЗ"],["354","ЗАЗ"],["355","ЗИЛ"],["356","ЗиС"],["357","Иж"],["360","ЛуАЗ"],["361","Москвич"],["363","СМЗ"],["364","Спортивные авто и реплики"],["365","ТагАЗ"],["366","УАЗ"]
        ];
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'id' => $item[0],
                'mark_name' => $item[1],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('car_marks')
            ->insertOrIgnore($data);
    }
}

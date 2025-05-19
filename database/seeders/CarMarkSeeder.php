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
        $marks = ["AC", "Acura 2", "Adler", "Aiways", "Alfa Romeo", "Alpina", "Alpine", "AM General", "AMC", "Apal", "Arcfox", "Ariel", "Aro", "Asia", "Aston Martin", "Auburn", "Audi", "Aurus", "Austin", "Austin Healey", "Auto Union", "Autobianchi", "Avatr", "BAIC", "Bajaj", "Baltijas Dzips", "Baojun", "Batmobile", "BAW", "Belgee", "Bentley", "Bertone", "Bilenkin", "Bio Auto", "Bitter", "Blaval", "BMW", "Borgward", "Brabus", "Brilliance", "Bristol", "Bufori", "Bugatti", "Buick", "BYD", "Byvin", "Cadillac", "Callaway", "Carbodies", "Caterham", "Chana", "Changan", "Changfeng", "Changhe", "Chery", "Chevrolet", "Chrysler", "Ciimo (Dongfeng-Honda)", "Citroen", "Cizeta", "Coda", "Coggiola", "Cord", "Cupra", "Dacia", "Dadi", "Daewoo", "Daihatsu", "Daimler", "Dallara", "Datsun", "Dayun", "De Tomaso", "Deco Rides", "Delage", "DeLorean", "Denza", "Derways", "DeSoto", "DKW", "Dodge", "Dongfeng", "Doninvest", "Donkervoort", "DS", "DW Hower", "Eagle", "Eagle Cars", "E-Car", "Enovate (Enoreve)", "Everus", "Evolute", "Excalibur", "EXEED", "Facel Vega", "FAW", "Ferrari", "Fiat", "Fisker", "Flanker", "Ford", "Forthing", "Foton", "FSO", "Fuqi", "GAC", "GAC Aion", "GAC Trumpchi", "Geely", "Genesis", "Geo", "GMC", "Goggomobil", "Gonow", "Gordon", "GP", "Great Wall", "Hafei", "Haima", "Hanomag", "Hanteng", "Haval", "Hawtai", "Heinkel", "Hennessey", "Hindustan", "HiPhi", "Hispano-Suiza", "Holden", "Honda", "Hongqi", "Horch", "Hozon", "HSV", "HuangHai", "Huazi", "Hudson", "Hummer", "Hycan", "Hyundai", "iCar", "IM Motors (Zhiji)", "Ineos", "Infiniti", "Innocenti", "International", "Invicta", "Iran Khodro", "Isdera", "Isuzu", "Iveco", "JAC", "Jaecoo", "Jaguar", "Jeep", "Jensen", "Jetour", "Jetta", "Jinbei", "JMC", "JMEV", "Jonway", "KAIYI", "Karma", "Kawei", "KG Mobility", "Kia", "Koenigsegg", "KTM AG", "KYC", "Lada (ВАЗ)", "Lamborghini", "Lancia", "Land Rover", "Landwind", "Leapmotor", "Lexus", "Liebao Motor", "Lifan", "Ligier", "Lincoln", "Livan", "LiXiang", "Logem", "Lotus", "LTI", "Lucid", "Luxeed", "Luxgen", "Lynk & Co", "Mahindra", "Marcos", "Marlin", "Marussia", "Maruti", "Maserati", "Matra", "Maxus", "Maybach", "Mazda", "McLaren", "Mega", "Mercedes-Benz", "Mercury", "Messerschmitt", "Metrocab", "MG", "M-Hero", "Microcar", "Minelli", "Mini", "Mitsubishi", "Mitsuoka", "Mobilize", "Morgan", "Morris", "Nash", "Nio", "Nissan", "Noble", "Oldsmobile", "OMODA", "Opel", "Ora", "Osca", "Oshan", "Oting", "Overland", "Packard", "Pagani", "Panoz", "Perodua", "Peugeot", "PGO", "Piaggio", "Pierce-Arrow", "Plymouth", "Polar Stone (Jishi)", "Polestar", "Pontiac", "Porsche", "Premier", "Proton", "Puch", "Puma", "Qiantu", "Qingling", "Qiyuan", "Qoros", "Qvale", "Radar", "Ram", "Ravon", "Reliant", "Renaissance", "Renault", "Renault Samsung", "Rezvani", "Rimac", "Rinspeed", "Rising Auto", "Rivian", "Roewe", "Rolls-Royce", "Ronart", "Rossa", "Rover", "Saab", "Saipa", "Saleen", "Santana", "Saturn", "Scion", "Sears", "SEAT", "Seres", "Seres Aito", "Shanghai Maple", "ShuangHuan", "Simca", "Skoda", "Skywell", "Skyworth", "Smart", "Solaris", "Sollers", "Soueast", "Spectre", "Spyker", "SsangYong", "Steyr", "Studebaker", "Subaru", "Suzuki", "SWM", "Talbot", "Tank", "Tata", "Tatra", "Tazzari", "Tesla", "Thairung", "Think", "Tianma", "Tianye", "Tofas", "Toyota", "Trabant", "Tramontana", "Triumph", "TVR", "Ultima", "Vauxhall", "Vector", "Venturi", "Venucia", "VGV", "VinFast", "Volkswagen", "Volvo", "Vortex", "Voyah", "VUHL", "W Motors", "Wanderer", "Wartburg", "Weltmeister", "Westfield", "Wey", "Wiesmann", "Willys", "Wuling", "Xcite", "XEV", "Xiaomi", "XiaoPaoChe (SSC)", "Xin Kai", "Xpeng", "Yema", "Yipai", "Yulon", "Zastava", "Zeekr", "Zenos", "Zenvo", "Zibar", "Zotye", "ZX", "Автокам", "Амберавто", "Атом", "ГАЗ", "Ё-мобиль", "ЗАЗ", "ЗИЛ", "ЗиС", "Иж", "Канонир", "Комбат", "ЛуАЗ", "Москвич", "Руссо-Балт", "СМЗ", "Спортивные авто и реплики", "ТагАЗ", "УАЗ" ];
        $data = [];

        foreach ($marks as $mark) {
            $data[] = ['mark_name' => $mark,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::connection(env('CONNECTION_FOR_SEED'))
            ->table('car_marks')
            ->insertOrIgnore($data);
    }
}

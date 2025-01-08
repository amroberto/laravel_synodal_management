<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Afeganistão', 'code' => 'AF'],
            ['name' => 'África do Sul', 'code' => 'ZA'],
            ['name' => 'Albânia', 'code' => 'AL'],
            ['name' => 'Alemanha', 'code' => 'DE'],
            ['name' => 'Andorra', 'code' => 'AD'],
            ['name' => 'Angola', 'code' => 'AO'],
            ['name' => 'Antígua e Barbuda', 'code' => 'AG'],
            ['name' => 'Arábia Saudita', 'code' => 'SA'],
            ['name' => 'Argélia', 'code' => 'DZ'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Armênia', 'code' => 'AM'],
            ['name' => 'Austrália', 'code' => 'AU'],
            ['name' => 'Áustria', 'code' => 'AT'],
            ['name' => 'Azerbaijão', 'code' => 'AZ'],
            ['name' => 'Bahamas', 'code' => 'BS'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'Barbados', 'code' => 'BB'],
            ['name' => 'Bahrein', 'code' => 'BH'],
            ['name' => 'Bélgica', 'code' => 'BE'],
            ['name' => 'Belize', 'code' => 'BZ'],
            ['name' => 'Benin', 'code' => 'BJ'],
            ['name' => 'Bermudas', 'code' => 'BM'],
            ['name' => 'Bielorrússia', 'code' => 'BY'],
            ['name' => 'Bolívia', 'code' => 'BO'],
            ['name' => 'Bósnia e Herzegovina', 'code' => 'BA'],
            ['name' => 'Botsuana', 'code' => 'BW'],
            ['name' => 'Brasil', 'code' => 'BR'],
            ['name' => 'Brunei', 'code' => 'BN'],
            ['name' => 'Bulgária', 'code' => 'BG'],
            ['name' => 'Burkina Faso', 'code' => 'BF'],
            ['name' => 'Burundi', 'code' => 'BI'],
            ['name' => 'Butão', 'code' => 'BT'],
            ['name' => 'Cabo Verde', 'code' => 'CV'],
            ['name' => 'Camarões', 'code' => 'CM'],
            ['name' => 'Camboja', 'code' => 'KH'],
            ['name' => 'Canadá', 'code' => 'CA'],
            ['name' => 'Catar', 'code' => 'QA'],
            ['name' => 'Cazaquistão', 'code' => 'KZ'],
            ['name' => 'Chade', 'code' => 'TD'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Chipre', 'code' => 'CY'],
            ['name' => 'Colômbia', 'code' => 'CO'],
            ['name' => 'Comores', 'code' => 'KM'],
            ['name' => 'Congo-Brazzaville', 'code' => 'CG'],
            ['name' => 'Congo-Kinshasa', 'code' => 'CD'],
            ['name' => 'Coreia do Norte', 'code' => 'KP'],
            ['name' => 'Coreia do Sul', 'code' => 'KR'],
            ['name' => 'Costa do Marfim', 'code' => 'CI'],
            ['name' => 'Costa Rica', 'code' => 'CR'],
            ['name' => 'Croácia', 'code' => 'HR'],
            ['name' => 'Cuba', 'code' => 'CU'],
            ['name' => 'Dinamarca', 'code' => 'DK'],
            ['name' => 'Djibuti', 'code' => 'DJ'],
            ['name' => 'Dominica', 'code' => 'DM'],
            ['name' => 'Egito', 'code' => 'EG'],
            ['name' => 'El Salvador', 'code' => 'SV'],
            ['name' => 'Emirados Árabes Unidos', 'code' => 'AE'],
            ['name' => 'Equador', 'code' => 'EC'],
            ['name' => 'Eritreia', 'code' => 'ER'],
            ['name' => 'Eslováquia', 'code' => 'SK'],
            ['name' => 'Eslovênia', 'code' => 'SI'],
            ['name' => 'Espanha', 'code' => 'ES'],
            ['name' => 'Estados Unidos', 'code' => 'US'],
            ['name' => 'Estônia', 'code' => 'EE'],
            ['name' => 'Eswatini', 'code' => 'SZ'],
            ['name' => 'Etiópia', 'code' => 'ET'],
            ['name' => 'Fiji', 'code' => 'FJ'],
            ['name' => 'Filipinas', 'code' => 'PH'],
            ['name' => 'Finlândia', 'code' => 'FI'],
            ['name' => 'França', 'code' => 'FR'],
            ['name' => 'Gabão', 'code' => 'GA'],
            ['name' => 'Gâmbia', 'code' => 'GM'],
            ['name' => 'Gana', 'code' => 'GH'],
            ['name' => 'Geórgia', 'code' => 'GE'],
            ['name' => 'Granada', 'code' => 'GD'],
            ['name' => 'Grécia', 'code' => 'GR'],
            ['name' => 'Guatemala', 'code' => 'GT'],
            ['name' => 'Guiana', 'code' => 'GY'],
            ['name' => 'Guiné', 'code' => 'GN'],
            ['name' => 'Guiné-Bissau', 'code' => 'GW'],
            ['name' => 'Guiné Equatorial', 'code' => 'GQ'],
            ['name' => 'Haiti', 'code' => 'HT'],
            ['name' => 'Honduras', 'code' => 'HN'],
            ['name' => 'Hungria', 'code' => 'HU'],
            ['name' => 'Iêmen', 'code' => 'YE'],
            ['name' => 'Ilhas Marshall', 'code' => 'MH']
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}

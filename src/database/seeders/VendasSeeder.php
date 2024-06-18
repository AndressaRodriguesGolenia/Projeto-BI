<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;
use Faker\Factory as Faker;

class VendasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Gerar 2000 registros aleatórios
        for ($i = 0; $i < 2000; $i++) {
            $data_venda = $faker->dateTimeBetween('2025-04-01', '2025-05-31');
            $cidade = $faker->randomElement(['Curitiba', 'São Paulo', 'Rio de Janeiro','Alagoas','Florianópolis','Ponta Grossa','Campinas','São Matheus','Londrina','Araucária']);
            $estado = $faker->randomElement(['PR', 'SP', 'RJ','PE','SC']);;
            $status = $faker->randomElement(['Em processamento', 'Entregue', 'Cancelado']);
            $nome_cliente = $faker->randomElement(['João', 'Ana', 'Maria','José','Pedro','Júlio','Joana','Joaquina','Mariana','Aderval']);
            $valor = $faker->randomFloat(2, 1, 10000);

            // Formatar o campo rastreio
            $rastreio = substr(str_replace('-', '', $faker->date('ymd', $data_venda)).strtoupper($estado) . str_pad($faker->numberBetween(1, 999), 5, '0', STR_PAD_LEFT), 0, 15);
            
            //print_r([$nome_cliente,  $cidade, $estado,$rastreio, $data_venda, $status]);
            
            Venda::create([
                'nome_cliente' => $nome_cliente,
                'cidade' => $cidade,
                'estado' => $estado,
                'rastreio' => $rastreio,
                'data_venda' => $data_venda,
                'status' => $status,
                'valor' => $valor
            ]);
        }
    }
}

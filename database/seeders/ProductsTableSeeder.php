<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Android smartphone with a 6.5',
            'description' => 'Android smartphone with a 6.5-inch display, octa-core processor, 4GB of RAM, 64GB storage (expandable), a triple rear camera setup (13MP main, 2MP depth, 2MP macro), an approximate 8MP front camera.',
            'image_path' => 'https://plus.unsplash.com/premium_photo-1687362298502-1881385c786f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8c2FtcGxlJTIwcHJvZHVjdCUyMHBob25lfGVufDB8fDB8fHww',
            'price' => 698.88,
            'stock_saldo' => 100
        ]);

        DB::table('products')->insert([
            'name' => 'Digital Camera EOS',
            'description' => 'Canon cameras come in various models with diverse features, but generally, they offer high-quality imaging, a range of resolutions, interchangeable lenses, advanced autofocus systems.',
            'image_path' => 'https://images.unsplash.com/photo-1672883589583-c82951069154?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHNhbXBsZSUyMHByb2R1Y3R8ZW58MHx8MHx8fDA%3D',
            'price' => 983.00,
            'stock_saldo' => 100

        ]);

        DB::table('products')->insert([
            'name' => 'LOIS CARON Watch',
            'description' => 'The Lois Caron watch typically features a stainless steel case, quartz movement, analog display, synthetic leather or metal strap, and water resistance at varying depths.',
            'image_path' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjR8fHNhbXBsZSUyMHByb2R1Y3R8ZW58MHx8MHx8fDA%3D',
            'price' => 675.00,
            'stock_saldo' => 100
        ]);

        DB::table('products')->insert([
            'name' => 'Elegante unisex adult square',
            'description' => 'Sunglasses come in a wide variety of styles, but they generally feature UV-protective lenses housed in plastic or metal frames.',
            'image_path' => 'https://images.unsplash.com/photo-1613467663837-e4a6be2014b6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHNhbXBsZXxlbnwwfHwwfHx8MA%3D%3D',
            'price' => 159.99,
            'stock_saldo' => 100
        ]);

        DB::table('products')->insert([
            'name' => 'Large Capacity Folding Bag',
            'description' => 'A typical travel bag is designed with durable materials, multiple compartments, sturdy handles, and often includes wheels for easy maneuverability.',
            'image_path' => 'https://plus.unsplash.com/premium_photo-1661443838786-d6dee3739995?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fHNhbXBsZXxlbnwwfHwwfHx8MA%3D%3D',
            'price' => 68.00,
            'stock_saldo' => 100
        ]);

        DB::table('products')->insert([
            'name' => 'Lenovo Smartchoice Ideapad 3',
            'description' => 'Lenovo laptops typically offer various configurations with features such as Intel or AMD processors.',
            'image_path' => 'https://images.unsplash.com/photo-1558383331-f520f2888351?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fHNhbXBsZXxlbnwwfHwwfHx8MA%3D%3D',
            'price' => 129.99,
            'stock_saldo' => 100
        ]);

        DB::table('products')->insert([
            'name' => 'Elegante unisex adult toy',
            'description' => 'Sunglasses come in a wide variety of styles, but they generally feature UV-protective lenses housed in plastic or metal frames.',
            'image_path' => 'https://images.unsplash.com/photo-1615220368123-9bb8faf4221b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8c2FtcGxlfGVufDB8fDB8fHww',
            'price' => 159.99,
            'stock_saldo' => 100
        ]);

        DB::table('products')->insert([
            'name' => 'Large capacity fat guy',
            'description' => 'A typical travel bag is designed with durable materials, multiple compartments, sturdy handles, and often includes wheels for easy maneuverability.',
            'image_path' => 'https://images.unsplash.com/photo-1561336313-0bd5e0b27ec8?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8c2FtcGxlfGVufDB8fDB8fHww',
            'price' => 68.00,
            'stock_saldo' => 100
        ]);

        DB::table('products')->insert([
            'name' => 'Apple Smartchoice',
            'description' => 'Lenovo laptops typically offer various configurations with features such as Intel or AMD processors.',
            'image_path' => 'https://plus.unsplash.com/premium_photo-1680740103993-21639956f3f0?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c2FtcGxlfGVufDB8fDB8fHww',
            'price' => 129.99,
            'stock_saldo' => 100
        ]);
    }
}

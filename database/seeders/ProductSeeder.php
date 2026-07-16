<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed sample products into the database.
     */
    public function run(): void
    {
        $products = [
            [
                'name'         => 'iPhone 15 Pro Max',
                'product_code' => 'APL-IPH-15PM',
                'category'     => 'Electronics',
                'description'  => 'The most powerful iPhone ever with titanium design, A17 Pro chip, and a pro camera system with 5x optical zoom. Features USB-C connectivity and Action Button.',
                'price'        => 1199.99,
                'quantity'     => 50,
                'status'       => 'active',
            ],
            [
                'name'         => 'Samsung Galaxy S24 Ultra',
                'product_code' => 'SAM-S24U-001',
                'category'     => 'Electronics',
                'description'  => 'Ultimate Android flagship with built-in S Pen, 200MP camera, Snapdragon 8 Gen 3, and a stunning 6.8-inch Dynamic AMOLED display.',
                'price'        => 1299.99,
                'quantity'     => 35,
                'status'       => 'active',
            ],
            [
                'name'         => 'Sony WH-1000XM5 Headphones',
                'product_code' => 'SNY-WH1000XM5',
                'category'     => 'Electronics',
                'description'  => 'Industry-leading noise canceling wireless headphones with up to 30 hours battery life, crystal clear hands-free calling, and multipoint connection.',
                'price'        => 349.99,
                'quantity'     => 120,
                'status'       => 'active',
            ],
            [
                'name'         => 'Nike Air Jordan 1 Retro High',
                'product_code' => 'NIKE-AJ1-RH-10',
                'category'     => 'Clothing & Apparel',
                'description'  => 'Classic basketball shoe with premium leather upper, Air-Sole cushioning, and iconic Wings logo. Available in multiple colorways.',
                'price'        => 179.99,
                'quantity'     => 80,
                'status'       => 'active',
            ],
            [
                'name'         => 'MacBook Air M3 13-inch',
                'product_code' => 'APL-MBA-M3-13',
                'category'     => 'Electronics',
                'description'  => 'Supercharged by the M3 chip. Up to 18 hours battery, fanless design, Liquid Retina display, and up to 24GB unified memory.',
                'price'        => 1099.00,
                'quantity'     => 25,
                'status'       => 'active',
            ],
            [
                'name'         => 'Dyson V15 Detect Vacuum',
                'product_code' => 'DYS-V15-DET',
                'category'     => 'Home & Garden',
                'description'  => 'Most powerful cordless vacuum with laser dust detection, LCD screen displaying real-time data, and up to 60 minutes run time.',
                'price'        => 749.99,
                'quantity'     => 40,
                'status'       => 'active',
            ],
            [
                'name'         => 'Levi\'s 501 Original Fit Jeans',
                'product_code' => 'LEV-501-ORG-32',
                'category'     => 'Clothing & Apparel',
                'description'  => 'The original jean since 1873. Straight fit with button fly, sits at the waist. Made from 100% cotton denim.',
                'price'        => 69.99,
                'quantity'     => 200,
                'status'       => 'active',
            ],
            [
                'name'         => 'Instant Pot Duo 7-in-1',
                'product_code' => 'INS-DUO7-6QT',
                'category'     => 'Home & Garden',
                'description'  => '7-in-1 multi-cooker: Pressure Cooker, Slow Cooker, Rice Cooker, Steamer, Sauté, Yogurt Maker & Warmer. 6-quart capacity.',
                'price'        => 99.95,
                'quantity'     => 75,
                'status'       => 'active',
            ],
            [
                'name'         => 'Adidas Ultraboost 23',
                'product_code' => 'ADI-UB23-WHT',
                'category'     => 'Sports & Outdoors',
                'description'  => 'High-performance running shoes featuring BOOST midsole for incredible energy return, Primeknit+ upper, and Continental rubber outsole.',
                'price'        => 189.99,
                'quantity'     => 90,
                'status'       => 'active',
            ],
            [
                'name'         => 'Dell XPS 15 Laptop',
                'product_code' => 'DEL-XPS15-I9',
                'category'     => 'Electronics',
                'description'  => '15.6-inch OLED display, Intel Core i9, 32GB RAM, 1TB SSD, NVIDIA RTX 4070. Professional-grade laptop in a premium aluminum chassis.',
                'price'        => 2199.99,
                'quantity'     => 15,
                'status'       => 'active',
            ],
            [
                'name'         => 'Protein Whey Gold Standard',
                'product_code' => 'ON-WGS-5LB-CHC',
                'category'     => 'Health & Beauty',
                'description'  => 'Optimum Nutrition Gold Standard 100% Whey Protein. 24g of protein per serving, chocolate flavor, 5 lb bag. Supports muscle recovery.',
                'price'        => 74.99,
                'quantity'     => 150,
                'status'       => 'active',
            ],
            [
                'name'         => 'GoPro Hero 12 Black',
                'product_code' => 'GPR-H12-BLK',
                'category'     => 'Electronics',
                'description'  => '5.3K video, 27MP photos, HyperSmooth 6.0 stabilization, waterproof to 33ft, voice control and live streaming capability.',
                'price'        => 399.99,
                'quantity'     => 60,
                'status'       => 'inactive',
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}

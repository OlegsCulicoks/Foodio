<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

// Definē MenuItemSeeder klasi, kas manto no bāzes Seeder klases.
class MenuItemSeeder extends Seeder
{
    // Metode, kas tiek izsaukta, kad jāveic datu ieejas operācijas.
    public function run()
    {
        // Definē ēdienu sarakstu, grupējot to pa kategorijām.
        $menuItems = [
            'Main Course' => [
                ['id' => 1, 'name' => 'Chicken with rice', 'description' => 'Chicken with Rice consists of chicken meat, rice, carrots, paprika.', 'price' => 15.00, 'image' => 'chiken_with_rice.png'],
                ['id' => 3, 'name' => 'Fillet steak & fries', 'description' => 'Fillet steak with fried potatoes consists of steak, potatoes and pepper sauce.', 'price' => 25.00, 'image' => 'Fillet steak with fried potatoes.png'],
                ['id' => 5, 'name' => 'Smoked pork ribs', 'description' => 'Smoked pork ribs consist of pork ribs, BBQ sauce and corn mash.', 'price' => 17.95, 'image' => 'Smoked pork ribs with homemade BBQ sauce.png'],
                ['id' => 6, 'name' => 'Beef steak burger', 'description' => 'The beef steak burger consists of beef, a slice of cheese, pickled onions and fries.', 'price' => 12.00, 'image' => 'Beef steak burger .png'],
                ['id' => 7, 'name' => 'Oven-baked salmon', 'description' => 'Oven-baked salmon medallion consists of salmon, green risotto and lemon butter.', 'price' => 25.95, 'image' => 'Oven-baked salmon medallion.png'],
                ['id' => 8, 'name' => 'Pork shashlik', 'description' => 'Pork shashlik consists of pork, cherry tomato sauce and chili potato halves.', 'price' => 13.90, 'image' => 'Pork shashlik with cherry tomato sauce.png'],
            ],
            'Snacks' => [
                ['id' => 2, 'name' => 'Fried onion rings', 'description' => 'Fried onion rings consist of onions, flour, eggs and breadcrumbs.', 'price' => 4.90, 'image' => 'fried onion rings.png'],
                ['id' => 4, 'name' => 'Seafood soup', 'description' => 'Seafood soup consists of shrimp, mussels, vegetables and fish broth.', 'price' => 13.50, 'image' => 'Seafood soup with shrimps.png'],
                ['id' => 13, 'name' => 'Nachos supreme', 'description' => 'Tortilla chips loaded with cheese, jalapenos, and salsa.', 'price' => 8.50, 'image' => 'nachos.jpeg'],
                ['id' => 14, 'name' => 'Chicken wings', 'description' => 'Spicy chicken wings served with blue cheese dip.', 'price' => 9.90, 'image' => 'chicken wings.jpeg'],
                ['id' => 17, 'name' => 'Mozzarella sticks', 'description' => 'Breaded mozzarella sticks with marinara sauce.', 'price' => 6.50, 'image' => 'grilled cheese sticks.jpeg'],
                ['id' => 24, 'name' => 'Crispy shrimp tempura baskets', 'description' => 'Shrimp fried in light and crispy tempura batter.', 'price' => 10.00, 'image' => 'shrimp tempura.jpeg'],
            ],
            'Desserts' => [
                ['id' => 15, 'name' => 'Chocolate lava cake', 'description' => 'Warm chocolate cake with a gooey center, served with ice cream.', 'price' => 7.50, 'image' => 'warm chocolate cake.jpeg'],
                ['id' => 16, 'name' => 'New York cheesecake', 'description' => 'Classic creamy cheesecake with a graham cracker crust.', 'price' => 6.90, 'image' => 'cheesecake new york style.jpeg'],
                ['id' => 18, 'name' => 'Tiramisu', 'description' => 'Italian coffee-flavored dessert with layers of mascarpone.', 'price' => 8.00, 'image' => 'tiramisu.jpeg'],
                ['id' => 21, 'name' => 'Fruit sorbet', 'description' => 'Refreshing sorbet made with seasonal fruits.', 'price' => 5.50, 'image' => 'sorbet.jpeg'],
                ['id' => 27, 'name' => 'Chocolate Fondant','description' => 'Soft and warm chocolate fondant with a liquid chocolate center.', 'price' => 5.50, 'image' => 'fondant.jpeg'],
                ['id' => 28, 'name' => 'Lemon Tart', 'description' => 'Fresh and light lemon tart with a delicious crispy base.', 'price' => 6.50, 'image' => 'lemon tart.jpeg'],
            ],
            'Drinks' => [
                ['id' => 9, 'name' => 'Lemonade #1', 'description' => 'Consists of watermelon, mint, lime slices and ice cubes.', 'price' => 4.50, 'image' => 'Watermelon and mint lemonade.png'],
                ['id' => 10, 'name' => 'Lemonade #2', 'description' => 'Consists of kiwi, pineapple and mint.', 'price' => 5.00, 'image' => 'Tropical cocktail with kiwi.png'],
                ['id' => 11, 'name' => 'Lemonade #3', 'description' => 'Consists of cherries, lime and ice cubes.', 'price' => 4.75, 'image' => 'Cherry and lime iced tea.png'],
                ['id' => 12, 'name' => 'Lemonade #4', 'description' => 'Consists of melon, green tea, lime and ice.', 'price' => 6.00, 'image' => 'Melon and green tea iced tea.png'],
                ['id' => 25, 'name' => 'Iced coffee', 'description' => 'Chilled coffee served over ice with cream.', 'price' => 3.50, 'image' => 'iced coffee.jpeg'],
                ['id' => 26, 'name' => 'Fresh orange juice', 'description' => 'Freshly squeezed orange juice.', 'price' => 4.00, 'image' => 'orange juice.jpeg'],
            ],
        ];

        // Iziet cauri katrai ēdienu kategorijai un pievienot katru ēdienu datu bāzē.
        foreach ($menuItems as $category => $items) { // Iziet cauri katrai kategorijai.
            foreach ($items as $item) { // Iziet cauri katram ēdienam katrā kategorijā.
                MenuItem::create([ // Izmanto MenuItem modeli, lai izveidotu jaunu ierakstu datu bāzē.
                    'name' => $item['name'], // Iestata ēdiena nosaukumu.
                    'description' => $item['description'], // Iestata ēdiena aprakstu.
                    'price' => $item['price'], // Iestata ēdiena cenu.
                    'category' => $category, // Iestata ēdiena kategoriju.
                    'image' => $item['image'], // Iestata ēdiena attēla faila nosaukumu.
                ]);
            }
        }
    }
}


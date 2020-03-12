<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table("product")->insert([
            'name' => 'Spider-Man: Homecoming',
            'price' => 200000,
            'description' => 'Spider-Man: Homecoming is a 2017 American superhero film based on the Marvel Comics character Spider-Man, co-produced by Columbia Pictures and Marvel Studios, and distributed by Sony Pictures Releasing. It is the second Spider-Man film reboot and the sixteenth film of the Marvel Cinematic Universe (MCU). The film is directed by Jon Watts, with a screenplay by the writing teams of Jonathan Goldstein and John Francis Daley, Watts and Christopher Ford, and Chris McKenna and Erik Sommers. Tom Holland stars as Spider-Man, alongside Michael Keaton, Jon Favreau, Zendaya, Donald Glover, Tyne Daly, Marisa Tomei and Robert Downey Jr. In Spider-Man: Homecoming, Peter Parker tries to balance high school life with being Spider-Man, while facing the Vulture.',
            'subcategory_id' => 1,
            'file' => 'https://www.google.com/robots.txt',
            'image' => '/storage/product_image/07c33f6e132351ccfaec9ed464283f42.jpg'
            ]);
        DB::table("product")->insert([
                'name' => 'The Pirates of Carribean: Deadmen Tell no Tales',
                'price' => 200000,
                'description' => "Pirates of the Caribbean: Dead Men Tell No Tales (released outside the US as Pirates of the Caribbean: Salazar's Revenge)[5] is a 2017 American swashbuckler fantasy film. It is the fifth installment in the Pirates of the Caribbean film series and the sequel to On Stranger Tides (2011). The film is directed by Joachim Rønning and Espen Sandberg from a script by Jeff Nathanson, with Jerry Bruckheimer serving again as producer. Johnny Depp, Kevin McNally and Geoffrey Rush reprise their roles as Jack Sparrow, Joshamee Gibbs and Hector Barbossa, respectively, while Javier Bardem, Brenton Thwaites and Kaya Scodelario join the cast as Armando Salazar, Henry Turner and Carina Smyth. The film also features the returns of Orlando Bloom and Keira Knightley as Will Turner and Elizabeth Swann, following their absence from the previous film.",
                'subcategory_id' => 1,
                'file' => 'https://www.google.com/robots.txt',
                'image' => '/storage/product_image/676b239b4dc39132b16559aa864729aa.jpg'
                ]);

        DB::table("product")->insert([
            'name' => 'Cars 3',
            'price' => 100000,
            'description' => "Cars 3 is a 2017 American 3D computer-animated epic auto racing sports comedy film produced by Pixar and released by Walt Disney Pictures. Directed by Brian Fee, the screenplay was written by Kiel Murray, Bob Peterson and Mike Rich. The film is the sequel to Cars 2. The returning voices of Owen Wilson, Bonnie Hunt and Larry the Cable Guy are joined by Cristela Alonzo, Chris Cooper, Armie Hammer, Nathan Fillion, Kerry Washington and Lea DeLaria, in addition to a dozen NASCAR personalities.[6] In the film, Lightning McQueen sets out to prove to a new generation of high tech race cars that he is still the best race car in the world.",
            'subcategory_id' => 2,
            'file' => 'https://www.google.com/robots.txt',
            'image' => '/storage/product_image/1200x630bb.jpg'
            ]);
                

        DB::table("product")->insert([
            'name' => 'Captain America: Civil War',
            'price' => 250000,
            'description' => "Captain America: Civil War is a 2016 American superhero film based on the Marvel Comics character Captain America, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2011's Captain America: The First Avenger and 2014's Captain America: The Winter Soldier, and the thirteenth film of the Marvel Cinematic Universe (MCU). The film is directed by Anthony and Joe Russo, with a screenplay by Christopher Markus & Stephen McFeely, and features an ensemble cast, including Chris Evans, Robert Downey Jr., Scarlett Johansson, Sebastian Stan, Anthony Mackie, Don Cheadle, Jeremy Renner, Chadwick Boseman, Paul Bettany, Elizabeth Olsen, Paul Rudd, Emily VanCamp, Tom Holland, Frank Grillo, William Hurt, and Daniel Brühl. In Captain America: Civil War, disagreement over international oversight of the Avengers fractures them into opposing factions—one led by Steve Rogers and the other by Tony Stark.",
            'subcategory_id' => 1,
            'file' => 'https://www.google.com/robots.txt',
            'image' => '/storage/product_image/civilwar.jpg'
            ]);
                

        DB::table("product")->insert([
            'name' => 'Anabelle: Creation',
            'price' => 100000,
            'description' => "Annabelle: Creation is a 2017 American supernatural horror film directed by David F. Sandberg and written by Gary Dauberman. It is a prequel to 2014's Annabelle and the fourth installment in The Conjuring series. The film stars Stephanie Sigman, Talitha Bateman, Anthony LaPaglia and Miranda Otto, and depicts the possessed Annabelle doll's origin.",
            'subcategory_id' => 1,
            'file' => 'https://www.google.com/robots.txt',
            'image' => '/storage/product_image/rmtlg2xfpjcrqlm7bo9y.jpg'
            ]);
                

        DB::table("product")->insert([
            'name' => 'Thor: Ragnarok',
            'price' => 200000,
            'description' => "Thor: Ragnarok is a 2017 American superhero film based on the Marvel Comics character Thor, produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures. It is the sequel to 2011's Thor and 2013's Thor: The Dark World, and is the seventeenth film of the Marvel Cinematic Universe (MCU). The film is directed by Taika Waititi from a screenplay by Eric Pearson and the writing team of Craig Kyle and Christopher Yost, and stars Chris Hemsworth as Thor alongside Tom Hiddleston, Cate Blanchett, Idris Elba, Jeff Goldblum, Tessa Thompson, Karl Urban, Mark Ruffalo, and Anthony Hopkins. In Thor: Ragnarok, Thor must escape the alien planet Sakaar in time to save Asgard from Hela and the impending Ragnarök.",
            'subcategory_id' => 1,
            'file' => 'https://www.google.com/robots.txt',
            'image' => '/storage/product_image/MV5BMjMyNDkzMzI1OF5BMl5BanBnXkFtZTgwODcxODg5MjI@._V1_UY1200_CR90,0,630,1200_AL_.jpg'
            ]);
                
                

        DB::table("product")->insert([
            'name' => 'Foo Fighter: The Sky is a Neighborhood',
            'price' => 200000,
            'description' => "new single 2017.",
            'subcategory_id' => 4,
            'file' => 'https://www.google.com/robots.txt',
            'image' => '/storage/product_image/57c56a415494f4debd7c03c5fe4e355d9ac4caff.jpg'
            ]);
        
     
        // $this->call("OthersTableSeeder");
    }
}

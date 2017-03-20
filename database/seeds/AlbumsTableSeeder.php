<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albums')->delete();

        DB::table('albums')->insert([
            ['name' => 'Black Sabbath', 'recorded_date' => '1969-10-16', 'release_date' => '1970-02-13', 'number_of_tracks' => 7, 'label' => 'Vertigo', 'producer' => 'Rodger Bain', 'genre' => 'Heavy metal', 'band_id' => 1, 'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Paranoid', 'recorded_date' => '1970-06-21', 'release_date' => '1970-08-18', 'number_of_tracks' => 8, 'label' => 'Vertigo, Warner Bros.', 'producer' => 'Rodger Bain', 'genre' => 'Heavy metal', 'band_id' => 1, 'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Killing Is My Business... and Business Is Good!', 'recorded_date' => '1985-01-10', 'release_date' => '1985-06-12', 'number_of_tracks' => 8, 'label' => 'Combat', 'producer' => 'Dave Mustaine', 'genre' => 'Thrash metal', 'band_id' => 2, 'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Peace Sells... but Who\'s Buying?', 'recorded_date' => '1986-03-20', 'release_date' => '1986-09-19', 'number_of_tracks' => 8, 'label' => 'Capitol', 'producer' => 'Dave Mustaine', 'genre' => 'Thrash metal', 'band_id' => 2, 'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Separate Yourself', 'recorded_date' => null, 'release_date' => '1997-12-08', 'number_of_tracks' => 9, 'label' => 'Platinum Productions of America', 'producer' => '', 'genre' => 'Nu metal', 'band_id' => 3, 'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Struggle', 'recorded_date' => '1998-06-12', 'release_date' => '1998-05-18', 'number_of_tracks' => 12, 'label' => 'Jugular', 'producer' => 'Self-produced', 'genre' => 'Nu metal', 'band_id' => 3, 'created_at' => Carbon\Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}

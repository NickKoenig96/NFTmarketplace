<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $c1 = new \App\Models\Collection();
        $c1->title = "The solar system";
        $c1->description = "The Solar System is the gravitationally bound system of the Sun and the objects that orbit it, either directly or indirectly. Of the objects that orbit the Sun directly, the largest are the eight planets, with the remainder being smaller objects, the dwarf planets and small Solar System bodies. Of the objects that orbit the Sun indirectly—the natural satellites—two are larger than the smallest planet, Mercury.";
        $c1->save();

        $c2 = new \App\Models\Collection();
        $c2->title = "Andromeda galaxy";
        $c2->description = "The Andromeda Galaxy (IPA: /ænˈdrɒmɪdə/), also known as Messier 31, M31, or NGC 224 and originally the Andromeda Nebula (see below), is a barred spiral galaxy approximately 2.5 million light-years (770 kiloparsecs) from Earth and the nearest large galaxy to the Milky Way. The galaxy's name stems from the area of Earth's sky in which it appears, the constellation of Andromeda, which itself is named after the Ethiopian (or Phoenician) princess who was the wife of Perseus in Greek mythology. ";
        $c2->save();

        $c3 = new \App\Models\Collection();
        $c3->title = "Antennae Galaxies";
        $c3->description = "The Antennae Galaxies (also known as NGC 4038/NGC 4039 or Caldwell 60/Caldwell 61) are a pair of interacting galaxies in the constellation Corvus. They are currently going through a starburst phase, in which the collision of clouds of gas and dust, with entangled magnetic fields, causes rapid star formation. They were discovered by William Herschel in 1785.";
        $c3->save();

        $c4 = new \App\Models\Collection();
        $c4->title = "Messier 82";
        $c4->description = "Messier 82 (also known as NGC 3034, Cigar Galaxy or M82) is a starburst galaxy approximately 12 million light-years away in the constellation Ursa Major. A member of the M81 Group, it is about five times more luminous than the Milky Way and has a center one hundred times more luminous. The starburst activity is thought to have been triggered by interaction with neighboring galaxy M81. As the closest starburst galaxy to Earth, M82 is the prototypical example of this galaxy type";
        $c4->save();

        $c5 = new \App\Models\Collection();
        $c5->title = "TRAPPIST-1";
        $c5->description = "TRAPPIST-1, also designated 2MASS J23062928-0502285, is an ultra-cool red dwarf star with a radius slightly larger than the planet Jupiter, while having 94 times Jupiter's mass. It is about 40 light-years (12 pc) from the Sun in the constellation Aquarius. Seven temperate terrestrial planets have been detected orbiting it, more than any other planetary system except Kepler-90";
        $c5->save();

        
    }
}

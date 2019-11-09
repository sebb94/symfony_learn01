<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\Image;

class InheritanceEntietiesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for($i=1;$i<=2;$i++){
            $author = new Author();
            $author->setName('Author' . $i);
            $manager->persist($author);

            for($j=1;$j<=2;$j++){

                $pdf = new Pdf();
                $pdf->setFileName('PDF nr ' . $j);
                $pdf->setDescription('PDF desc ' . $j);
                $pdf->setSize(54545);
                $pdf->setPagesNumber(24);
                $pdf->setOrient('portrait');
                $pdf->setAuthor($author);
                $manager->persist($pdf);
            }

            for($k=1;$k<=3;$k++){

                $image = new image();
                $image->setFileName('image nr ' . $j);
                $image->setDescription('image desc ' . $j);
                $image->setSize(54545);
                $image->setFormat('jpg');
                $image->setQuality('HD');
                $image->setAuthor($author);
                $manager->persist($image);
            }

        }

        $manager->flush();
    }
}

<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Mooc\Video;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMoocVideoData extends AbstractFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $video1 = new Video(
            'Les produits transformés',
            'http://youtube.com/video-1',
            'https://img.youtube.com/vi/ktHEfEDhscU/0.jpg',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
            ex ea commodo consequat.',
            1
        );
        $manager->persist($video1);
        $this->addReference('mooc-video-1', $video1);

        $video2 = new Video(
            'Les produits transformés dans une deuxième vidéo',
            'http://youtube.com/video-2',
            'https://img.youtube.com/vi/ktHEfEDhscU/0.jpg',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
            ex ea commodo consequat.',
            2
        );
        $manager->persist($video2);
        $this->addReference('mooc-video-2', $video2);

        $video3 = new Video(
            'Les produits transformés dans une troisième vidéo',
            'http://youtube.com/video-3',
            'https://img.youtube.com/vi/ktHEfEDhscU/0.jpg',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
            ex ea commodo consequat.',
            2
        );

        $manager->persist($video3);
        $this->addReference('mooc-video-3', $video3);

        $manager->flush();
    }
}
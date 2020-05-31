<?php

namespace App\DataFixtures;

use App\Entity\Branch;
use App\Entity\Admin\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $em)
    {
        $user = new User();
        $user->setEmail('support@initiative.fr');
        $user->setUsername('support@initiative.fr');

        $password = $this->encoder->encodePassword($user, 's0l1d41r3-1n1t14t1v3');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setUpdatedAt(time());
        $user->setCreatedAt(time());

        $em->persist($user);

        $em->flush();
        
    }
}

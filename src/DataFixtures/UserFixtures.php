<?php

namespace DelPlop\UserBundle\DataFixtures;

use App\Entity\ApplicationUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER1_REFERENCE = 'user1';
    public const USER2_REFERENCE = 'user2';
    public const USER3_REFERENCE = 'user3';

    public function load(ObjectManager $manager)
    {
        $user = new ApplicationUser();
        $user->setLogin('Test1')
            ->setRoles(['ROLE_USER'])
            ->setEmail('test1@mail.com')
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$DreOeq5kCOYMTpd8AtzkpQ$xyAdrrC2DAWwgLockGggUa3zImNwG/faGV6WXj2SkZY');   // test
        $manager->persist($user);
        $this->addReference(self::USER1_REFERENCE, $user);

        $user2 = new ApplicationUser();
        $user2->setLogin('Test2')
            ->setRoles(['ROLE_USER'])
            ->setEmail('test2@mail.com')
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$DreOeq5kCOYMTpd8AtzkpQ$xyAdrrC2DAWwgLockGggUa3zImNwG/faGV6WXj2SkZY');   // test
        $manager->persist($user2);
        $this->addReference(self::USER2_REFERENCE, $user2);

        $user3 = new ApplicationUser();
        $user3->setLogin('Test3')
            ->setRoles(['ROLE_USER'])
            ->setEmail('test3@mail.com')
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$DreOeq5kCOYMTpd8AtzkpQ$xyAdrrC2DAWwgLockGggUa3zImNwG/faGV6WXj2SkZY');   // test
        $manager->persist($user3);
        $this->addReference(self::USER3_REFERENCE, $user3);

        $manager->flush();
    }
}

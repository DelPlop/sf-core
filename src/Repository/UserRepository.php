<?php

namespace DelPlop\UserBundle\Repository;

use App\Entity\ApplicationUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method ApplicationUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationUser[]    findAll()
 * @method ApplicationUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public const ITEM_PER_PAGE = 50;

    public function __construct(ManagerRegistry $registry, string $class = ApplicationUser::class)
    {
        parent::__construct($registry, $class);
    }

    public function getPaginator(int $offset, array $criteria = []): Paginator
    {
        $qb = $this->createQueryBuilder('u');
        foreach ($criteria as $criterionName => $criterionValue) {
            if ($criterionValue === null) {
                $qb->andWhere('u.' . $criterionName . ' IS NULL');
            } else {
                $qb->andWhere('u.' . $criterionName . ' = :crit')
                    ->setParameter('crit', $criterionValue);
            }
        }
        $qb->orderBy('u.id', 'ASC')
            ->setMaxResults(self::ITEM_PER_PAGE)
            ->setFirstResult($offset);

        return new Paginator($qb->getQuery());
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof ApplicationUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }
}

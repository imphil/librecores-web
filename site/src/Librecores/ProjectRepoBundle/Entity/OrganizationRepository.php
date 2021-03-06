<?php
namespace Librecores\ProjectRepoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * OrganizationRepository
 *
 * Extends the default repository with custom functionality.
 */
class OrganizationRepository extends EntityRepository
{
    /**
     * Find all the organizations that a user owns.
     *
     * @param User $user
     * @return ArrayCollection of Organizations
     */
    public function findAllByOwnerOrderedByName(User $user)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('o')
            ->from('LibrecoresProjectRepoBundle:Organization', 'o')
            ->where('o.owner = :owner')
            ->setParameter('owner', $user->getId())
            ->orderBy('o.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find all the organizations that a user is a member of.
     *
     * @param User $user
     * @return ArrayCollection of Organizations
     */
    public function findAllByMemberOrderedByName(User $user)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('o')
            ->from('LibrecoresProjectRepoBundle:Organization', 'o')
            ->innerJoin('o.members', 'm')
            ->where('m.id = :member')
            ->setParameter('member', $user->getId())
            ->orderBy('o.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find an organization by its name.
     *
     * @param string $organizationName
     * @return NULL|Organization
     */
    public function findOneByName($organizationName)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('o')
            ->from('LibrecoresProjectRepoBundle:Organization', 'o')
            ->where('o.name = :name')
            ->setParameter('name', $organizationName)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

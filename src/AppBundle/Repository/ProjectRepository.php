<?php

namespace AppBundle\Repository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * return all project with status $status
     * @return mixed
     */
    public function getProjectsByStatus($status) {
        $qb = $this
            ->createQueryBuilder('p')
            ->setParameter('status', $status)
            ->where('p.status =:status')
            ->getQuery();
        return $qb->getResult();
    }

    /**
     * return all project with status 2 and endDate passed
     * @return mixed
     */
    public function getEndDateProjectStatusTwo($today) {
        $qb = $this
            ->createQueryBuilder('p')
            ->setParameter('today', $today)
            ->where('p.status = 2')
            ->andWhere('p.endDate < :today')
            ->getQuery();
        return $qb->getResult();
    }


    /**
     * return number of project by status $status
     * @return mixed
     */
    public function getNumberProjectsByStatus() {
        $qb = $this
            ->createQueryBuilder('p')
            ->select('COUNT(p) as number', 'p.status as status')
            ->groupBy('p.status')
            ->getQuery();
        return $qb->getResult();
    }

    /**
     * return number of project by skill
     * @return mixed
     */
    public function getProjectsBySkill($idSkill) {
        $qb = $this
            ->createQueryBuilder('p')
            ->join('p.author', 'ua')
            ->leftjoin('p.happyCoach', 'uHC')
            ->leftjoin('p.teamProject', 't')
            ->select('p.title', 'p.startingDate', 'p.endDate', 'p.status', 'p.location', 'p.slug as slugProject',
                'ua.firstName as firstNameAuthor', 'ua.lastName as lastNameAuthor', 'ua.slug as slugAuthor', 'ua.photo as photoAuthor',
                'uHC.firstName as firstNameHCRef', 'uHC.lastName as lastNameHCRef', 'uHC.photo as photoHCRef', 'uHC.slug as slugHCRef',
                'count(t.firstName) as nbUserTeam' )
            ->groupBy('p.id')
            ->setParameter('idSkill', $idSkill)
            ->where('p.theme =:idSkill')
            ->getQuery();
        return $qb->getResult();
    }


}


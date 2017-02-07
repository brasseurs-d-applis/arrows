<?php

namespace BrasseursApplis\Arrows\App\Finder;

use BrasseursApplis\Arrows\App\DTO\UserDTO;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserFinder extends BaseFinder
{
    /**
     * @param mixed $id
     * @param int   $lockMode
     * @param int   $lockVersion
     *
     * @return UserDTO
     *
     * @throws ORMInvalidArgumentException
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    /**
     * @param string $userName
     *
     * @return UserDTO
     *
     * @throws ORMInvalidArgumentException
     */
    public function findByUserName($userName)
    {
        /** @var UserDTO $user */
        $user = $this->findOneBy(['userName' => $userName]);
        $this->detach($user);

        return $user;
    }

    /**
     * @param array $sortBy
     * @param int   $pageNumber
     * @param int   $numberByPage
     *
     * @return Paginator
     *
     * @throws \OutOfBoundsException
     */
    public function getPaginatedUsers(array $sortBy = [], $pageNumber = 1, $numberByPage = 20)
    {
        return parent::getPaginatedScenarios($sortBy, $pageNumber, $numberByPage);
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation as Api;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @Api\ApiResource(
 *     collectionOperations={},
 *     itemOperations={"GET"}
 * )
 * @ORM\Entity
 * Class Interest
 */
class Interest
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="interest")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="interest")
     * @Groups("user")
     */
    private $project;

    /**
     * @var int
     *
     * @ORM\Column(name="bet", type="integer", nullable=false)
     * @Groups("user")
     *
     */
    private $bet;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user.
     *
     * @param User $user
     *
     * @return Interest
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set project.
     *
     * @param Project $project
     *
     * @return Interest
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project.
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set bet.
     *
     * @param int $bet
     *
     * @return Interest
     */
    public function setBet(int $bet)
    {
        $this->bet = $bet;

        return $this;
    }

    /**
     * Get bet.
     *
     * @return int
     */
    public function getBet()
    {
        return $this->bet;
    }
}

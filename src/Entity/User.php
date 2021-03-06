<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/07/18
 * Time: 16:48
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation as Api;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Api\ApiResource(attributes={
 *          "normalization_context"={"groups"={"user"}}
 *      },
 *     collectionOperations={},
 *     itemOperations={
 *         "login"={
 *             "route_name"="authentication_token",
 *             "swagger_context"={
 *                  "parameters"={
 *                      {
 *                          "name"="user",
 *                          "in"="body",
 *                          "required"="true",
 *                          "schema"={
 *                              "type"="object",
 *                              "required"={"email", "password"},
 *                              "properties"={
 *                                  "email"={"type"="string"},
 *                                  "password"={"type"="string"}
 *                              }
 *                          }
 *                      }
 *                   },
 *                  "summary" = "Generate a valid jwt token",
 *                  "consumes" = {
 *                      "application/json"
 *                   },
 *                  "produces" = {
 *                      "application/json"
 *                   }
 *              }
 *         },
 *         "post_interest"={
 *           "route_name"="post_interest",
 *           "swagger_context": {
 *                  "parameters": {
 *                     { "name": "id", "in": "path", "required": "true", "type": "string" },
 *                     {
 *                          "name"="interest",
 *                          "in"="body",
 *                          "required"="true",
 *                          "schema"={
 *                              "type"="object",
 *                              "required"={"project", "bet"},
 *                              "properties"={
 *                                  "project"={"type"="string"},
 *                                  "bet"={"type"="string"}
 *                              }
 *                          }
 *                      }
 *                   },
 *                  "summary"="Set a interest for a project."
 *              },
 *           "access_control"="is_granted('ROLE_USER') and object.getId() == user.getId()",
 *           "defaults": {"_api_receive": false},
 *          },
 *         "get_interests"={
 *           "method"="GET",
 *           "path"="/users/{id}/interests",
 *           "access_control"="is_granted('ROLE_USER') and object.getId() == user.getId()",
 *          },

  *     }
 * )
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $salt;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Interest", mappedBy="user")
     * @ORM\JoinColumn(referencedColumnName="id", unique=true)
     * @ApiSubresource
     * @Groups("user")
     */
    private $interests;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param array $roles
     *
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @param string $role
     *
     * @return User
     */
    public function addRoles(string $role): User
    {
        if (!\in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword(string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @param string $salt
     *
     * @return User
     */
    public function setSalt(string $salt): User
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        // email will be our username
        $this->username = $email;
        $this->email = $email;

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    /**
     * @return mixed
     */
    public function getInterests()
    {
        return $this->interests;
    }
}

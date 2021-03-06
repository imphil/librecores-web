<?php
namespace Librecores\ProjectRepoBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Model: a search query
 */
class SearchQuery
{
    const TYPE_USERS = 'users';
    const TYPE_PROJECTS = 'projects';

    /**
     * The search query string
     *
     * @Assert\Length(max = 200)
     */
    protected $q;

    /**
     * What are type of result are we looking for?
     *
     * @Assert\NotBlank()
     * @Assert\Choice({"projects", "users"})
     */
    protected $type = self::TYPE_PROJECTS;

    /**
     * Set the query string
     *
     * @param string $q
     */
    public function setQ($q)
    {
        $this->q = $q;
    }

    /**
     * Get the query string
     */
    public function getQ()
    {
        return $this->q;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}

<?php

namespace App\Controller;

use ApiPlatform\Core\Exception\InvalidArgumentException;
use App\Entity\Interest;
use App\Entity\Project;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostInterest extends AbstractController
{
    /**
     * @Route(
     *     name="post_interest",
     *     path="/api/users/{id}/interest.{_format}",
     *     methods={"POST"},
     *     defaults={
     *          "_format"=null,
     *         "_api_resource_class"=User::class,
     *         "_api_item_operation_name"="post_interest"
     *     }
     * )
     */
    public function __invoke($id, User $data, Request $request)
    {
        $invest = json_decode($request->getContent(), true);
        if (2 !== count(array_intersect_key(['bet' => 1, 'project' => 1], $invest))) {
            throw new InvalidArgumentException('Invest not set');
        }
        $em = $this->getDoctrine()->getManager();
        if (!$project = $em->getRepository(Project::class)->find($invest['project'])) {
            throw new InvalidArgumentException(
                'No project found for id '.$invest['project']
            );
        }

        $interest = new Interest();
        $interest->setBet($invest['bet']);
        $interest->setProject($project);
        $interest->setUser($data);

        $em->persist($interest);
        $em->flush();

        return $data;
    }
}

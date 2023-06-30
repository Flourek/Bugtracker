<?php
/**
 * Hello controller.
 */

namespace App\Controller;

use App\Entity\Bug;
use App\Repository\BugRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HelloController.
 */
class TaskController extends AbstractController
{
    /**
     * Index action.
     *
     * @param string $name User input
     *
     * @return Response HTTP response
     */
    #[Route(
        '/lol',
        name: 'lol_index',
    )]
    public function index(BugRepository $rep): Response
    {   
        $bugs = $rep->findAll();
        return $this->render(
            'lol.html.twig',
            ['bugs' => $bugs]
        );
    }

        /**
     * Show action.
     *
     * @param Task $task Task entity
     *
     * @return Response HTTP response
     */

}
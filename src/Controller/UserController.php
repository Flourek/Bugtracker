<?php
/**
 * Hello controller.
 */

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Repository\UserRepository;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class HelloController.
 */
class UserController extends AbstractController
{
    /**
     * Index action.
     *
     * @param string $name User input
     *
     * @return Response HTTP response
     */
        
    #[Route('/user/{username}', name: 'user_index', defaults: ['username' => ""])]
    public function index(UserRepository $rep, string $username): Response
    {
        // $bugs = $bugRep->findAll();

        $user = NULL;
        $assigned = NULL;
        $comments = NULL;
        $bugs = NULL;
        $exists = TRUE;

        if(empty($username)){
            $user = $this->getUser();
        }else{
            $user = $rep->findOneByUsername($username);
        }
        
        if( isset($user) ){
            $comments = $user->getComments();
            $bugs = $user->getBugs();
            $assigned = $user->getAssignedTo();
        }else{
            if( $this->getUser()){
                $exists = FALSE;
            }else{
			    return $this->redirectToRoute('app_login');
            }
        }
       
        return $this->render( 'user.html.twig',
            ['user' => $user,
            'comments' => $comments,
            'bugs' => $bugs,
            'assigned' => $assigned,
            'exists' => $exists]
        );
    }






}
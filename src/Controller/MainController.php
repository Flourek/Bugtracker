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
use App\Entity\User;
use App\Repository\BugRepository;
use App\Repository\UserRepository;
use App\Form\CommentType;
use App\Form\AssignType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class HelloController.
 */
class MainController extends AbstractController
{
    /**
     * Index action.
     *
     * @param string $name User input
     *
     * @return Response HTTP response
     */
        
    #[Route('/{id}', name: 'main_index', requirements: ['id' => '[1-9]\d*'], defaults: ['id' => -1])]
    public function index(Request $request, BugRepository $bugRep, UserRepository $userRep, EntityManagerInterface $manager, int $id): Response
    {
        $bugs = $bugRep->findAll();

        if($id == -1){
            $activeBug = $bugRep->findOneBy([], ['id' => 'ASC']);
        }else{
            $activeBug = $bugRep->find($id);
        }

        $comments = $activeBug->getComments();


        $newComment = new Comment;
		$commentForm = $this->createForm(CommentType::class, $newComment);
        $commentForm->handleRequest($request);
        
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
           
			$newComment = $commentForm->getData();
			$newComment->setCreatedAt(new \DateTimeImmutable('now'));
            $newComment->setAuthor($this->getUser());
            $newComment->setBug($activeBug);
           
			$manager->persist($newComment);
			$manager->flush();
            return $this->redirect($request->getUri());

		}

        $assignForm = $this->createFormBuilder()
            ->add('username', TextType::class, ['required' => 'false', 'attr' => ['class' => 'form-control']])
            ->add('toDelete')
            ->add('save', SubmitType::class)
            ->getForm();

        $assignForm->handleRequest($request);
        if ($assignForm->isSubmitted() && $assignForm->isValid()) {

			$data = $assignForm->getData();
            if(isset($data['username'])){
                $user = $userRep->findOneBy(['username' => $data['username']]);
                if(isset($user)){
                    $activeBug->addAssigned($user);
                    $manager->persist($activeBug);
                    $manager->flush();
                }
            }
            // return new Response($data['username']); 
            
            if(isset($data['toDelete'])){
                $user = $userRep->find($data['toDelete']);
                $activeBug->removeAssigned($user);
                $manager->persist($activeBug);
                $manager->flush();
            }


        }



        return $this->render( 'main.html.twig',
            ['bugs' => $bugs,
            'activeBug' => $activeBug,
            'commentForm' => $commentForm->createView(),
            'assignForm' => $assignForm->createView(),
            'comments' => $comments,
            'assignedUsers' => $activeBug->getAssigned()
            ]
        );
    }






}
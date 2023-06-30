<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\Bug;
use App\Form\BugType;
use App\Controller\SecurityController;

/**
 * Class HelloController.
 */
class ReportController extends AbstractController
{
	/**
	 * Index action.
	 *
	 * @param string $name User input
	 *
	 * @return Response HTTP response
	 */

	#[Route('/report',name: 'report_index',)]
	public function index(Request $request, EntityManagerInterface $manager): Response
	{
		$bug = new Bug();

		if ($this->getUser() == false) {
			return $this->redirectToRoute('app_login');
		}

		$form = $this->createForm(BugType::class, $bug);

		$form->handleRequest($request);	
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			
			$bug->setCreatedAt(new \DateTimeImmutable('now'));
			$bug->setAuthor($this->getUser());

			$manager->getRepository(Bug::class);
			$manager->persist($bug);
			$manager->flush();

			$bug = $manager->find(Bug::class, $bug);
			return $this->redirectToRoute('main_index', ['id'=>$bug->getId()]);
		}

		return $this->render('report.html.twig', [
			'form' => $form->createView(),
		]);
	}

	#[Route('/chuj',name: 'chuj',)]
	public function chuj(): Response
	{
		return new Response("eh");

	}
	
}
<?php

    namespace App\Controller;

    use App\Entity\Tag;
    use App\Form\TagType;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class TagController extends AbstractController
    {
        /**
         * @Route("/tag", name="tag")
         */
        public function index(Request $request)
        {
            $repository = $this->getDoctrine()->getRepository(Tag::class);

// look for a single Product by its primary key (usually "id")
            $tags = $repository->findAll();

            $listItem = new Tag();

            $form = $this->createForm(TagType::class, $listItem);

            $form->handleRequest($request);

            if ($form->isSubmitted() ) {
                // Encode the new users password

                if (count($errors) > 0) {
                    return new Response((string) $errors, 400);
                }

                // Save
                $em = $this->getDoctrine()->getManager();
                $em->persist($listItem);
                $em->flush();

                  return $this->redirectToRoute('tag');
            }

            return $this->render('tag/index.html.twig', [
                    'tags' => $tags,
                    'form' => $form->createView(),
            ]);
        }
    }

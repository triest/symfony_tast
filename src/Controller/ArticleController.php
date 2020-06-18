<?php

    namespace App\Controller;

    use App\Entity\Article;
    use App\Form\ArticleType;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class ArticleController extends AbstractController
    {
        /**
         * @Route("/article", name="article")
         */
        public function index()
        {
            $articles = $this->getDoctrine()
                    ->getRepository(Article::class)
                    ->findAll();

            return $this->render('article/index.html.twig', [
                    'articles' => $articles,
            ]);
        }

        /**
         * @Route("/article/create", name="articleCreate")
         */
        public function create(Request $request)
        {

            $listItem = new Article();

            $form = $this->createForm(ArticleType::class, $listItem);

            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                // Encode the new users password


                // Save
                $em = $this->getDoctrine()->getManager();
                $em->persist($listItem);
                $em->flush();


                //     return $this->redirectToRoute("list");
                //  return $this->redirectToRoute('app_login');
            }


            return $this->render('article/create.html.twig', [
                    'form' => $form->createView(),
            ]);
        }

        /**
         * @Route("/article/{id}", name="getArticle")
         */
        public function getItem(Request $request, $id)
        {


            $repository = $this->getDoctrine()->getRepository(Article::class);

            $product = $repository->find($id);


            if (!$product) {
                throw $this->createNotFoundException('The product does not exist');
            }

            return $this->render('article/view.html.twig', [
                    'article' => $product,
            ]);
        }
    }

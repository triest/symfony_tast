<?php

    namespace App\Controller;

    use App\Entity\ListItem;
    use App\Form\ListType;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;

    class ListController extends AbstractController
    {
        /**
         * @Route("/list", name="list")
         */
        public function index(Request $request)
        {

            $companies = [
                    'Apple' => '$1.16 trillion USD',
                    'Samsung' => '$298.68 billion USD',
                    'Microsoft' => '$1.10 trillion USD',
                    'Alphabet' => '$878.48 billion USD',
                    'Intel Corporation' => '$245.82 billion USD',
                    'IBM' => '$120.03 billion USD',
                    'Facebook' => '$552.39 billion USD',
                    'Hon Hai Precision' => '$38.72 billion USD',
                    'Tencent' => '$3.02 trillion USD',
                    'Oracle' => '$180.54 billion USD',
            ];



            return $this->render('list/index.html.twig', [
                    'companies' => $companies,
            ]);
        }



        /**
         * @Route("/list/create", name="create")
         */
        public function create(Request $request)
        {

            $listItem=new ListItem();

            $form = $this->createForm(ListType::class,$listItem );

            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                // Encode the new users password


                // Save
                $em = $this->getDoctrine()->getManager();
                $em->persist($listItem);
                $em->flush();

                return $this->redirectToRoute("list");
                //  return $this->redirectToRoute('app_login');
            }

            return $this->render('list/create.html.twig', [
                    'form' => $form->createView(),
            ]);

        }

        /**
         * @Route("/list/{id}", name="get")
         */
        public function getItem(Request $request, $id)
        {

            $companies = [
                    'Apple' => '$1.16 trillion USD',
                    'Samsung' => '$298.68 billion USD',
                    'Microsoft' => '$1.10 trillion USD',
                    'Alphabet' => '$878.48 billion USD',
                    'Intel Corporation' => '$245.82 billion USD',
                    'IBM' => '$120.03 billion USD',
                    'Facebook' => '$552.39 billion USD',
                    'Hon Hai Precision' => '$38.72 billion USD',
                    'Tencent' => '$3.02 trillion USD',
                    'Oracle' => '$180.54 billion USD',
            ];


            $repository = $this->getDoctrine()->getRepository(ListItem::class);

            $product = $repository->find($id);

            dump($product);
          //  die("d");

            return $this->render('list/view.html.twig', [
                    'companies' => $product,
            ]);
        }

    }
<?php

namespace App\Controller;

use App\Entity\MetricForm;
use App\Entity\MetricsData;
use App\Form\MetricType;
use App\Repository\MetricsDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MetricController extends AbstractController
{
    /**
     * @Route("/metric", name="metric")
     */
    public function index()
    {
        // get metrics
        $entities = $this->getDoctrine()->getRepository("App:MetricsData")->findAll();

        return $this->render('metric/index.html.twig',[
            'entities' => $entities,
            'controller_name' => 'MetricController',
        ]);
    }
    /**
     * @Route("/metric/create", name="create_metric", methods={"POST"})
     */
    public function createMetric(): Response{
        $entityManager = $this->getDoctrine()->getManager();

        //Generating data for  past 5minutes
        for($i = 0; $i<5; $i++){
            $metric_data = new MetricsData();
            //converting string to datetime
            $date = new \DateTime('@'.$metric_data->generateTimestamp($i));
            $metric_data->setTimestamp($date);
            $metric_data->setCpuLoad($metric_data->generateCPULoad());
            $metric_data->setConcurrency($metric_data->generateConcurrency());

            $entityManager->persist($metric_data);
            $entityManager->flush();

            //Displaying data which is stored
           echo date('d-m-Y H:i:s',$metric_data->generateTimestamp($i)) . '<br/>';
        }
        echo '<br/>';
        return new Response('Saved metric data for past 5minutes');
    }

    /**
     * @Route("/metric/create/form", name="create_metric_form", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function createMetricForm(Request $request)
    {
        $metric_form = new MetricForm();

        $form = $this->createForm(MetricType::class, $metric_form);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $repository = $this->getDoctrine()->getRepository(MetricsData::class);

            $start_time = $data->startTime;
            $end_time = $data->endTime;

            $query = $repository->createQueryBuilder('md')
                ->add('where','md.timestamp between :start AND :end')
                ->setParameter('start', $start_time->format('Y-m-d H:i:s'))
                ->setParameter('end',$end_time->format('Y-m-d H:i:s'))
                ->getQuery();

            $metrics = $query->getResult();
            return $this->render('metric/index.html.twig', ['entities' => $metrics]);
        }

        return $this->render('metric/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

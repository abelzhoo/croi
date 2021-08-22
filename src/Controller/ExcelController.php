<?php

namespace App\Controller;

use App\Form\ExcelType;
use App\Entity\Santer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use League\Csv\Reader;

class ExcelController extends AbstractController
{
    /**
     * @Route("/admin/import", name="app_import_excel")
     */
    public function index(Request $request, SluggerInterface $slugger)
    {
        $spreadsheet = new Spreadsheet();
        $form = $this->createForm(ExcelType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) { 
            $excelData = $form->getData();
            
            $sheet = $spreadsheet->getActiveSheet();

            if( $excelData['data'][0] == "Sante" ||
                $excelData['data'][0] == "Education" ||
                $excelData['data'][0] == "Logement" ||
                $excelData['data'][0] == "Sport"){
                    $sheet->setTitle('DEPARTEMENT'. $excelData['data'][0]);
            }else{
                $sheet->setTitle("EXCEL POUR " . $excelData['data'][0] . "FAMILLE");
            }

            $sheet->getCell('A1')->setValue('ID');
            $sheet->getCell('B1')->setValue('NOM');
            $sheet->getCell('D1')->setValue('PRENOM');
            $sheet->getCell('E1')->setValue('DATE NAISSANCE');
            $sheet->getCell('F1')->setValue('LIEU NAISSANCE');
            $sheet->getCell('G1')->setValue('SEXE');
            $sheet->getCell('H1')->setValue('NATIONALITE');
            $sheet->getCell('I1')->setValue('DOCUMENT');
            $sheet->getCell('J1')->setValue('NUMERO PASSPORT');
            $sheet->getCell('K1')->setValue('NUMERO CIN');
            $sheet->getCell('L1')->setValue('SITUATION MARITAL');
            $sheet->getCell('M1')->setValue('NUMERO TELEPHONE');
            if($excelData['data'][0] === "mere"){
                $sheet->getCell('N1')->setValue('NOMBRE ENFANTS');
            }
            $sheet->fromArray($this->getData($excelData),null, 'A2');

            $writer = new Xlsx($spreadsheet);
            $writer->save($excelData['data'][0].'.xlsx');
        }

        return $this->render('excel/index.html.twig', [
                            'form' => $form->createView(),
                            'title' => 'EXPORTER LES DONNEES'
        ]);

    }

    private function getData($data): array
    {
        $liste = [];

        $entities = ucwords($data != null ? $data['data'][0]: null);
        $entity = "App\Entity\\".$entities;
        $dataExports = $this->getDoctrine()
        ->getManager()
        ->getRepository($entity)->findAll();

        foreach ($dataExports as $dataExport) {
            $liste[] = [
                $dataExport->getId(),
                $dataExport->getNomFamille(),
                $dataExport->getPrenomFamille(),
                $dataExport->getDateNaissance()->format('d-m-Y'),
                $dataExport->getLieuNaissance(),
                $dataExport->getSexe(),
                $dataExport->getNationalite(),
                $dataExport->getDocumentVoyage(),
                $dataExport->getNumeroPassport(),
                $dataExport->getNumeroCIN(),
                $dataExport->getSituationMarital(),
                $dataExport->getNumeroTelephone(),
                $dataExport->getNombre() ? $dataExport->getNombre() : null
            ];
        }
        return $liste;
    }

}
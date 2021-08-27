<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;

use App\Entity\Personne;
use App\Entity\Education;

class CsvImportCommand extends Command{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('import data excel');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('En attend d import ...');

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Data/MOCK_DATA.csv');
        //dd($reader);

        $results = $reader->fetchAssoc();

        foreach($results as $row){
            $personne = (new Personne())
                    ->setNom($row['nom'])
                    ->setPrenom($row['prenom'])
                    ->setLieuNaissance($row['lieu_naissance'])
                    ->setNationalite($row['nationalite'])
                    ->setSituationMarital($row['situation_marital'])
                    ->setSpecialite($row['specialite'])
                    ->setGroupSangin($row['group_sangin'])
                    ->setPaysOrigin($row['pays_origin'])
                    ->setDateNaissance(new \DateTime($row['date_naissance']))
                    ->setSituationProfessionnel($row['situation_professionnel'])
                    ->setSexe($row['sexe']);
            $this->em->persist($personne);

            $education = (new Education())
                        ->setEcole($row['ecole'])
                        ->setClasse($row['classe'])
                        ->setNiveau($row['niveau'])
                        ->setDiplome($row['diplome'])
                        ->setAnnee($row['annee'])
                        ->setPersonne($personne);
            $this->em->persist($education);

            /*$logement = (new Logement())
                        ->setProprietaire($row['proprietaire'])
                        ->setAdressePermanente($row['adressePermanente'])
                        ->setAdresseTemporaire($row['adresseTemporaire'])
                        ->setVille($row['ville'])
                        ->setCodePostale($row['codePostale'])
                        ->setProvince($row['province'])
                        ->setRegion($row['region'])
                        ->setMaisonAllouer($row['maisonAllouer'])
                        ->setAnnee($row['annee'])
                        ->setPersonne($personne);
            $this->em->persist($logement);

            $sante = (new Maladie())
                    ->setNom($row['nom'])
                    ->setEvacuation($row['evacuation'])
                    ->setChirurgie($row['chirurgie'])
                    ->setNomChirurgie($row['nomChirurgie'])
                    ->setCoutDiagnostique($row['coutDiagnostique'])
                    ->setcoutEvacuation($row['coutEvacuation'])
                    ->setDateChirurgie($row['dateChirurgie'])
                    ->setDateEvacuation($row['dateEvacuation'])
                    ->setType($row['type'])
                    ->setAnnee($row['annee'])
                    ->setPersonne($personne);
            $this->em->persist($sante);

            $sport = (new Sport())
                    ->setNom($row['nom'])
                    ->setFrequence($row['frequence'])
                    ->setLecture($row['lecture'])
                    ->setAnnee($row['annee'])
                    ->setPersonne($personne);
            $this->em->persist($sport);

            $finance = (new Finance())
                     ->setSalaire($row['salaire'])
                     ->setLoyer($row['loyer'])
                     ->setPrimeGratification($row['primeGratification'])
                     ->setPersonne($personne);
            $this->em->persist($finance);

            $social = (new Social())
                    ->setAllocationSolidaritePersonneAgee($row['allocationSolidaritePersonneAgee'])
                    ->setProtectionMaladieEtMedicament($row['protectionMaladieEtMedicament'])
                    ->setComplementaireSante($row['complementaireSante'])
                    ->setAnnee($row['annee'])
                    ->setPersonne($personne)
                    ->setFinance($finance);
            $this->em->persist($social);*/
        }

        $this->em->flush();

        return $io->success('Fini avec succèss');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Aleck
 * Date: 18/10/2017
 * Time: 14:49
 */

namespace BT\NaoBundle\Command;


use BT\NaoBundle\Entity\Bird;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCsvCommand extends Command
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this->setName('csv:import')
            ->setDescription('Import csv file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Importing.....');
        $reader = Reader::createFromPath('%kernel.root_dir%/../src/BT/NaoBundle/Data/taxref.csv');
        $reader->setDelimiter(';');
        $result = $reader->fetchAssoc();
        foreach ($result as $row)
        {
            $bird = (new Bird())
                ->setOrdre($row['ORDRE'])
                ->setFamille($row['FAMILLE'])
                ->setCdNom($row['CD_NOM'])
                ->setHabitat($row['HABITAT'])
                ->setLbNom($row['LB_NOM'])
                ->setNomComplet($row['NOM_COMPLET'])
                ->setNomValide($row['NOM_VALIDE'])
                ->setNomVern($row['NOM_VERN']);
            $this->em->persist($bird);
        }

        $this->em->flush();
        $io->success('Success !');
    }
}
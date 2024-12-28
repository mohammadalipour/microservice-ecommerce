<?php

namespace App\Command;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:seed-products',
    description: 'Seeds the products table with 100 random products.',
)]
class SeedProductsCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 100; $i++) {
            $product = new Product();
            $product->setName($faker->words(3, true)); // e.g., "Wireless Gaming Mouse"
            $product->setDescription($faker->sentence(10)); // Random sentence
            $product->setPrice($faker->randomFloat(2, 10, 1000)); // Price between 10 and 1000
            $product->setImage('/images/' . $faker->word() . '.jpg'); // Fake image path
            $product->setCreatedAt(new \DateTime());

            $this->entityManager->persist($product);
        }

        $this->entityManager->flush();

        $output->writeln('<info>Seeded 100 products successfully!</info>');

        return Command::SUCCESS;
    }
}

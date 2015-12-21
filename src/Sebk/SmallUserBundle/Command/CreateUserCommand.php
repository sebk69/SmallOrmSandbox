<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sebk\SmallUserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('sebk:small-users:create-user')
            ->setDescription('Create a user')
            ->addArgument(
                'email', InputArgument::REQUIRED, 'email of user'
            )
            ->addArgument(
                'password', InputArgument::REQUIRED, 'password'
            )
            ->addArgument(
                'nickname', InputArgument::OPTIONAL, 'nickname'
            )
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $userDao = $this->getContainer()
            ->get("sebk_smallorm_dao")
            ->get("SebkSmallUserBundle", "User");
        
        $user    = $userDao->newModel();

        try {
            $user->setEmail($input->getArgument("email"));
            $user->setPassword($input->getArgument("password"));
            if ($input->getArgument("nickname") !== null) {
                $user->setNickname($input->getArgument("nickname"));
            } else {
                $user->setNickname($input->getArgument("email"));
            }

            $user->setCreatedAt(new \DateTime);

            $userDao->persist($user);

            $output->writeln("User created");
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }
    }
}
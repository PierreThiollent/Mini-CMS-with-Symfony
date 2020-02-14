<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 9; $i++) {
            $articles = new Articles();
            $articles->setTitle('Coronavirus – Le monde bascule dans le chaos après l’annonce d’un possible report de la Playstation 5');
            $articles->setSlug('article-' . $i);
            $articles->setContent('Les affrontements ont commencé dès que la nouvelle est tombée sur les sites d’infos. « Dans un premier temps, on ne voulait pas y croire » raconte cette jeune femme installée sur un check-point à une intersection, fusil en main. « On s’est dit, ça y est c’est la Fin, l’Effondrement dont on nous avait tant parlé ». Car pour beaucoup l’annonce d’un possible retard ou d’une suspension des livraisons de la Playstation 5 a été interprétée comme un des signes que la civilisation, telle qu’on avait pu la connaître, était maintenant terminée. Ainsi, plusieurs centaines de millions de personnes qui avaient pris un travail régulier pour pouvoir gagner un peu d’argent et s’acheter la nouvelle console ont vite compris que leur entreprise serait vaine et ne se sont donc logiquement pas rendues au travail, bloquant de fait l’économie de dizaines de pays et précipitant en quelques minutes des puissances à genoux. « Retournez au travail, retournez au travail s’il vous plait, on fera tout pour que vous obteniez vos PS5 » ont imploré plusieurs chefs d’entreprises à leurs employés qui avaient préféré rester chez eux. « La seule raison pour laquelle je trimais dans ce taf, c’était pour avoir les quelques billets pour me payer ma PS5. Sans PS5, je vois pas l’intérêt que j’ai à rester, vu qu’en plus on ne peut même plus avoir confiance dans les points retraites » explique un jeune homme, les yeux rougis d’avoir pleuré toute la nuit après découvert que des délais supplémentaires seraient aussi à prévoir pour les livraisons des nouveaux modèles de iPhone. « C’est la fin, c’est la fin, je suis pas prêt! »');
            $manager->persist($articles);
        }
        $manager->flush();
    }
}

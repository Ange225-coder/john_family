<?php

    namespace App\Twig\Extension;

    use Twig\Extension\AbstractExtension;
    use Twig\TwigFilter;

    class DateExtension extends AbstractExtension
    {
        public function getFilters(): array
        {
            return [
                // Déclare le filtre "activity_date" pour Twig
                new TwigFilter('activity_date', [$this, 'formatActivityDate']),
            ];
        }

        public function formatActivityDate(?\DateTimeInterface $date): string
        {
            if (!$date) {
                return '';
            }

            $now = new \DateTimeImmutable();
            $today = $now->setTime(0, 0, 0);
            $yesterday = $today->modify('-1 day');

            $activityDay = \DateTimeImmutable::createFromInterface($date)->setTime(0, 0, 0);

            // Si la date est aujourd'hui
            if ($activityDay == $today) {
                return "Aujourd'hui · " . $date->format('H:i');
            }

            // Si la date est hier
            if ($activityDay == $yesterday) {
                return "Hier · " . $date->format('H:i');
            }

            // Si la date est plus ancienne
            $diff = $today->diff($activityDay)->days;
            return "Il y a " . $diff . " jours";
        }
    }

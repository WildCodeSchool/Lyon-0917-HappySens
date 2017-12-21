<?php
/**
 * Created by PhpStorm.
 * User: aurelie
 * Date: 05/12/17
 * Time: 16:44
 */

namespace AppBundle\Service;


class StatusProject
{

    public function getStatusTwig($status)
    {
        $statusTwig = [
            'class' => "",
            'text' => ""
        ];
        switch (true) {
            case $status == 1:
                $statusTwig['class'] = "chip inProgress";
                $statusTwig['text'] = 'En attente';
                break;
            case $status == 2:
                $statusTwig['class'] = "chip validate";
                $statusTwig['text'] = 'En cours';
                break;
            case $status == 3:
                $statusTwig['class'] = "chip end";
                $statusTwig['text'] = 'Terminé';
                break;
        }
        return $statusTwig;
    }

    public function getProjectsWithStatus($projects)
    {
        for ($i = 0; $i < count($projects); $i++) {
            $status = $projects[$i]->getStatus();
            $statusTwig = [
                'class' => "",
                'text' => ""
            ];
            switch (true) {
                case $status == 1:
                    $statusTwig['class'] = "chip inProgress";
                    $statusTwig['text'] = 'En attente';
                    break;
                case $status == 2:
                    $statusTwig['class'] = "chip validate";
                    $statusTwig['text'] = 'En cours';
                    break;
                case $status == 3:
                    $statusTwig['class'] = "chip end";
                    $statusTwig['text'] = 'Terminé';
                    break;
            }
            $projects[$i]->setStatus(['class' => $statusTwig['class'], 'text' => $statusTwig['text']]);
        }

        return $projects;
    }

    public function getProjectWithStatus($project)
    {
            $status = $project->getStatus();
            $statusTwig = [
                'class' => "",
                'text' => ""
            ];
            switch (true) {
                case $status == 1:
                    $statusTwig['class'] = "chip inProgress";
                    $statusTwig['text'] = 'En attente';
                    break;
                case $status == 2:
                    $statusTwig['class'] = "chip validate";
                    $statusTwig['text'] = 'En cours';
                    break;
                case $status == 3:
                    $statusTwig['class'] = "chip end";
                    $statusTwig['text'] = 'Terminé';
                    break;
            }
            $project->setStatus(['class' => $statusTwig['class'], 'text' => $statusTwig['text']]);

        return $project;
    }

}
<?php

namespace App\Services;

use App\Models\ProjectDate;

class ProjectService
{
    public function createDates(array $dates, int $projectId): void
    {
        foreach ($dates as $date) {
            ProjectDate::create([
                'project_id' => $projectId,
                'type' => $date['type'],
                'start_date' => $date['start_date'],
                'end_date' => $date['end_date'],
            ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Degree;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DegreeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Degree([
            "name" => $row["student_id"],
            "name" => $row["score"],
        ]);
    }
}

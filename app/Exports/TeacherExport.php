<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeacherExport implements FromCollection, WithMapping,WithHeadings,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            "ID","Name","Email","Department"
        ];
    }

    public function columnWidths(): array
    {
        return [
            "A"=>"10",
            "B"=>"60",
            "C"=>"40",
            "B"=>"20",
        ];
    }
    public function map($teacher): array
    {
       return [
        $teacher->id,
        $teacher->name,
        $teacher->email,
        $teacher->department->name
       ] ;
    }
    public function collection()
    {
        return Teacher::all();
    }
}

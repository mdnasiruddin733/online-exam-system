<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentImport implements ToModel, WithHeadingRow,SkipsEmptyRows,SkipsOnError,SkipsOnFailure,WithValidation, WithChunkReading
{
    use Importable,SkipsErrors,SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name'  => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'roll'=>$row['roll'],
            'password'=>bcrypt($row['password']),
            'department_id'=>$row['department_id'],
            "created_at"=>now(),
            "updated_at"=>now()
        ]);
    }

    public function rules(): array
    {
        $department_ids=Department::pluck('id')->toArray();
        return [
           '*.name' => ['required', 'string', 'max:255'],
            '*.email' => ['required', 'string', 'email', 'max:255', 'unique:teachers'],
            '*.password' => ['required', 'min:6'],
            '*.roll'=>['required'],
            "*.phone"=>["required"],
            "*.department_id"=>["required","integer",Rule::in($department_ids)],
            
        ];
    }

    public function chunkSize(): int
    {
        return 200;
    }
}

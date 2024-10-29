<?php

namespace App\Exports;

use App\Models\Adoption;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdoptedPetsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Adoption::with('pet', 'user')->where('status', 'completed')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Pet Name',
            'Breed',
            'Sex',
            'Date of Birth',
            'Description',
            'Adopter Name',
            'Adopter Email',
        ];
    }

    /**
     * @param mixed $adoption
     * @return array
     */
    public function map($adoption): array
    {
        return [
            $adoption->pet->name,
            $adoption->pet->breed,
            ucfirst($adoption->pet->sex),
            $adoption->pet->dob,
            $adoption->pet->description,
            $adoption->user->name,
            $adoption->user->email,
        ];
    }
}

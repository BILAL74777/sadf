<?php

namespace App\Exports;

use App\Models\Talent;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Illumiate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TalentExport implements FromView,ShouldAutoSize
{
    use Exportable;
    protected $id;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($id)
    { 
        // dd($talent_records);
        $this->id = $id;
        
         
    }

    public function view(): View
    { 
         $Talent = Talent::findOrFail($this->id);
        //  dd($Talent);
        return view('exports.talents',
             compact('Talent'), 
            );
        
    }

    // public function __construct($talent_records)
    // { 
    //     // dd($talent_records);
    //     $this->talent_records = $talent_records;
        
         
    // }

    // public function collection()
    // {
    //     $talentRecord = Talent::where('id',$this->talent_records)->first();
    //     // dd($talentRecord);
    //     return $talentRecord;
         
    // }

    // public function map($talentRecord):array
    // {
    //     return[
    //         $talentRecord->first_name,
    //         $talentRecord->last_name,
    //     ];
    // }
    // public function headings() :array
    // {
    //     return [ 
    //         'First Name',
    //         'Last Name', 
    //     ];
    // }
    
}

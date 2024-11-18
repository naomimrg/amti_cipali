<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $idSensor;
    protected $fromdate;
    protected $todate;

    public function __construct($idSensor, $fromdate, $todate)
    {
        $this->idSensor = $idSensor;
        $this->fromdate = $fromdate;
        $this->todate = $todate;
    }

    public function collection()
    
    {
        $from_date = date('Y-m-d',strtotime($this->fromdate));
        $to_date = date('Y-m-d',strtotime($this->todate));
        $a = DB::select(DB::raw("SELECT date_bin(
                    INTERVAL '5 minutes',
                    time,
                    TIMESTAMP '2000-01-01'
                ),
                avg(value)
        FROM log_data WHERE id_sensor = $this->idSensor and date(time) between date('$from_date') and date('$to_date')
        GROUP BY 1 ORDER BY date_bin ASC"));
        return collect($a);
    }

    public function headings(): array
    {
        return [
            'Time',
            'Value'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

}
?>
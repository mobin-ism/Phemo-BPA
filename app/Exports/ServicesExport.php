<?php

namespace App\Exports;

use App\Service;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ServicesExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;
    protected $account_id;

    public function __construct($account_id)
    {
        $this->account_id = $account_id;
    }

    public function query()
    {
        return Service::query()->where('account_id', $this->account_id);
    }

    public function map($row): array
    {
        return [
            $row->code,
            $row->name,
            $row->rate,
            \App\UnitOfMeasure::find($row->unit_of_measure_id)->first()->name,
            $row->description,
            $row->created_at,
            $row->updated_at
        ];
    }

    public function headings(): array
    {
        return [
            __('web.code'),
            __('web.name'),
            __('web.rate'),
            __('web.uom'),
            __('web.description'),
            __('web.created_at'),
            __('web.updated_at')
        ];
    }
}

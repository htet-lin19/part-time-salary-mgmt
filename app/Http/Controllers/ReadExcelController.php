<?php

namespace App\Http\Controllers;

use App\Models\ReadExcel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class ReadExcelController extends Controller
{
    public function store(Request $request)
    {
        $path = storage_path() . '/app/' . request()->file('file')->store('tmp');
        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();
        
        $worksheetInfo = $reader->listWorksheetInfo($path);

        $totalRows = $worksheetInfo[0]['totalRows'];
    
        for($rate=1;$rate<=1; $rate++)
        {
            $yarn_rate = $sheet->getCell("AE{$rate}")->getValue();
            $mmk_rate = $sheet->getCell("AG{$rate}")->getValue();
        }

        for($row = 4; $row <= $totalRows; $row++)
        {
            if($sheet->getCell("B{$row}")->getValue() != null)
            {
                $employee_id = $sheet->getCell("B{$row}")->getValue();
                $employee_name = $sheet->getCell("C{$row}")->getValue();
                $employee_email = "test@mail.com";
                $employee_nrc_number = "testNumber123";
                $aggregate = $sheet->getCell("AB{$row}")->getCalculatedValue();
                $pre_training_hours = $sheet->getCell("V{$row}")->getValue();
                $meeting_attendance = $sheet->getCell("W{$row}")->getValue();
                $leader_allowance = $sheet->getCell("X{$row}")->getValue();
                $working_hours = $sheet->getCell("Y{$row}")->getValue();
                $cross_check = $sheet->getCell("Z{$row}")->getValue();
                $correction_work_time = $sheet->getCell("AA{$row}")->getValue();
                $basic_hourly_wage = $sheet->getCell("AC{$row}")->getValue();
                $incentives = $sheet->getCell("AD{$row}")->getValue();
                $payment_amount_with_yen = $sheet->getCell("AE{$row}")->getCalculatedValue();
                $usd_rate = $sheet->getCell("AF{$row}")->getCalculatedValue();
                $total_payment = $sheet->getCell("AG{$row}")->getCalculatedValue();

                $data=new ReadExcel([
                    'employee_id' => $employee_id,
                    'employee_name' => $employee_name,
                    'employee_email' => $employee_email,
                    'employee_nrc_number' => $employee_nrc_number,
                    'aggregate' => $aggregate,
                    'pre_training_hours' => $pre_training_hours,
                    'meeting_attendance' => $meeting_attendance,
                    'leader_allowance' => $leader_allowance,
                    'working_hours' => $working_hours,
                    'cross_check' => $cross_check,
                    'correction_work_time' => $correction_work_time,
                    'basic_hourly_wage' => $basic_hourly_wage,
                    'incentives' => $incentives,
                    'payment_amount_with_yen' => $payment_amount_with_yen,
                    'usd_rate' => $usd_rate,
                    'yarn_rate' => $yarn_rate,
                    'mmk_rate' => $mmk_rate,
                    'total_payment' => $total_payment,
                ]);
                $data->save();
            }
        }
        return $data;
    }
}

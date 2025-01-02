<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Product;
use App\Models\Thread;



class ExcelController extends Controller
{
    public function show($id)
    {
        $threads = Thread::with('product')
            ->where('company_id', $id)
            ->get();
        return view('please.dataShow')->with('threads', $threads);
    }
    public function export()
    {

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();





        $sheet->setCellValue('B1', 'いいねしたユーザー');
        $sheet->setCellValue('C1', '性別');
        $sheet->setCellValue('D1', '年齢');
        $sheet->setCellValue('E1', '都道府県');



        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save(public_path('market.xlsx'));
    }
}

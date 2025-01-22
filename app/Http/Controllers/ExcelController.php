<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Thread;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExcelController extends Controller
{
    public function show($id)
    {
        try {
            // 一意の企業のスレッドデータを取得（いいね数、製品名、会社名）
            $threads = Thread::with('thread_likes.user', 'product', 'company', 'user')
                ->where('company_id', $id)
                ->get();

            // スプレッドシートの作成
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // ヘッダー項目をセット
            $headers = ['製品名', 'いいね', '性別', '年齢'];
            $sheet->fromArray($headers, null, 'A1');

            // データをセット
            $row = 2;
            foreach ($threads as $thread) {
                foreach ($thread->thread_likes as $like) {
                    $sheet->setCellValue('A' . $row, $thread->product->name);
                    $sheet->setCellValue('B' . $row, $like->user->name);
                    $sheet->setCellValue('C' . $row, $like->user->gender);
                    $sheet->setCellValue('D' . $row, $like->user->age);
                    $row++;
                }
            }

            // Excelファイルを保存
            $writer = new Xlsx($spreadsheet);
            $fileName = 'company_' . $id . '_data.xlsx';

            return new StreamedResponse(function () use ($writer) {
                $writer->save('php://output');
            }, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'ファイルの読み込みに失敗しました。',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

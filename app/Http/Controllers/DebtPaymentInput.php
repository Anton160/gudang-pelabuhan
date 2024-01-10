<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Debt_payment;
use App\Models\Document;
use App\Models\Expense;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DebtPaymentInput extends Controller
{
    public function debtView(){
        return view('input.pay', [
            'taxs' => Debt_payment::all()

        ]);
    }
    public function debtInput(Request $request){
        $tax=$request->validate([
            'creditor' => 'required',
            'expenses'=>'required',
            'comments'=>'required',
            'documents'=>'required|file'
        ]);
        
        $nomor=time();
        $no='21'.$nomor;
        if ($request->file('documents')) {
            $tax['documents'] = $request->file('documents')->storeAs('documents',$no);
        }
        
        
        
        $tax['money_id']=$no;
        $tax['id']=$no;
        $tax['person']="Valen";
        $tax['tax_id']=$no;
        
        Debt_payment::create($tax);
        Expense::create($tax);
        Comment::create($tax);
        Document::create($tax);
        
        return redirect('/DebtPay/input')->with('tax', 'data added successfully');
        
    }
    public function download(){
        
        $taxs=Debt_payment::all();
        
        $expenses= Expense::all();

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Officer');
        $sheet->setCellValue('D1', 'Creditor');
        $sheet->setCellValue('H1', 'Tax Id');
        $sheet->setCellValue('J1', 'Money');
        $sheet->setCellValue('L1', 'Comment');
        $sheet->setCellValue('Q1', 'Input Date');
        $sheet->setCellValue('S1', 'No Dokumen');
        $sheet->mergeCells('A1:C1');
        $sheet->mergeCells('D1:G1');
        $sheet->mergeCells('H1:I1');
        $sheet->mergeCells('J1:K1');
        $sheet->mergeCells('L1:P1');
        $sheet->mergeCells('Q1:R1');



        // Set nilai data
        $row = 2;
        foreach ($taxs as $tax) {
            foreach($tax->expense as $expense){
                foreach($tax->comment as $comment){
                    foreach($tax->document as $doc){

            $sheet->setCellValue('A' . $row, $tax['person']);
            $sheet->setCellValue('D' . $row, $tax['creditor']);
            $sheet->setCellValue('H' . $row, $expense['money_id']);
            $sheet->setCellValue('J' . $row, $expense['expenses']);
            $sheet->setCellValue('L' . $row, $comment['comments']);
            $sheet->setCellValue('Q' . $row, $tax['created_at']);
            $sheet->setCellValue('S' . $row, $doc['documents']);
            $sheet->mergeCells('A' . $row . ':C' . $row);
            $sheet->mergeCells('D' . $row . ':G' . $row);
            $sheet->mergeCells('H' . $row . ':I' . $row);
            $sheet->mergeCells('J' . $row . ':K' . $row);
            $sheet->mergeCells('L' . $row . ':P' . $row);
            $sheet->mergeCells('Q' . $row . ':R' . $row);
            $row++;
                    }
                }
            }
        }

        
        
        

        // Buat objek Writer untuk menulis ke file XLSX


        // Generate nama file yang unik
        $filename = 'export_' . time() . '.xlsx';
        $path = storage_path('app/public/exports/' . $filename);

        // Simpan file XLSX
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        // Mengembalikan file XLSX sebagai respons download
        return response()->download($path)->deleteFileAfterSend(true);
        return redirect('/DebtPay/input')->with('tax', 'data added successfully');
    }
}

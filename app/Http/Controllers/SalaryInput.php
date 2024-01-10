<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Document;
use App\Models\Expense;
use App\Models\Salary;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SalaryInput extends Controller
{
    public function salaryView(){
        return view('input.Salary', [
            'taxs' => Salary::all()

        ]);
    }
    public function salaryInput(Request $request){
        $tax=$request->validate([
            'employee_name' => 'required',
            'expenses'=>'required',
            'employee_id'=>'required',
            'documents'=>'required|file'
        ]);
        $nomor=time();
        $no='31'.$nomor;
        if ($request->file('documents')) {
            $tax['documents'] = $request->file('documents')->storeAs('documents',$no);
        }
        
        
        
        $tax['money_id']=$no;
        $tax['id']=$no;
        $tax['person']="Valen";
        $tax['tax_id']=$no;
        
        Salary::create($tax);
        Expense::create($tax);

        Document::create($tax);
        
        return redirect('/Salary/input')->with('tax', 'data added successfully');
        
    }
    public function download(){
        
        $taxs=Salary::all();
        
        $expenses= Expense::all();

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Officer');
        $sheet->setCellValue('D1', 'Employee_name');
        $sheet->setCellValue('H1', 'Salary Id');
        $sheet->setCellValue('J1', 'Money');
        $sheet->setCellValue('L1', 'Employee_id');
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
                
                    foreach($tax->document as $doc){

            $sheet->setCellValue('A' . $row, $tax['person']);
            $sheet->setCellValue('D' . $row, $tax['employee_name']);
            $sheet->setCellValue('H' . $row, $expense['money_id']);
            $sheet->setCellValue('J' . $row, $expense['expenses']);
            $sheet->setCellValue('L' . $row, $tax['employee_id']);
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

        
        
        

        // Buat objek Writer untuk menulis ke file XLSX


        // Generate nama file yang unik
        $filename = 'export_' . time() . '.xlsx';
        $path = storage_path('app/public/exports/' . $filename);

        // Simpan file XLSX
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        // Mengembalikan file XLSX sebagai respons download
        return response()->download($path)->deleteFileAfterSend(true);
        return redirect('/Salay/input')->with('tax', 'data added successfully');
    }
}

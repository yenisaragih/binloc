<?php

namespace App\Http\Controllers;

use Illuminate\Bus\Batchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Yajra\DataTables\DataTables;
use \Carbon\Carbon;
use App\Models\Binloc;
use App\Jobs\BinlocCsvProcess;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get all binloc data 
    public function getBinloc(Request $request)
    {
        if($request->ajax()) {
            $data = Binloc::select('*');
            
            return DataTables::of($data)->make(true);
        }
        return view('/theme/admin');
    }

    // Fetch data binloc
    public function fetchData(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('binlocs')->get();

            return view('binloc-table', compact('data'))->render();
        }
    }

    // Upload binloc csv
    public function uploadCsv(Request $request){

        if ($request->input('submit') != null ){

            $file = $request->file('file');
      
            // Get File Name 
            $filename = Carbon::now() . '.' . $file->getClientOriginalExtension();

            // Get Fili Extention
            $extension = $file->getClientOriginalExtension();

            // Get Fise Size
            $fileSize = $file->getSize();

            // Valid File Extensions
            $valid_extension = array("csv");

            // Max Size 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location (public/uploads)
                    $location = 'uploads';

                    // Upload file
                    $file->move($location, $filename);

                    // Now, Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $data = 0;

                    // Load Import Data per Row 
                    // fgetcsv($file, 1000) - > total character per row must be under 1000
                    while (($dataInFile = fgetcsv($file, 1000)) !== FALSE) {
                        $total = count($dataInFile);

                        for ($dataBinLoc = 0; $dataBinLoc < $total; $dataBinLoc++) {
                            $importData_arr[$data][] = $dataInFile[$dataBinLoc];
                        }

                        $data++;
                    }

                    fclose($file);

                    // Insert to MySQL database (Model BinLoc)
                    foreach ($importData_arr as $importData) {

                        $insertData = array(
                            "part_number" => $importData[0],
                            "description" => $importData[1],
                            "stock_oh_s79" => $importData[2],
                            "stock_code_s79" => $importData[3],
                            "ip_prestocking" => $importData[4],
                            "stock_oh_s38" => $importData[5],
                            "stock_code_s38" => $importData[6]
                        );
                        Binloc::create($insertData);
                    }

                    session()->flash('success', 'Gateway baru berhasil ditambahkan.');
                } else {
                    session()->flash('error', 'File too large. File must be less than 2MB.');
                }
            } else {
                session()->flash('error', 'Invalid File Extension.');
            }
        } else {
            session()->flash('error', 'Gagal');
        }

        return redirect ('/admin');
    }

    
    public function upload()
    {

        if(request()->has('file')){
            $data = file(request()->file);
            
            // Chunking file
            $chunks = array_chunk($data,1000);
           
            $batch = Bus::batch([])->dispatch();

            $header = ['part_number', 
                    'description', 
                    'stock_oh_s79', 
                    'stock_code_s79', 
                    'ip_prestocking', 
                    'stock_oh_s38', 
                    'stock_code_s38'];

            foreach($chunks as $chunk){
                
                $data = array_map('str_getcsv',$chunk);

                $batch->add(new BinlocCsvProcess($data, $header));
            } 
            
            return $batch;
        }
        return 'please upload file';
    }

    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }
}

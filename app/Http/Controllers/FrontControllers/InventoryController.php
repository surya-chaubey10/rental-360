<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class InventoryController extends Controller
{
    public function index()
    {
        return view('contact.inventory.list');
    }

    public function json_list()
    {
        $inventory = Inventory::select('id', 'uuid', 'img', 'brand_id', 'model_id', 'inventory_type', 'status') ->get();
        $details = new Collection();

        foreach ($inventory as $key => $date) {
            if ($date->status == 1) {
                $status = 'Enable';
            } else {
                $status = 'Disable';
            }
            $details->push([
                "id"             => $date->id,
                "uuid"           => $date->uuid,
                "image"          => $date->img,
                "brandname"      => $date->brand_id,
                "modelname"      => $date->model_id,
                "inventory_type" => $date->inventory_type,
                "status"         => ucfirst($status),
            ]);
        }

        return array('data' => $details);
    }
    public function store(Request $request)
    {

        $file = $_FILES['inventory_details']['name'];
        $chk_ext = explode(".", $file);
        if ($chk_ext[1] != 'csv' && $chk_ext[1] != 'xlsx') {
            $_SESSION['message'] = ' <div class="alert alert-danger">
            Only csv && xlsx file allowed!!!
            </div>';
            header("Refresh:0");
            exit;
        }
        $target_path = "../public/images/inventory_import_file/" . $_FILES["inventory_details"]["name"];
        move_uploaded_file($_FILES["inventory_details"]["tmp_name"], $target_path);

        if (strtolower($chk_ext[1]) == "csv") {

            $handle = fopen($target_path, "r");
            $i = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if ($i > 0 && $data[3] != '') {
                    $url = "$data[3]";
                    $info = pathinfo($url);
                    $contents = file_get_contents($url);
                    $file = "../public/images/inventory_images/" . $info['basename'];
                    file_put_contents($file, $contents);

                    $inventory = new Inventory;
                    $inventory->brand_id      = "$data[0]";
                    $inventory->model_id      = "$data[1]";
                    $inventory->inventory_type  = "$data[2]";
                    $inventory->img             = $info['basename'];
                    $inventory->status          = "$data[4]";
                    $inventory->save();
                }
                $i++;
            }
            return redirect()->route('inventory-list');
        } else if (strtolower($chk_ext[1]) == "xlsx") {

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($target_path);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $i = 0;
            foreach ($sheetData as $sheetData) {

                if ($i > 0) {
                    $url = "$sheetData[3]";
                    $info = pathinfo($url);
                    $contents = file_get_contents($url);
                    $file = "../public/images/inventory_images/" . $info['basename'];
                    file_put_contents($file, $contents);

                    $inventory = new Inventory;
                    $inventory->brand_id      = "$sheetData[0]";
                    $inventory->model_id      = "$sheetData[1]";
                    $inventory->inventory_type  = "$sheetData[2]";
                    $inventory->img             =  $info['basename'];
                    $inventory->status          = "$sheetData[4]";

                    $inventory->save();
                }
                $i++;
            }
            return redirect()->route('inventory-list');
        }
    }
    public function delete($uuid)
    {

        $inventory_data = Inventory::where('uuid', $uuid)->first();

        if (is_object($inventory_data)) {
            $inventory_data->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
    public function edit($uuid)
    {
        $inventory = Inventory::where('uuid', $uuid)->get();

        return view('contact.inventory.edit', compact('inventory'));
    }

    public function update(Request $request)
    {
        $path = public_path('../public/images/inventory_images/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('img_path');
        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $fileName);

        \DB::beginTransaction();
        try {
            $Inventory_updated = Inventory::find($request->inventory_updated_id);
            $Inventory_updated->brand_id      = $request->brand_id;
            $Inventory_updated->model_id      = $request->model_id;
            $Inventory_updated->inventory_type  = $request->inventory_type;
            $Inventory_updated->img             = $fileName;
            $Inventory_updated->status          = $request->status;
            $Inventory_updated->save();

            \DB::commit();
            return ajax_response(true, $Inventory_updated, [], "Inventory Update Successfully", $this->success);
        } catch (\Exception $exception) {
            \DB::rollback();
            $message = $exception->getMessage();

            return ajax_response(false, $message, [],  "Inventory Update Unsuccessfully", $this->internal_server_error);
        } catch (\Throwable $exception) {
            \DB::rollback();
            $message = $exception->getMessage();

            return ajax_response(false, $message, [],  "Inventory Update Unsuccessfully", $this->internal_server_error);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'catagory_id'       =>$row['catagory_id'], 
            'image'             =>$row['image'],
            'name'              =>$row['name'],
            'status'            =>$row['status'],
            'description'       =>$row['description'],
            'price'             =>$row['price'],
            'unit'              =>$row['unit'],
            'old_price'         =>$row['old_price'],
            'barcode'           =>$row['barcode'],
            'link'              =>$row['link'],
            'button'            =>$row['button'],
            'coast'             =>$row['coast'],
            'note'              =>$row['note'],
            'store_place'       =>$row['store_place'],
            'weight'            =>$row['weight'],


        ]);
    }
}

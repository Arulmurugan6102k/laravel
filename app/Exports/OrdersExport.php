<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $orderIds;

    public function __construct(array $orderIds)
    {
        $this->orderIds = $orderIds;
    }

    public function collection()
    {
        $data = [];

        // Fetch orders with left joins on product_types and countries
        $orders = Order::whereIn('orders.id', $this->orderIds)
            ->leftJoin('product_types', 'orders.product_type_id', '=', 'product_types.main_id')
            ->leftJoin('countries', 'orders.customer_country_id', '=', 'countries.id')
            ->select(
                'orders.id',
                'orders.order_no',
                'orders.customer_name',
                'orders.customer_email',
                'orders.customer_mob_no',
                'orders.order_amount',
                'countries.name as country_name',
                'product_types.product_type_name as product_type_name',
                'orders.products_id' 
            )
            ->where('orders.is_deleted', 0)
            ->get();

        foreach ($orders as $order) {
            // Explode the product_ids string into an array
   

            // Fetch product data associated with the order
            $products = Product::whereIn('id', $order->products_id)->get();

            
            $data[] = [
                'ID' => $order->id,
                'Order Number' => $order->order_no,
                'Customer Name' => $order->customer_name,
                'Customer Email' => $order->customer_email,
                'Customer Mobile Number' => $order->customer_mob_no,
                'Order Amount' => $order->order_amount,
                'Country' => $order->country_name,
                'Product Type' => $order->product_type_name,
                'Product Name' => '',
                'Product Price' => '',
                
            ];

            
            foreach ($products as $product) {
                $data[] = [
                    'ID' => '',
                    'Order Number' => '',
                    'Customer Name' => '',
                    'Customer Email' => '',
                    'Customer Mobile Number' => '',
                    'Order Amount' => '',
                    'Country' => '',
                    'Product Type' => '',
                    'Product Name' => $product->product_name,
                    'Product Price' => $product->product_cost,
                    'Product Image' => $product->product_name,
                    
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order Number',
            'Customer Name',
            'Customer Email',
            'Customer Mobile Number',
            'Order Amount',
            'Country',
            'Product Type',
            'Product Name',
            'Product Price',
            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold font style to the first row (headings)
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}

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
            // Handle the case where $order->products_id is already an array
            $productIds = is_array($order->products_id) ? $order->products_id : explode(',', $order->products_id);
    
            // Fetch product data associated with the order
            $products = Product::whereIn('id', $productIds)->get();
    
            // Initialize arrays to store product names and prices
            $productNames = [];
            $productPrices = [];
    
            foreach ($products as $product) {
                $productNames[] = $product->product_name;
                $productPrices[] = $product->product_cost;
            }
    
            // Join product names and prices with comma and space
            $productNameStr = implode(', ', $productNames);
            $productPriceStr = implode(', ', $productPrices);
    
            $data[] = [
                'ID' => $order->id,
                'Order Number' => $order->order_no,
                'Customer Name' => $order->customer_name,
                'Customer Email' => $order->customer_email,
                'Customer Mobile Number' => $order->customer_mob_no,
                'Order Amount' => $order->order_amount,
                'Country' => $order->country_name,
                'Product Type' => $order->product_type_name,
                'Product Name' => $productNameStr,
                'Product Price' => $productPriceStr,
            ];
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

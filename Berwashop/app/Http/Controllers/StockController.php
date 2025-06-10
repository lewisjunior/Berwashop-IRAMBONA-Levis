<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use App\Models\ProductOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stockIn()
    {
        $products = Product::all();
        $stockIns = ProductIn::with('product')->latest()->get();
        return view('stock.in', compact('products', 'stockIns'));
    }

    public function stockOut()
    {
        $products = Product::all();
        $stockOuts = ProductOut::with('product')->latest()->get();
        return view('stock.out', compact('products', 'stockOuts'));
    }

    public function storeStockIn(Request $request)
    {
        $request->validate([
            'ProductCode' => 'required|exists:products,ProductCode',
            'Quantity' => 'required|numeric|min:1',
            'UniquePrice' => 'required|numeric|min:0',
        ]);

        $totalPrice = $request->Quantity * $request->UniquePrice;

        ProductIn::create([
            'ProductCode' => $request->ProductCode,
            'Date' => now(),
            'Quantity' => $request->Quantity,
            'UniquePrice' => $request->UniquePrice,
            'TotalPrice' => $totalPrice,
        ]);

        return redirect()->route('stock.in')->with('success', 'Stock added successfully');
    }

    public function storeStockOut(Request $request)
    {
        $request->validate([
            'ProductCode' => 'required|exists:products,ProductCode',
            'Quantity' => 'required|numeric|min:1',
            'UniquePrice' => 'required|numeric|min:0',
        ]);

        // Check if enough stock is available
        $totalStockIn = ProductIn::where('ProductCode', $request->ProductCode)->sum('Quantity');
        $totalStockOut = ProductOut::where('ProductCode', $request->ProductCode)->sum('Quantity');
        $availableStock = $totalStockIn - $totalStockOut;

        if ($availableStock < $request->Quantity) {
            return back()->withErrors(['Quantity' => 'Not enough stock available. Current stock: ' . $availableStock]);
        }

        $totalPrice = $request->Quantity * $request->UniquePrice;

        ProductOut::create([
            'ProductCode' => $request->ProductCode,
            'Date' => now(),
            'Quantity' => $request->Quantity,
            'UniquePrice' => $request->UniquePrice,
            'TotalPrice' => $totalPrice,
        ]);

        return redirect()->route('stock.out')->with('success', 'Stock out recorded successfully');
    }

    public function report(Request $request)
    {
        $startDate = $request->input('start_date') ? date('Y-m-d', strtotime($request->input('start_date'))) : null;
        $endDate = $request->input('end_date') ? date('Y-m-d 23:59:59', strtotime($request->input('end_date'))) : null;

        $products = Product::all();
        $stockReport = [];

        foreach ($products as $product) {
            $stockInsQuery = ProductIn::where('ProductCode', $product->ProductCode);
            $stockOutsQuery = ProductOut::where('ProductCode', $product->ProductCode);

            // Apply date filters if provided
            if ($startDate && $endDate) {
                $stockInsQuery->whereBetween('Date', [$startDate, $endDate]);
                $stockOutsQuery->whereBetween('Date', [$startDate, $endDate]);
            }

            $stockIns = $stockInsQuery->get();
            $stockOuts = $stockOutsQuery->get();
            
            $totalStockIn = $stockIns->sum('Quantity');
            $totalStockOut = $stockOuts->sum('Quantity');

            // Get total stock before start date if date range is selected
            $previousStockIn = 0;
            $previousStockOut = 0;
            if ($startDate) {
                $previousStockIn = ProductIn::where('ProductCode', $product->ProductCode)
                    ->where('Date', '<', $startDate)
                    ->sum('Quantity');
                $previousStockOut = ProductOut::where('ProductCode', $product->ProductCode)
                    ->where('Date', '<', $startDate)
                    ->sum('Quantity');
            }

            $openingStock = $previousStockIn - $previousStockOut;
            $currentStock = $openingStock + $totalStockIn - $totalStockOut;
            
            $totalInValue = $stockIns->sum('TotalPrice');
            $totalOutValue = $stockOuts->sum('TotalPrice');

            // Calculate average cost per unit (if there are stock ins)
            $avgCostPerUnit = $totalStockIn > 0 ? $totalInValue / $totalStockIn : 0;

            // Calculate profit
            $costOfSoldItems = $totalStockOut * $avgCostPerUnit;
            $profit = $totalOutValue - $costOfSoldItems;

            $stockReport[] = [
                'product' => $product,
                'opening_stock' => $openingStock,
                'total_in' => $totalStockIn,
                'total_out' => $totalStockOut,
                'current_stock' => $currentStock,
                'total_in_value' => $totalInValue,
                'total_out_value' => $totalOutValue,
                'avg_cost_per_unit' => $avgCostPerUnit,
                'profit' => $profit
            ];
        }

        return view('stock.report', compact('stockReport', 'startDate', 'endDate'));
    }
} 
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleMaster;
use App\Models\Purchasemaster;
use App\Models\SaleItem;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function stats(Request $request)
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Sales (from saleitems)
        $salesToday = SaleItem::whereHas('sale', function($q) use ($today) {
            $q->whereDate('saledate', $today);
        })->sum('totalsale');
        $salesYesterday = SaleItem::whereHas('sale', function($q) use ($yesterday) {
            $q->whereDate('saledate', $yesterday);
        })->sum('totalsale');
        $salesLastWeek = SaleItem::whereHas('sale', function($q) use ($startOfLastWeek, $endOfLastWeek) {
            $q->whereBetween('saledate', [$startOfLastWeek, $endOfLastWeek]);
        })->sum('totalsale');
        $salesLastMonth = SaleItem::whereHas('sale', function($q) use ($startOfLastMonth, $endOfLastMonth) {
            $q->whereBetween('saledate', [$startOfLastMonth, $endOfLastMonth]);
        })->sum('totalsale');

        // Purchases (calculated)
        $purchaseToday = Purchasemaster::whereDate('purchasedate', $today)
            ->get()
            ->sum(function($p) { return $p->purchaseqty * $p->rateofpurchase; });
        $purchaseYesterday = Purchasemaster::whereDate('purchasedate', $yesterday)
            ->get()
            ->sum(function($p) { return $p->purchaseqty * $p->rateofpurchase; });
        $purchaseLastWeek = Purchasemaster::whereBetween('purchasedate', [$startOfLastWeek, $endOfLastWeek])
            ->get()
            ->sum(function($p) { return $p->purchaseqty * $p->rateofpurchase; });
        $purchaseLastMonth = Purchasemaster::whereBetween('purchasedate', [$startOfLastMonth, $endOfLastMonth])
            ->get()
            ->sum(function($p) { return $p->purchaseqty * $p->rateofpurchase; });

        return response()->json([
            'sales' => [
                'today' => $salesToday,
                'yesterday' => $salesYesterday,
                'last_week' => $salesLastWeek,
                'last_month' => $salesLastMonth,
            ],
            'purchases' => [
                'today' => $purchaseToday,
                'yesterday' => $purchaseYesterday,
                'last_week' => $purchaseLastWeek,
                'last_month' => $purchaseLastMonth,
            ]
        ]);
    }
}

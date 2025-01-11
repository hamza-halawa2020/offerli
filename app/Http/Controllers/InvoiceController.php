<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\MetaData;
use Illuminate\Http\Request;
use Salla\ZATCA\Tags\Seller;

use App\Mail\InvoiceGenerated;
use Illuminate\Support\Carbon;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\TaxNumber;
use Salla\ZATCA\Tags\InvoiceDate;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('dashboard.invoices', ['invoices' => $invoices]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function invoice(Branch $branch)
    {
        $latest = Invoice::where('branch_id', $branch->id)->latest()->first();
        $latestCount = Invoice::where('branch_id', $branch->id)->count();

        if ($latestCount == 0 || $latest->created_at->addDays(28) < now()) {

            $branchvouchers =  $branch->customervoucher->whereNull('invoice_id');

            $price =  $branchvouchers->pluck('paid_price')->sum();
            $tax = ($price * 15) / 100;

            $Visa = Payment::where('name', 'Visa')->first()->id;
            $branchvouchersVisa =  $branchvouchers->where('payment_id', $Visa);
            $totalVisaPrice = $branchvouchersVisa->pluck('paid_price')->sum();
            $totalVisaCount = $branchvouchersVisa->pluck('paid_price')->count();


            $Cash = Payment::where('name', 'Cash')->first()->id;
            $branchvouchersCash =  $branchvouchers->where('payment_id', $Cash);
            $totalCashPrice = $branchvouchersCash->pluck('paid_price')->sum();
            $totalCashCount = $branchvouchersCash->pluck('paid_price')->count();

            $bankCommission = MetaData::first()->bank_commission;
            $offerli_commission = ($branch->brand->percentage);

            $invoice = new Invoice();
            $invoice->user_id = auth()->user()->id;
            $invoice->total_vouchers = $price;
            $invoice->branch_id =  $branch->id;
            // $invoice->visa_price =  $totalVisaPrice;
            $invoice->credit_orders =  $totalVisaCount;
            $invoice->credit_total =  $totalVisaPrice;
            $invoice->cash_orders =  $totalCashCount;
            $invoice->cash_total =  $totalCashPrice;

            $invoice->bank_commission =  $bankCommission;
            $invoice->offerli_commission =  $offerli_commission;
            $invoice->other_fees = $branch->brand->other_fee;
            $invoice->total_invoice =  round(((($invoice->total_vouchers * $invoice->offerli_commission) / 100) + ((($invoice->credit_total + ($invoice->credit_total * 15) / 100) * $invoice->bank_commission) / 100) + $invoice->other_fees) + ((((($invoice->total_vouchers * $invoice->offerli_commission) / 100) + ((($invoice->credit_total + ($invoice->credit_total * 15) / 100) * $invoice->bank_commission) / 100) + $invoice->other_fees) * 15) / 100), 2);
            $invoice->invoice_number = 'INV-' . date('Ymd') . date('His'). '-' . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT);
            // dd($invoice);
            $invoice->save();
            $branch->brand->update(['other_fee' => 0]);
            $metaData = MetaData::first();
            foreach ($branch->customervoucher as $voucher) {
                $voucher->update(['invoice_id' => $invoice->id]);
            }

            $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
                new Seller($invoice->branch->brand->name),
                new TaxNumber($invoice->branch->brand->vat_no),
                new InvoiceDate($invoice->created_at->toIso8601ZuluString()),
                new InvoiceTotalAmount($price),
                new InvoiceTaxAmount($tax)
            ])->render();


            Mail::to($branch->brand->email)->send(new InvoiceGenerated($invoice));
            return view('dashboard.invoice', [
                'qrcode' => $displayQRCodeAsBase64,
                'branch' => $branch, 'invoice' => $invoice, 'metaData' => $metaData
            ]);
        } else {
            return redirect()->back()->with('message', 'Can not make an invoice for This Branch');
        }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $metaData = MetaData::first();
        $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
            new Seller($invoice->branch->brand->name),
            new TaxNumber($invoice->branch->brand->vat_no),
            new InvoiceDate($invoice->created_at->toIso8601ZuluString()),
            new InvoiceTotalAmount($invoice->total_invoice),
            new InvoiceTaxAmount(($invoice->total_invoice * 15 / 100))
        ])->render();
        return view('dashboard.invoice', [
            'qrcode' => $displayQRCodeAsBase64,
            'invoice' => $invoice, 'metaData' => $metaData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }
    public function paid(Invoice $invoice)
    {
        $invoice->update(['paid' => 1]);
        return redirect()->back();
    }
    public function unPaid(Invoice $invoice)
    {
        $invoice->update(['paid' => 0]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}

@include('dashboard.layout.header')
<title> Invoice</title>
<div class=" a4-container invoice-print p-5" style="color: black;">
    <div class="d-flex justify-content-between flex-row" style=" direction: rtl;">
        <div class="mb-4">
            <h3 style="color: black;">فاتورة ضريبية - Tax invoice</h3>
            <table>

                <head>
                    <tr>
                        <th style="text-align: center ">الرقم التسلسلي - Serial No</th>
                        <th style="text-align: center; padding-left: 20px;">التاريخ - Date</th>
                    </tr>
                </head>

                <body>
                    <tr>
                        <td style="text-align: center">{{ $invoice->invoice_number }}</td>
                        <td style="text-align: center; padding-right: 20px;">{{ $invoice->created_at }}</td>
                    </tr>
                </body>
            </table>
        </div>
        <div class="mb-2">
            <img height="100" width="100" src="{{ $qrcode }}" alt="">
        </div>
        <div>
            <div class="mb-2">
                <img height="100" width="100" src="{{ asset('assets/img/logo.png') }}" alt="logo">
            </div>


        </div>
    </div>

    <hr />

    <div class="row d-flex  mb-4">
        <div class=" w-100">
            <table>

                <head>
                    <tr>
                        <th colspan="2" style="text-align: right ">معلومات البائع</th>
                        <th colspan="2" style="text-align: left "> Seller Info</th>

                    </tr>
                </head>

                <body>
                    <tr>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px; ">
                            اسم البائع </td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            عنوان البائع </td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            رقم تسجيل ضريبة القيمة المضافة للبائع </td>
                        <td
                            style="text-align: right; padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            رقم السجل التجاري </td>
                    </tr>
                    <tr>
                        <td
                            style="text-align: left;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr; ">
                            Seller Name</td>
                        <td
                            style="text-align: left;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr;width: 22%;">
                            Seller Address</td>
                        <td
                            style="text-align: left;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr;width: 20%;">
                            Tax No.</td>
                        <td
                            style="text-align: left; padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr;width: 22%;">
                            Commercial Registration No.</td>
                    </tr>
                    <tr>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px; ">
                            {{ $invoice->branch->brand->name }} - {{ $invoice->branch->name }}</td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            {{ $invoice->branch->address }}</td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            {{ $invoice->branch->brand->vat_no }}</td>
                        <td
                            style="text-align: right; padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            {{ $invoice->branch->brand->Com_Reg_No }}</td>
                    </tr>
                </body>
            </table>
        </div>

    </div>
    <hr>

    <div class="row d-flex  mb-4">
        <div class=" w-100">
            <table>

                <head>
                    <tr>
                        <th colspan="2" style="text-align: right ">معلومات المشتري</th>
                        <th colspan="2" style="text-align: left "> Buyer Info</th>
                    </tr>
                </head>

                <body>
                    <tr>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px; ">
                            اسم المشتري </td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            عنوان المشتري </td>
                        <td
                            style="text-align: right; padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            رقم السجل التجاري </td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            رقم تسجيل ضريبة القيمة المضافة للمشتري</td>
                    </tr>
                    <tr>
                        <td
                            style="text-align: left;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr; ">
                            Buyer Name</td>
                        <td
                            style="text-align: left;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr;width: 22%;">
                            Buyer Address</td>
                        <td
                            style="text-align: left; padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr;width: 22%;">
                            Commercial Registration No.</td>
                        <td
                            style="text-align: left;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;direction: ltr;width: 28%;">
                            Tax No.</td>
                    </tr>
                    <tr>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px; ">
                            {{ $metaData->name }}</td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            {{ $metaData->address }}</td>
                        <td
                            style="text-align: right;padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            {{ $metaData->Com_Reg_No }}</td>
                        <td
                            style="text-align: right; padding-left:20px;border-right: 1px solid #dddddd;padding-right: 20px;">
                            {{ $metaData->vat_no }}</td>
                    </tr>
                </body>
            </table>
        </div>
        <hr>
        <div class="row d-flex  mb-4" style="padding-top: 10px;">
            <div class=" w-100 " >
                <table class="data" dir="ltr">

                    <head>
                        <tr>
                            <th style="text-align: center ">Description - الوصف</th>
                            <th style="text-align: center ">No. of Orders -عدد الطلبات </th>
                            <th style="text-align: center "> Price - السعر</th>
                            <th style="text-align: center "> Total - الاجمالي </th>
                        </tr>
                    </head>

                    <body>

                        <tr>
                            <td style="text-align: center"> Cash Sales - مبيعات النقديه </td>
                            <td style="text-align: center">{{ $invoice->cash_orders }}</td>
                            <td style="text-align: center">{{ $invoice->cash_total }}</td>
                            <td style="text-align: center">{{ round((($invoice->cash_total * 15) / 100)+$invoice->cash_total, 2)  }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">Credit Sales - مبيعات المدفوعات الالكترونية</td>
                            <td style="text-align: center">{{ $invoice->credit_orders }}</td>
                            <td style="text-align: center">{{ $invoice->credit_total }}</td>
                            <td style="text-align: center">{{  round((($invoice->credit_total * 15) / 100)+$invoice->credit_total , 2)  }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center"> Total - الاجمالي </td>
                            <td style="text-align: center">{{round( $invoice->credit_orders + $invoice->cash_orders , 2) }}</td>
                            <td style="text-align: center">{{ round($invoice->credit_total + $invoice->cash_total , 2) }}</td>
                            <td style="text-align: center">
                                {{round( (($invoice->cash_total * 15) / 100)+$invoice->cash_total+ (($invoice->credit_total * 15) / 100)+$invoice->credit_total, 2)  }}</td>
                        </tr>
                    </body>
                </table>
            </div>

        </div>
        <hr>
        <div class="row d-flex  " style="break-before: page; padding-top: 20px;">
            <div class=" w-100">
                <table class="data" dir="ltr" >

                    <head>
                        <tr>
                            <th style="text-align: center ">Description - الوصف</th>
                            <th style="text-align: center ">Detials - تفاصيل </th>
                            <th style="text-align: center "> Price - السعر</th>
                            <th style="text-align: center ">Rate -النسبة </th>
                            <th style="text-align: center "> Total - الاجمالي </th>
                        </tr>
                    </head>

                    <body>

                        <tr>
                            <td style="text-align: center">Sales Commission - عموله المبيعات</td>
                            <td style="text-align: center">Offerli Commission - عموله اوفرلي</td>
                            <td style="text-align: center">{{ $invoice->total_vouchers }}</td>
                            <td style="text-align: center">{{ $invoice->offerli_commission }} % </td>
                            <td style="text-align: center">
                                {{ round(($invoice->total_vouchers * $invoice->offerli_commission) / 100, 2)  }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">Bank Commission - عموله البنك</td>
                            <td style="text-align: center">Bank Commission - عموله البنك </td>
                            <td style="text-align: center">{{round( (($invoice->credit_total * 15) / 100)+$invoice->credit_total , 2) }}</td>
                            <td style="text-align: center">{{ $invoice->bank_commission }}</td>

                            <td style="text-align: center">{{ round((((($invoice->credit_total * 15) / 100)+$invoice->credit_total)* $invoice->bank_commission) / 100 , 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">Other commission - عمولات اخري</td>
                            <td style="text-align: center">Other Fees - رسوم اخري </td>
                            <td style="text-align: center">{{ $invoice->other_fees }}</td>
                            <td style="text-align: center">-</td>
                            <td style="text-align: center">{{ $invoice->other_fees }}</td>
                        </tr>
                    </body>
                </table>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table m-0">
                <tbody>
                    <tr>
                        {{-- <td colspan="3" class="align-top px-4 py-3">
                        <p class="mb-2">
                            <span class="me-1 fw-medium">Salesperson:</span>
                            <span>Alfie Solomons</span>
                        </p>
                        <span>Thanks for your business</span>
                    </td> --}}
                        <td class="text-end px-4 py-3" style="color: black;">
                            <p class="mb-2">مجموع العمولات Total Commissions</p>
                            <p class="mb-2">ضريبة القيمة المضافة (%15) VAT </p>
                            <p class="mb-0">المجموع مع الضريبة(%15) Total With VAT</p>
                        </td>
                        <td class="px-4 py-3" style="color: black;">
                            <p class="fw-medium mb-2">SAR - ريال سعودي</p>
                            <p class="fw-medium mb-2">SAR - ريال سعودي</p>
                            <p class="fw-medium mb-2">SAR - ريال سعودي</p>
                        </td>
                        <td class="px-4 py-3" style="color: black;">
                            <p class="fw-medium mb-2">
                                {{  round((($invoice->total_vouchers * $invoice->offerli_commission) / 100 ) + ((($invoice->credit_total+($invoice->credit_total * 15) / 100) * $invoice->bank_commission) / 100)+ $invoice->other_fees , 2) }}
                            </p>
                            <p class="fw-medium mb-2">
                                {{  round((( (($invoice->total_vouchers * $invoice->offerli_commission) / 100 ) + ((($invoice->credit_total+($invoice->credit_total * 15) / 100) * $invoice->bank_commission) / 100)+ $invoice->other_fees) * 15) / 100 , 2) }}
                            </p>
                            <p class="fw-medium mb-0">
                                {{ $invoice->total_invoice  }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        {{-- <div class="row d-flex  mb-4" style="padding-top: 40px;">
        <div class=" w-100 "  style="break-before: page;">
            <table class="data" dir="ltr">

                <head>
                    <tr>
                        <th style="text-align: center ">Description - الوصف</th>
                        <th style="text-align: center ">No. of Orders -عدد الطلبات  </th>
                        <th style="text-align: center "> Price - السعر</th>
                        <th style="text-align: center "> Total - الاجمالي </th>
                    </tr>
                </head>

                <body>

                    <tr>
                        <td style="text-align: center">  Cash Sales - مبيعات النقديه  </td>
                        <td style="text-align: center">{{$invoice->cash_orders}}</td>
                        <td style="text-align: center">{{$invoice->cash_total}}</td>
                        <td style="text-align: center">{{$invoice->cash_total *15/100}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Credit Sales  -  مبيعات المدفوعات الالكترونية</td>
                        <td style="text-align: center">{{$invoice->credit_orders}}</td>
                        <td style="text-align: center">{{$invoice->credit_total}}</td>
                        <td style="text-align: center">{{$invoice->credit_total *15/100}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center"> Total  - الاجمالي   </td>
                        <td style="text-align: center">{{$invoice->credit_orders + $invoice->cash_orders}}</td>
                        <td style="text-align: center">{{$invoice->credit_total+$invoice->cash_total}}</td>
                        <td style="text-align: center">{{($invoice->credit_total *15/100)+($invoice->cash_total *15/100) }}</td>
                    </tr>
                </body>
            </table>
        </div>

    </div> --}}


        {{-- <div class="table-responsive">
        <table class="table m-0">
            <tbody>
                <tr>

                    <td class="text-end px-4 py-3" style="color: black;">
                        <p class="mb-2">المجموع Total</p>
                        <p class="mb-2">ضريبة القيمة المضافة (%15) VAT </p>
                        <p class="mb-0">المجموع مع الضريبة(%15) Total With VAT</p>
                    </td>
                    <td class="px-4 py-3" style="color: black;">
                        <p class="fw-medium mb-2">SAR</p>
                        <p class="fw-medium mb-2">SAR</p>
                        <p class="fw-medium mb-0">SAR</p>
                    </td>
                    <td class="px-4 py-3" style="color: black;">
                        <p class="fw-medium mb-2">{{ $price - $tax }} </p>
                        <p class="fw-medium mb-2">{{ $tax }} </p>
                        <p class="fw-medium mb-0">{{ $price }} </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> --}}

        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>

    {{-- @include('dashboard.layout.footer') --}}
    <style>
        html,
        body {
            direction: rtl;
        }

        .a4-container {
            width: 21cm;
            /* A4 width */
            height: 50cm;
            /* A4 height */
            margin: 50px auto;
            /* Adjust margin as needed */
            background-color: #ffffff;
            /* Set the background color of the "paper" */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Add a subtle shadow for depth */
            padding: 20px;
            /* Add padding to simulate margins within the "paper" */
            box-sizing: border-box;
        }

        table.data {
            border-collapse: collapse;
            width: 100%;
        }

        table.data th,
        /* table.data td {
        border: 1px dashed  #dddddd;
        text-align: left;
        padding: 8px;
    } */

        /* Apply borders to the right and bottom sides of each cell, except the last column and last row */
        table.data td:not(:last-child),
        table.data th:not(:last-child) {
            border-left: 1px dashed #dddddd;
        }

        table.data tr:not(:last-child) td,
        table.data tr:not(:last-child) th {
            border-bottom: 1px solid #dddddd;
        }
    </style>

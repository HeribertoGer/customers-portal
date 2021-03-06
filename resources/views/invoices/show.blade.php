@extends('layouts.app')
@section('title')
    Invoice {{ $invoice->subject }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-3"><span class="lstick d-inline-block align-middle"></span> Invoice <b>{{ $invoice->subject }}</b></h4>
            <a href="{{ route('invoices') }}" class="btn btn-outline-info btn-rounded float-left"><i
                    class=" fas fa-arrow-circle-left">Back to invoices</i></a>
        </div>
    </div>

    <div class="card  shadow-lg p-1">
        <ul class="nav nav-tabs nav-bordered mb-3 customtab">
            <li class="nav-item">
                <a href="#invoice-details" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-file-document d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Invoice details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#invoice-payments" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    <i class="mdi mdi-cash-multiple d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Payments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#invoice-paymentplan" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-square-inc-cash d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Payment plan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#invoice-receipts" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdimdi-receipt d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Receipts and account statement</span>
                </a>
            </li>
        </ul>
    
        <div class="tab-content">
            <div class="tab-pane" id="invoice-details">
                <div class="card ">
                    <div class="card-body">
                        {{-- Invoice info read only fields --}}
                        <table class="table v-middle fs-3 mb-0 mt-4">
                            <tbody>
                                <tr>
                                    <td>Invoice Number</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->invoice_no }}</td>
                                </tr>
                                <tr>
                                    <td>Invoice Date</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->invoicedate }}</td>
                                </tr>
                                <tr>
                                    <td>Number of Payments</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_2121 }}</td>
                                </tr>
                                <tr>
                                    <td>Professional Services</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_1574 }}</td>
                                </tr>
    
                                <tr>
                                    <td>Government Fee Subtotal</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_1572 }}</td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_2123 }}</td>
                                </tr>
                                <tr>
                                    <td>Invoice Balance</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_905 }}</td>
                                </tr>
                                <tr>
                                    <td>Payments Received</td>
                                    <td class="text-end font-weight-medium">{{ $invoice->cf_901 }}</td>
                                </tr>    
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
    
                <div class="card">
                    <div class="btn-list float-rigth">
                        <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm "><i
                                class="feather feather-edit-3 feather-icon">Report
                                a payment</i></a>
                        <a type="button" class="btn btn-secondary btn-sm waves-effect waves-light btn-sm"><i
                                class="feather feather-edit-3 feather-icon">Make
                                a payment</i></a>
                    </div>
                </div>
                </br>
                <div class="card ">
                    <div class="card-body">
                        Quote product details
                    </div>
                </div>
            </div>
            <div class="tab-pane show active" id="invoice-payments">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Payment date</th>
                                <th scope="col">Payment method</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Currency</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $invoice_payment)
                                <tr>
                                    <td>{{ $invoice_payment->cf_1146 }}</td>
                                    <td>{{ $invoice_payment->cf_1148 }}</td>
                                    <td>{{ $invoice_payment->cf_1144 }}</td>
                                    <td>{{ $invoice_payment->cf_1150 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="invoice-paymentplan">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Schedule</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($iTrackers as $itracker)
                            <tr>
                                <td>{{ $itracker->cf_1165 }}</td>
                                <td>{{ number_format($itracker->cf_1163, 2) }}</td>
                                <td>{{ $itracker->description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="invoice-receipts">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type of file</th>
                                <th scope="col">File</th>
                                <th scope="col">Date</th>
                                <th scope="col">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->filetype }}</td>
                                    <td>{{ $document->filename }}</td>
                                    <td>{{ $document->cf_2134 }}</td>
                                    <td><a class="btn btn-outline-success btn-rounded"><i class="fas fa-download"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

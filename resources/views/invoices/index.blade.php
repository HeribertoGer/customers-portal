@extends('layouts.app')
@include('features.datatable')
@section('title')
    Invoices
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">My checklists</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> My open
                        invpices</h4>
                    <div class="table-responsive">
                        <table class="table dt_alt_pagination table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Invoice Titlee</th>
                                    <th scope="col">Grand Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Make or Report A Payment</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($open_invoices as $openInvoice)
                                    <tr>
                                        <td>{{ $openInvoice->subject }}</td>
                                        <td>{{ $openInvoice->subtotal }}</td>
                                        <td>{{ $openInvoice->paid }}</td>
                                        <td></td>
                                        <td>
                                            <a href="{{ route('show_invoice', [$openInvoice->id]) }}" type="button"
                                                class="btn btn-outline-success btn-rounded">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Invoices Paid in Full</h4>
                        <div class="table-responsive">
                            <table class="table dt_alt_pagination table-striped table-bordered displa">
                                <thead>
                                    <tr>
                                        <th scope="col">Invoice Title</th>
                                        <th scope="col">Grand Total</th>
                                        <th scope="col">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paid_invoices as $paidInvoice)
                                        <tr>
                                            <td>{{ $openInvoice->subject }}</td>
                                            <td>{{ $openInvoice->subtotal }}</td>
                                            <td>{{ $openInvoice->paid }}</td>
                                            <td>
                                                <a href="{{ route('show_invoice', [$openInvoice->id]) }}" type="button"
                                                    class="btn btn-outline-success btn-rounded">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
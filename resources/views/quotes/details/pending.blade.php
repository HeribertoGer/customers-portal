@extends('layouts.app')
@section('title')
    Pending quotes | Quote {{ $quote->subject }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h4 class="card-title mb-3"><span class="lstick d-inline-block align-middle"></span>Pending Quote
                    <b>{{ $quote->subject }}</b></h4>
            </div>
            <a href="{{ route('quotes') }}" class="btn btn-outline-info btn-rounded float-left"><i
                    class=" fas fa-arrow-circle-left">Back to checklists</i></a>
        </div>
    </div>

    <div class="card  shadow-lg p-1">
        <ul class="nav nav-tabs nav-bordered mb-3 customtab">
            <li class="nav-item">
                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Quote details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Payment plan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                    <span class="d-none d-lg-block">Files</span>
                </a>
            </li>
        </ul>
    
        <div class="tab-content ">
            <div class="tab-pane" id="home-b1">
                <div class="card">
                    <div class="card-body">
                        <table class="table v-middle fs-3 mb-0 mt-4">
                            <tbody>
                                <tr>
                                    <td>Title</td>
                                    <td class="text-end font-weight-medium">{{ $quote->subject }}</td>
                                </tr>
                                <tr>
                                    <td>Quote Number</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->quote_no }}</td>
                                </tr>
                                <tr>
                                    <td>Proposal Date</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_966 }}</td>
                                </tr>
    
                                <tr>
                                    <td>Valid Until</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->validtill }}</td>
                                </tr>
                                <tr>
                                    <td>Number of Payments</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_1877 }}</td>
                                </tr>
                                <tr>
                                    <td>Revision</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_2170 }}</td>
                                </tr>
                                <tr>
                                    <td>Professional Services</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_962 }}</td>
                                </tr>
                                <tr>
                                    <td>Government Fee Subtotal</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_964 }}</td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td class="text-end font-weight-medium">
                                        {{ $quote->cf_1576 }}</td>
                                </tr>
                                <tr>
                                    <td>Client Approval Date</td>
                                    <td class="text-end font-weight-medium"></td>
                                </tr>
                                <tr>
                                    <td>Client Response to Quote</td>
                                    <td class="text-end font-weight-medium"></td>
                                </tr>
                                <tr>
                                    <td>Client Approval Signature</td>
                                    <td class="text-end font-weight-medium"></td>
                                </tr>
    
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <a class="btn btn-secondary"><i class="feather feather-edit-3 feather-icon">Accept and sign quote</i></a>
                </br>
                </br>
                <div class="card">
                    <div class="card-body">
                        Quote product details
                    </div>
                </div>
            </div>
            <div class="tab-pane show active" id="profile-b1">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Schedule</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Description</th>
                                <th></th>
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
            <div class="tab-pane" id="settings-b1">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type of file</th>
                                <th scope="col">File</th>
                                <th scope="col">date</th>
                                <th scope="col">download</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itDocuments as $document)
                                <tr>
                                    {{-- <td>{{ $document->filetype }}</td> --}}
                                    <td>{{ $document->cf_1491 }}</td>
                                    <td>{{ $document->filename }}</td>
                                    <td>{{ $document->cf_2134 }}</td>
                                    {{-- <td>{{ $document->filelocationtype }}}</td> --}}
                                    <td>
                                        <a class="btn btn-outline-success btn-rounded"><i class="fas fa-download"></i></a>
                                    </td>
                                </tr>
    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

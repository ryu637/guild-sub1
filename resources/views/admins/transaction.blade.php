@extends('admins.dashboard')

@section('title', 'Admin: Transaction')

@section('page-content')
<div class="container ms-5">
    
    <!-- Admin Balance カード -->
    <div class="card mb-5 shadow-sm">
        <div class="card-header custom-light-gray">
            <h4 class="m-0">Admin Balance</h4>
        </div>
        <div class="card-body row justify-content-center align-items-center">
            <div class="col-6 text-center">
                <p class="card-text fs-5 m-0">Total Fee Revenue: <strong> ${{ number_format($totalFeeRevenue, 2) }}</strong></p>
                <p class="card-text fs-5 m-0">Escrow Balance: <strong> ${{ number_format($escrowBalance, 2) }}</strong></p>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">  
                <p class="fs-5 m-0 me-2">Total Balance:</p>
                <p class="card-text fs-5 fw-bold m-0">${{ number_format($balance, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Project Transactions カード -->
    <div class="card shadow-sm mb-4">
        <div class="card-header custom-light-gray">
            <h4 class="m-0">Project's Transactions List</h4>
        </div>
        <div class="card-body">
            <!-- 検索フォーム -->
            <div class="mb-2">
                <h5 class="m-0">🔎 Search Projects</h5>
            </div>
            <form method="GET" action="{{ route('admin.transaction') }}" class="row mb-5 g-3">
                <div class="col-md-4">
                    <input type="text" name="company_name" class="form-control border-2" placeholder="Search by Company Name" value="{{ request('company_name') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="freelancer_name" class="form-control border-2" placeholder="Search by Freelancer Name" value="{{ request('freelancer_name') }}">
                </div>
                <div class="col-md-4 d-flex">
                    <button type="submit" class="btn  btn-secondary me-2">Search</button>
                    <a href="{{ route('admin.transaction') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            @if ($projects->count() > 0)
                @foreach ($projects as $project)
                <div class="job-container border rounded p-3 mb-4">
                    <div class="job-header h5"> {{ $project->title }}</div>
                    <div class="info mb-2">
                        <div class="mb-1">
                            <strong>Company Name:</strong> {{ $project->company->user->username }}
                        </div>
                        <div>
                        <strong>Freelancer Name:</strong>  
                            {{ $project->freelancerPayee?->username ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="mt-3 fw-bold fs-6">Transaction History</div>
                    <table class="transaction-table table table-striped">
                        <thead>
                        <tr>
                            <th>DATE</th>
                            <th>TRANSACTION ($)</th>
                            <th>TYPE</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($project->transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                <td>
                                    @if ($transaction->payee_id == $adminId)
                                    {{ $transaction->amount + $transaction->fee }}
                                    @else
                                    {{ -($transaction->amount + $transaction->fee) }}
                                    @endif
                                </td>
                                <td>{{ $transaction->type }}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                @endforeach
            @else
                <p>No projects found.</p>
            @endif

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $projects->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</div>
@endsection
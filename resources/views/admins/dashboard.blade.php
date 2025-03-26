@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('admin.freelancer') }}" 
                               class="btn btn-outline-secondary w-100 {{ request()->is('admin/freelancer') ? 'active' : '' }}">
                                Freelancer
                            </a>
                            <a href="{{ route('admin.company') }}" 
                               class="btn btn-outline-secondary w-100 {{ request()->is('admin/company') ? 'active' : '' }}">
                                Company
                            </a>
                            <a href="{{ route('admin.project') }}" 
                               class="btn btn-outline-secondary w-100 {{ request()->is('admin/project') ? 'active' : '' }}">
                                Project
                            </a>
                            <a href="{{ route('admin.transaction') }}" 
                               class="btn btn-outline-secondary w-100 {{ request()->is('admin/transaction') ? 'active' : '' }}">
                                Transaction
                            </a>
                            <a href="{{ route('admin.statistics') }}" 
                               class="btn btn-outline-secondary w-100 {{ request()->is('admin/statistics') ? 'active' : '' }}">
                                Statistics
                            </a>
                        </div>
                    </div>
                    <div class="col-9">
                        @yield('page-content')
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
        </main>
@endsection

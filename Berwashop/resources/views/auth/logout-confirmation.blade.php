@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Logout Confirmation</div>

                <div class="card-body text-center">
                    <h5 class="mb-4">Are you sure you want to logout?</h5>
                    
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Yes, Logout</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
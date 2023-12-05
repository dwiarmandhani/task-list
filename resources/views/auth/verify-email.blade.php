@extends('layouts.app')
@section('main')    
<div class="mt-5 mx-auto" style="width: 380px">
    <div class="card">
        <div class="card-body">
            @if(session('status'))
            <div class="alert alert-success">
                A Fresh Verify Email Link Has Sent to Your Email
            </div>
            @endif
            Before proceeding, please check your email for verification,
            or click this link for a new email verification!
            <form action="{{ route('verification.send') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click her to request another link') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
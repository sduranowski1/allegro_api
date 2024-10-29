<!-- resources/views/offers/index.blade.php -->
@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Available Offers</h1>

        @if(isset($error))
            <div class="alert alert-danger">{{ $error }}</div>
        @endif

        @if(empty($offers))
            <p>No offers available at the moment.</p>
        @else
            <div class="row">
                @foreach($offers as $offer)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="{{ $offer['primaryImage']['url'] ?? 'default-image.jpg' }}" class="card-img-top"
                                 alt="{{ $offer['name'] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $offer['name'] }}</h5>
                                <p class="card-text">{{ $offer['description'] ?? 'No description available' }}</p>
                                <p class="card-text">
                                    Price:
                                    {{
                                        isset($offer['sellingMode']['price']['amount']) ? $offer['sellingMode']['price']['amount'] : 'N/A'
                                    }}
                                    {{
                                        isset($offer['sellingMode']['price']['currency']) ? $offer['sellingMode']['price']['currency'] : ''
                                    }}
                                </p>
                                <a href="{{ url('/offer', $offer['id']) }}" class="btn btn-primary">View Offer</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

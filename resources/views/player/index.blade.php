@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Player Master') }}
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-sm-12">
            			<a href="{{ route('player.create') }}" class="btn btn-info mb-2 text-white">Create Player</a>
            		</div>
            		<div class="col-sm-12">
            			@include('layouts._flash')
	                    <table id="playerTable" class="table table-striped table-bordered">
					        <thead>
					            <tr>
					                <th>Index</th>
					                <th>Player Name</th>
					                <th>Team Name</th>
					                <th>Club Name</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					             @foreach($allPlayers as $key=>$item) 
					             	<tr>
					             		<td>{{ ($key + 1) }}</td>
					             		<td>{{ $item->name }}</td>
					             		<td>{{ $item->team->name ?? '' }}</td>
					             		<td>{{ $item->team->club->name ?? '' }}</td>
					             		<td>
					             			<a href="{{ route('player.show',encrypt($item->id)) }}"> View</a>
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
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready( function () {
        $('#playerTable').DataTable(); 
    });
</script>
@endpush


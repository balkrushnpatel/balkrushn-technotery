@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Team Master') }}
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-sm-12">
            			<a href="{{ route('team.create') }}" class="btn btn-info mb-2 text-white">Create Team</a>

            		</div>
            		<div class="col-sm-12">
            			@include('layouts._flash')
	                    <table id="teamTable" class="table table-striped table-bordered">
					        <thead>
					            <tr>
					                <th>Index</th>
					                <th>Team Name</th>
					                <th>Club Name</th>
					                <th>Total No Of Player</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					             @foreach($allTeams as $key=>$item) 
					             	<tr>
					             		<td>{{ ($key + 1) }}</td>
					             		<td>{{ $item->name }}</td>
					             		<td>{{ $item->club->name ?? '' }}</td>
					             		<td>{{ $item->players->count() ?? '0' }}</td>
					             		<td>
					             			<a href="{{ route('team.show',encrypt($item->id)) }}"> View</a>
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
        $('#teamTable').DataTable(); 
    });
</script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ (!empty($player))?'View':'Create'}} Player
            </div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-sm-12 text-right">
            			<a href="{{ route('player.index') }}" class="btn btn-info mb-2 text-white"><< Back</a>
            		</div>
            		<div class="col-sm-12">
            			@include('layouts._flash')
	                     <form id="playerForm" action="{{ route('player.index')}}" method="POST">
	                     	@csrf
	                     	<div class="row">
	                     		<div class="col-sm-12 col-md-6">
			                     	<div class="form-group">
			                     		<label for="name">Name <sub class="required">*</sub></label>
			                     		<input type="text"  name="name" class="form-control" value="{{ (!empty($player))?$player->name:old('name') }}"  {{ (!empty($player))?'disabled':''}}/>
			                     	</div>
			                    </div>
	                     		<div class="col-sm-12 col-md-6">
			                     	<div class="form-group">
			                     		<label>Team <sub class="required">*</sub></label>
			                     		<select name="team_id" id="team_id" class="form-control select2"  {{ (!empty($player))?'disabled':''}}>
			                     			<option value="">Select Team</option>
			                     			@foreach($teams as $key=>$name)
			                     				<option value="{{$key}}" {{ ((!empty($player) && ($player->team_id == $key)) || (old('team_id') == $key))?'selected':'' }}>{{$name}}</option>
			                     			@endforeach
			                     		</select>
			                     	</div>
			                    </div>
	                     		<div class="col-sm-12 col-md-12 text-center">
			                     	 <a href="{{ route('player.index') }}" class="btn btn-danger">Cancel</a>
	                     			@if(empty($player))
			                     	 	<button type="submit" class="btn btn-success">Create Player</button>
			                     	 @endif
			                    </div>
			                </div>
	                     </form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	$("#playerForm").validate({
    	rules: {
            name: {
            	required :true,
            },
            team_id: {
                required: true, 
            }, 
	    },
	    messages: {
	        name : {
	            required:"You must enter a player name",
	        },
	        team_id : {
	            required:"You must select a team name",
	        },
	    },
	    errorClass: "error",
	    errorElement: "div",
	    errorPlacement: function(error, element) {
	        var placement = $(element).data('error');
	        if (placement) {
	            $(element).append(error)
	        } else {
	            error.insertAfter(element);
	        }
	    },
	    submitHandler: function (form) {
	        return true;
	    }, 
        messages: {
            name: "Please enter team name",
            club_id: "Please select a club name", 
        }, 
    });
</script> 
@endpush
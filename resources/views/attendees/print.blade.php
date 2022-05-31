@extends('layouts.print')
@section('content')
<?php
$ctr = 0;
?>
<h3>Attendees</h3>
<table class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th class="text-center">Barcode</th>
			<th class="text-center">Name</th>
			<th class="text-center">Gender</th>
			<th class="text-center">Age</th>
			<th class="text-center">Civil Status</th>
			<th class="text-center">Company</th>
			<th class="text-center">Mobile</th>
			<th class="text-center">Email</th>
			<th class="text-center">Region</th>
			<th class="text-center">Classification</th>
		</tr>
	</thead>
	<tbody>
		@foreach($rows as $row)
		<?php $ctr++; ?>
		<tr>
			<td>{{ $ctr }}</td>
			<td>{{ $row->visitor->vis_code }}</td>
			<td>{{ $row->visitor->vis_fname }} {{ $row->visitor->vis_mname }} {{ $row->visitor->vis_lname }}</td>
			<td>{{ App\Gender::where('gender_id', $row->visitor->gender_id)->value('gender_name') }}</td>
			<td>{{ $row->visitor->vis_age }}</td>
			<td>{{ App\CivilStatus::where('civil_id', $row->visitor->civil_id)->value('civil_name') }}</td>			
			<td>{{ $row->visitor->vis_company }}</td>
			<td>{{ $row->visitor->vis_gsm }}</td>
			<td>{{ $row->visitor->vis_email }}</td>
			<td>{{ App\Region::where('region_id', $row->visitor->region_id)->value('region_name') }}</td>
			<td>{{ App\Classification::where('class_id', $row->visitor->class_id)->value('class_name') }}</td>			
		</tr>
		@endforeach
	</tbody>
</table>
@stop
@extends('layouts.excel')
@section('content')
<?php
$ctr = 0;
?>
<h3>Attendees</h3>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Barcode</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Age</th>
			<th>Civil Status</th>
			<th>Company</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Region</th>
			<th>Classification</th>
			<th>Timestamp</th>
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
			<td>{{ $row->visitor->created_at }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop
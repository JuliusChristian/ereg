@extends('layouts.master_layout')
@section('content')
<?php
    $event = \App\Event::where('event_active', 1)->first();
    $event_title = "";
    if (!$event) {
        $event_title = "No Active Event!!!";
    } else {
        $event_title = $event->event_title;
    }

    $gen = new \Picqer\Barcode\BarcodeGeneratorPNG();

    $naam = '';
?>
<div class="panel panel-default">
    <div class="panel-heading hidden-print">
        @if (strlen($msg) > 0)
        <div class="alert alert-info">
            {{ $msg }}
        </div>
        @endif
        <div class="row">
            <div class="clearfix hidden-print col-sm-6">
                <h3 class="panel-title pull-left">Preregistration Barcodes<br>{{ $event_title }}</h3>
                <div class="pull-right">
                </div>
            </div>
        
            {!! Form::open(array('name' => 'search_form', 'url' => URL::to('barcode/prereg'), 'class'=>'form-inline', 'role' => 'form')) !!}   
            <div class="input-group input-group-sm col-sm-6">
                <input class="form-control" type="text" maxlength="255" name="q" id="q" value="{{ $q }}">
                <span class="input-group-btn">
                    <input class="btn btn-default btn-sm" type="submit" value="Search" name="search-btn" id="search-btn">
                </span>
            </div>
            {!! Form::close() !!}
        </div>
        
    </div>
    <div>
     @foreach($rows as $row)
     <?php 
        if ($naam == $row->vis_name){

            continue;
        }

        $naam = $row->vis_name;
     ?>
        <div class="barcode-wrapper" class="text-center">
            <div class="barcode-center">
                <div class="barcode-vcenter">
                    <div class="barcode-header">{{ $event_title }}</div>
                    <div class="barcode-subtitle">
                        {{ $event->event_desc }}
                    </div>                    
                    <div class="barcode-name text-nowrap">
                        {{ ucwords(strtolower($row->vis_fname)) }} {{ ucwords(strtolower($row->vis_lname)) }}
                    </div>
                    <strong>{{ $row->vis_company }}</strong>
                    <!-- <div class="barcode-company">
                        {{ $row->vis_company }}
                    </div> -->
                    <div class="barcode-code"><?php echo '<img src="data:image/png;base64,'.base64_encode($gen->getBarcode($row->vis_code, $gen::TYPE_CODE_128)).'">'; ?></div>
                    <div class="barcode-number">{{ $row->vis_code }}</div>
                </div>
            </div>
        </div>
     @endforeach
    </div>
    <div class="panel-footer hidden-print">
    </div>
</div>
@endsection
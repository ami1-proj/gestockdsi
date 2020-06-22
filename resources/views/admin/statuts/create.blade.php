@extends('admin.layouts.master')

@section('page')
    Ajouter statut

@section('content')

<div class="row">
                    <div class="col-lg-10 col-md-10">

                        <div class="card">
                            <div class="header">
                                <h4 class="title">Ajouter statut</h4>
                            </div>
                            <div class="content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                
                                {!! Form::open(['url' => 'statuts', 'files'=>'true']) !!}
                                    
                                            @include('admin.statuts._fields')

                                            <div class="form-group">
                                            	{{ Form::submit('Ajouter', ['class'=>'btn btn-info btn-fill btn-wd']) }}
                                    		</div>

                                        </div>

                                    </div>
                                    
                                 <div class="clearfix"></div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            

@endsection
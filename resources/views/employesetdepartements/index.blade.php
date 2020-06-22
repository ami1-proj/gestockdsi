@extends('layouts.app')

@section('page')
  Employes & Departements
@endsection

@section('css')
<style type="text/css">
    body{
      background-color: #bdc3c7;
      }

    thead, tbody { display: block; }

    tbody {
      height: 330px;       /* Just for the demo          */
      overflow-y: auto;    /* Trigger vertical scroll    */
      overflow-x: hidden;  /* Hide the horizontal scroll */
    }
</style>
@endsection

@section('content')
  @include('employesetarticles.dashboard')
@endsection

@extends('layouts.app')
@section('content')


<section class="editing-forms">
    <div class="container">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 text-center">
                <h2>CHat with Slack </h2>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form  method="post" action="/send" enctype="multipart/form-data">
            {{method_field('POST')}}
            {{csrf_field()}}
               
                <div class="row">
                    <div class="col-md-12">
                        <label >Message</label>
                        <textarea name="message" class="form-control txt-area" placeholder="Add message to send ..."></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="image"> Choose From Your Comuter</label>
                        <input type="file" class="form-control-file ml-3 mt-2" name="file"/>
                    </div>
                </div>
               

                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="Send" class="btn btn-primary pl-5 pr-5">
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
   
</section>
@include('flashy::message')

@endsection


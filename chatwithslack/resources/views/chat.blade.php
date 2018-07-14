@extends('layouts.app')
@section('content')
@include('flashy::message')

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
          
               
                <div class="row">
                    <div class="col-md-12">
                        <label >Message</label>
                        <textarea  id="message" name="message" class="form-control txt-area" placeholder="Add message to send ..." required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="image"> Choose From Your Comuter</label>
                        <input id="file" type="file" class="form-control-file ml-3 mt-2" name="file"/>
                    </div>
                </div>
               

                
                <div class="row">
                    <div class="col-md-12 text-center">
                    <input type="submit"  id="send" value="SEND" class="btn btn-secondary ">
                    </div>
                </div>

            
            </div>
        </div>
    </div>
    @if($messages)
    <div class="row ">
    <div class="col-md-12 messages">
  
                <h2>All Messages You Sent </h2>
    
        @foreach($messages as $message)

         <h4>{{$message->user->name}}</h4>
         <p>{{$message->message}}  at  {{$message->created_at->diffForHumans()}}</p>
       
            

                       

                    
               
          
            @endforeach
            </div> 
            </div>     
    
    @endif



     

        
            
   
</section>
<script>
    $(document).ready( function(){

    $('#send').on('click',function(){
        var msg=$('#message').val();
        var file=$('#file').val();
   
        $.ajax({
                url: '/send',
                type:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                   
                    'message':msg,
                    'file':file,

                },
                success:function(response){
                    if(response.response =='success'){
                   
                  $('.messages').append('<h4>'+response.name+'</h4>');
                    $('.messages').append('<p>'+response.message+'</p>');
                    

                   }
                   else{
                    console.log(response.response);
                    alert('You Cant send message');
                   }
                }

        })

    });
    });
</script>

@endsection


@extends('layouts.coordinator_layout')
@section('content')

   <div class="container">
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px">PARTICIPANTS</h6>
         <div class="card shadow-sm bg-transparent">
            <div class="card-body">
               <div class="container">
                 {{--  <button class="btn btn-dark btn-sm px-4 mb-3" onclick="window.location.href='{{route('coordinator.add_participants')}}' ">Add</button>  
                  
                  <button class="btn btn-dark btn-sm px-4 mb-3" onclick="window.location.href='{{route('coordinator.blacklist')}}' ">BLACKLIST</button>  
 --}}
                  @if($count>=1)
                  <button onclick="window.location.href='New/Participants' " class="btn btn-light text-primary btn-sm px-4 mb-3">New <span class="badge badge-danger bg-danger">{{$count}}</span> </button>   
                  @endif

                  @if (Session::get('Success'))
                  <div class="alert alert-success alert-dismissable">
                      <strong class="hf">{{ Session::get('Success') }}</strong>
                      <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                          aria-label="Close"></button>
                  </div>
              @endif
              
                  <div class="table-responsive">
                  <table class="table table-striped table-sm table-hover table-secondary" id="myTable" style="font-size:14px">
                     <thead>
                       
                        <tr class="table-dark ">
                           <th></th>
                           <th>Email</th>
                           <th>Name</th>
                           <th>Address & Contact#</th>  
                           <th>Sport_Event</th> 
                          {{--  <th>Status</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                       
                 {{--    
                        @foreach ($user as $users)
                           @if($users->id == $row->user_id)
                              @if($row->isverified == 1) --}}

                              @foreach ($user as $users)
                              <tr>
                                 <td></td>
                                 <td>{{$users->email}}</td>
                                 <td>{{$users->name}}</td>
                                 <td>
                                  <span class="text-secondary">{{$users->address}}</span><br>
                                  #
                                  <span style="font-size:14px" class="text-secondary">{{$users->contactno}}</span>
                                 </td>
                                 <td>
                                
                                    <ul class="list-group list-group-flush">

                                       @foreach ($participants as $key  => $row)
                                    

                                    @foreach ($sportevent as $sp )
                                    @if($sp->id == $row->sports_id && $users->id == $row->user_id)
                                      
                                    @if($row->isverified == 0)
                                    <li class="list-group-item bg-light">  <span class="text-danger  hf" style="font-weight: bold">{{$sp->name}}</span> 
                                       <span style="float:right" 
                                       class="text-secondary hf">
                                          <a href="New/Participants">For Verification</a>
                                          
                                       </span>
                                    </li>
                                    @else
                                    <li class="list-group-item bg-light">  <span class="text-primary  hf" style="font-weight: bold">{{$sp->name}}</span> 
                                       @if($row->isverified==1)
                                       <span style="float:right" 
                                       class="text-secondary hf">
                                        Waiting for the Event Coordinator to Verify
                                          
                                       </span>
                                        @elseif($row->isverified==2)
                                        <span style="float: right" class="badge bg-success">VERIFIED</span>
                                      
                                        
                                       @endif
                                     {{--   <span style="float:right">
                                          <button class="delete btn btn-light text-danger btn-sm" style="font-size:12px;font-weight:normal" data-id="{{$row->id}}"><i class="fas fa-trash-can"></i></button>
                                       </span> --}}
                                    </li>
                                    @endif
                                   
                                    @endif
                                  @endforeach

                                    @endforeach
                                    
                                     </ul>
                                   

                                 </td>    
                                    {{-- <td>
                                       <div class="btn-group">
                                    
                                    
                                 
                           
                                       </div>
                                    </td> --}}
                              </tr>
                              @endforeach
                              
 
                       {{--   
 --}}
                    
                    
                   {{--   @if($row->user_id == $user[$key]['id'])
                        <tr>
                           <td></td>
                           <td>{{$user[$key]['email']}}</td>
                           <td>{{$user[$key]['name']}}</td>
                           <td>
                            <span class="text-secondary">{{$user[$key]['address']}}</span><br>
                            #
                            <span style="font-size:14px" class="text-secondary">{{$user[$key]['contactno']}}</span>
                           </td>
                           <td>

                            @foreach ($sportevent as $sp )
                              @if($sp->id == $row->sports_id)
                              {{$sp->name}}
                              @endif
                            @endforeach
                         
                           </td>    
                           <td>
                              <div class="btn-group">
                              @if($row->isverified == 0)
                              <button class="btn btn-primary btn-sm" style="font-size:12px;">Verify</button>
                              @else 
                              <button class="btn btn-success btn-sm" style="font-size:12px;" disabled>Verified</button>
                              @endif
                             
                                 <button class="btn btn-light text-danger btn-sm" style="font-size:12px"><i class="fas fa-trash"></i></button>
                                
                              </div>
                           </td>
                        </tr> 
                     @endif
                      
                         
                     @endforeach  --}}
                
                     </tbody>
                    </table>
                  </div>
               </div>
            </div>
         </div>
       
          

        
   </div>
   <script>
           $('.delete').click(function(){
         var id = $(this).data('id');

         swal({
      title: "Are you sure?",
      text: "you wont be able to recover it.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
       $(this).html('<span style="font-size:11px" class="text-danger">Deleting..</span>');
        window.location.href='delete_participants/'+id;
      } else {
       
      }
    });
      })
   </script>
@endsection
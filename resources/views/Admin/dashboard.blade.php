@extends('layouts.admin_layout')
@section('content')

<div class="container">
  <h5 class="af">Dashboard</h5>
  {{-- {{ Auth::user()->name }}
  {{ Auth::user()->email }}
  {{ Auth::user()->password }}
  {{ Auth::user()->id }} --}}
  <div class="row">
    <div class="col-md-9">
      <div class="row">
        <div class="col-md-4 mt-4">
          <div class="card shadow-sm " style="background-color: rgba(117, 7, 7, 0.877)">
            <div class="card-body">
              <h5 class="hf text-light">Coordinators</h5>
              <h6 class="af text-light" style="font-size:14px;">
                <span class="badge bg-light text-dark" style="font-size:17px">{{count($coordinator)}}</span> Accounts
              </h6>
              <i class="dashboardbanner fas fa-users-gear"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4 mt-4">
          <div class="card shadow-sm " style="background-color: rgba(7, 36, 117, 0.877)">
            <div class="card-body">
              <h5 class="hf text-light">Students</h5>
              <h6 class="af text-light" style="font-size:14px;">
                <span class="badge bg-light text-dark" style="font-size:17px">{{count($students)}}</span> Accounts
              </h6>
              <i class="dashboardbanner fas fa-users"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4 mt-4">
          <div class="card shadow-sm " style="background-color: rgba(168, 146, 18, 0.877)">
            <div class="card-body">
              <h5 class="hf text-light">Colleges</h5>
              <h6 class="af text-light" style="font-size:14px;">
                <span class="badge bg-light text-dark" style="font-size:17px">{{count($college)}}</span> in Records
              </h6>
              <i class="dashboardbanner fas fa-graduation-cap"></i>
            </div>
          </div>
        </div>
      </div>


      <div class="card mt-4">
        <div class="card-body">
          <h6 style="font-size:13px;font-weight:bold">DATA-MANAGEMENT <i class="fas fa-cogs"></i></h6>

          <br>

          @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <button class="btn btn-primary btn-sm px-4 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">New batch <i class="fas fa-plus-circle"></i></button>



          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Add Batch</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" action="{{route('savebatch')}}">
                  @csrf
                  <div class="modal-body">
                    <h6>Title</h6>
                    <input type="text" class="form-control" name="title" required>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Batch</th>
                <th scope="col">Created_at</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @php
              $batches = DB::select('select * from batches')
              @endphp

              @foreach($batches as $key => $row)
              <tr class="@if($row->status == 1) table-success  @endif">
                <th scope="row">{{$key+1}}</th>
                <td>{{$row->title}}</td>
                <td>{{date('h:i a F j,Y',strtotime($row->created_at))}}</td>
                <td>
                  @if($row->status == 1)
                  <span class="badge bg-success">Active</span>
                  @else
                  <span class="badge bg-danger">Inactive</span>
                  @endif

                </td>
                <td>
                  @if($row->status == 0)
                  <button class="btn btn-light btn-sm text-danger select" data-id="{{$row->id}}">Fetch <i class="fas fa-sync"></i></button>
                  @endif
                </td>
              </tr>
              @endforeach


            </tbody>
          </table>

        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        $('.select').click(function() {
          var id = $(this).data('id');
          Swal.fire({
            title: 'Are you sure?',
            text: "this will change all the data session globally",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, fetch it!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "{{route('fetchbatch')}}?id=" + id;
            }
          })

        })
      </script>



      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card shadow">
            <div class="card-body">

              <h6 class="hf text-primary">Sport Events</h6>
              <hr>
              <div class="overflow event_contents">


                <ol class="list-group ">
                  @foreach ($sport as $event)
                  <li class="list-group-item d-flex justify-content-between align-items-start">

                    <div class="ms-2 me-auto">
                      <span style="font-size:11px" class="hf">
                        @foreach ($college as $item)
                        @if($item->id == $event->CollegeId)
                        {{$item->name}}
                        @endif
                        @endforeach
                      </span>
                      <div class="fw-bold text-danger">{{$event->name}}</div>
                      <span style="font-size:12px">{{$event->description}}</span>
                    </div>
                    {{-- <span class="badge bg-primary rounded-pill">14</span> --}}
                  </li>
                  @endforeach

                </ol>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="card shadow">
            <div class="card-body">


              <script>
                window.onload = function() {

                  var chart = new CanvasJS.Chart("chartContainer", {
                    exportEnabled: true,
                    animationEnabled: true,
                    title: {
                      text: "All sportsevent and its participants"
                    },
                    /*    subtitles: [{
                         text: "Click Legend to Hide or Unhide Data Series"
                       }], */
                    axisX: {
                      title: "Sport/Events"
                    },
                    axisY: {
                      title: "Participants",
                      titleFontColor: "#4F81BC",
                      lineColor: "#4F81BC",
                      labelFontColor: "#4F81BC",
                      tickColor: "#4F81BC",
                      includeZero: true
                    },
                    /*  axisY2: {
                       title: "Clutch - Units",
                       titleFontColor: "#C0504E",
                       lineColor: "#C0504E",
                       labelFontColor: "#C0504E",
                       tickColor: "#C0504E",
                       includeZero: true
                     } ,*/
                    toolTip: {
                      shared: true
                    },
                    /*  legend: {
                       cursor: "pointer",
                       itemclick: toggleDataSeries
                     }, */
                    data: [{
                        type: "column",
                        name: "",
                        showInLegend: true,
                        yValueFormatString: "#,##0.# Participants",
                        dataPoints: [

                          @foreach($graph as $row)


                          {
                            label: "{{$row->name}}",
                            y: {
                              {
                                $row - > totalcount
                              }
                            }
                          },

                          @endforeach

                          /*  { label: "New Jersey",  y: 19034.5 },
                           { label: "Texas", y: 20015 },
                           { label: "Oregon", y: 25342 },
                           { label: "Montana",  y: 20088 },
                           { label: "Massachusetts",  y: 28234 } */
                        ]
                      }
                      /* ,
                                                          {
                                                            type: "column",
                                                            name: "Clutch",
                                                            axisYType: "secondary",
                                                            showInLegend: true,
                                                            yValueFormatString: "#,##0.# Units",
                                                            dataPoints: [
                                                              { label: "New Jersey", y: 210.5 },
                                                              { label: "Texas", y: 135 },
                                                              { label: "Oregon", y: 425 },
                                                              { label: "Montana", y: 130 },
                                                              { label: "Massachusetts", y: 528 }
                                                            ]
                                                          } */
                    ]
                  });
                  chart.render();

                  function toggleDataSeries(e) {
                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                      e.dataSeries.visible = false;
                    } else {
                      e.dataSeries.visible = true;
                    }
                    e.chart.render();
                  }

                }
              </script>

              <div id="chartContainer" style="height: 300px; width: 100%;"></div>
              <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


            </div>
          </div>

          <div class="card shadow mt-4">
            <div class="card-body">
              <h6 class="hf">WMSU PALARO YEAR {{now()->format('Y')}}-{{now()->format('Y')+1}}</h6>
            </div>
          </div>
        </div>
      </div>


    </div>





    <div class="col-md-3">



      <table>
        <tr>
          <td style="text-align: center;"><canvas id="canvas_tt62d8e53299536" width="175" height="175"></canvas></td>
        </tr>
        <tr>
          <td style="text-align: center; font-weight: bold"><a href="//24timezones.com/Manila/time" style="text-decoration: none" class="clock24" id="tz24-1658381618-c1145-eyJzaXplIjoiMTc1IiwiYmdjb2xvciI6IjAwOTlGRiIsImxhbmciOiJlbiIsInR5cGUiOiJhIiwiY2FudmFzX2lkIjoiY2FudmFzX3R0NjJkOGU1MzI5OTUzNiJ9" title="Manila timezone" target="_blank" rel="nofollow">WMSU</a></td>
        </tr>
      </table>
      <script type="text/javascript" src="//w.24timezones.com/l.js" async></script>


      {{--
                        <div class="card shadow mt-5 bg-dark">
                          <div class="card-body">
                            <h6 class="hf text-primary">Colleges with Events</h6>
                            <ul class="list-group list-group-flush">
                              @foreach ($collegewevent as $item)
                              <li class="list-group-item hf" style="font-size:13px">{{$item->name}}</li>
      @endforeach

      </ul>


    </div>
  </div> --}}

</div>
</div>


</div>

@endsection
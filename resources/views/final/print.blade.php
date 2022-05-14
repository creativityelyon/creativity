@extends('layouts.appnomenu')
@section('title')
Final Report
@endsection
@section('css')

@endsection
@section('content')
<section class="section">
  <h1>Report Creativity and Corpus Fitness</h1>
  <div class="section-header">
    
    <table>
      <thead>
        <th></th>
        <th></th>
      </thead>
      <tbody>
        <tr>
          <td>Name : </td>
          <td>{{ $data->nama }}</td>
        </tr>
        <tr>
          <td>NIK :</td>
          <td>{{ $data->nik }}</td>
        </tr>
        <tr>
          <td>Kelas :</td>
          <td>{{ $data->kelas }}</td>
        </tr>
        <tr>
          <td>Lokasi :</td>
          <td>{{ $data->lokasi }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="section-body">

    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th>Aspect</th>
                      <th>Level</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td>Creativity</td>
                      @if(!empty($creativity))
                      @if($creativity->grade == 'KGA' || $creativity->grade == 'KGB' || $creativity->grade == 'PGB' || $creativity->grade == '1' || $creativity->grade == 2)
                        @if($creativity->creativity_1 + $creativity->creativity_2 == '4')
                        <td> Emerging </td>
                        @else
                        <td> Novice</td>
                        @endif
                      @elseif($creativity->grade >= 3 && $creativity->grade <= 6)
                      @if($creativity->creativity_1 + $creativity->creativity_2 + $creativity->creativity_3 + $creativity->creativity_4 == 8)
                      <td> Emerging </td>
                      @else
                      <td> Novice</td>
                      @endif
                      @else
                      @if($creativity->creativity_1 + $creativity->creativity_2 + $creativity->creativity_3 + $creativity->creativity_4 + $creativity->creativity_5 + $creativity->creativity_6 == 12)
                      <td> Emerging </td>
                      @else
                      <td> Novice</td>
                      @endif
                      @endif

                      <td>{{ $creativity->text}}</td>
                      @else
                      <td></td>
                      <td></td>
                      @endif
                    </tr> -->
                    <tr>
                      <td>Corpus Fitness</td>
                      <td>{{ $data->creativity }}</td>
                      <td>{{ $data->gender == 'Male' ? str_replace("his/her","his",(str_replace("He/She","He",$data->desc_creativity))) : str_replace("his/her","her",(str_replace("He/She","She",$data->desc_creativity))) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      @if( $creativity != null)
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th>Aspect</th>
                      <th>Course</th>
                      <th>Project Name</th>
                      <th>Level</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                       <td>Creativity</td>
                     @if($creativity->performing_art_id != null)
                     
                        <td><?php 
                            $tmp = \DB::table('temp_container')->where('id',$creativity->performing_art_id)->first();
                           $proj= \DB::table('project_tipe')->where('id', $tmp->master_project_tipe)->first();
                          if($creativity->grade == 'KGA' || $creativity->grade == "KGB" || $creativity->grade== 'PGB'){
                            echo "Performing Art";
                          }else
                          if(intval($creativity->grade) <= 6 && intval($creativity->grade) >= 1 && $creativity->lokasi == "Sukomanunggal" ){
                            echo "Performing Art";
                          } else if(intval($creativity->grade)<= 4 && intval($creativity->grade) >= 1 && $creativity->lokasi == "Sutorejo" ){
                            echo "Music";
                          } else if(intval($creativity->grade)<= 5 && intval($creativity->grade) >= 6 && $creativity->lokasi == "Sutorejo" ){
                            echo "Performing Art";
                          }
                         
                           echo $proj->nama;
                        
                        ?></td>
                        <td>
                          @php 
                              echo $tmp->nama_project;
                          @endphp
                        </td>
                        <td>
                          @php 
                            if($tmp->level == 2) echo "Emerging"; else if($tmp->level == 1) echo "Novice";
                        @endphp
                        </td>
                        <td>
                          @php 
                              echo $tmp->description;
                          @endphp
                        </td>
                      @endif
                     </tr>
                     <tr>
                     
                       @if($creativity->performing_art_id_2 != null)
                       <td>

                      </td>
                       <td><?php 
                           $tmp = \DB::table('temp_container')->where('id',$creativity->performing_art_id_2)->first();
                          $proj= \DB::table('project_tipe')->where('id', $tmp->master_project_tipe)->first();
                          echo $proj->nama;
                       
                       ?></td>
                       <td>
                         @php 
                             echo $tmp->nama_project;
                         @endphp
                       </td>
                       <td>
                         @php 
                           if($tmp->level == 2) echo "Emerging"; else if($tmp->level == 1) echo "Novice";
                       @endphp
                       </td>
                       <td>
                         @php 
                             echo $tmp->description;
                         @endphp
                       </td>
                     @endif
                     </tr>
                     <tr>
                      
                       @if($creativity->container_id != null)
                       <td>

                      </td>
                       <td>
                         <b>Club for Talent, Interest and Innovation</b> <br>
                         <?php 
                           $tmp = \DB::table('temp_container')->where('id',$creativity->container_id)->first();
                          $proj= \DB::table('project_tipe')->where('id', $tmp->master_project_tipe)->first();
                          echo "(". $proj->nama.")";
                       
                       ?></td>
                       <td>
                         @php 
                             echo $tmp->nama_project;
                         @endphp
                       </td>
                       <td>
                         @php 
                           if($tmp->level == 2) echo "Emerging"; else if($tmp->level == 1) echo "Novice";
                       @endphp
                       </td>
                       <td>
                         @php 
                             echo $tmp->description;
                         @endphp
                       </td>
                     @endif
                     </tr>
                     <tr>
                       
                       @if($creativity->container_id_2 != null)
                       <td>

                      </td>
                     
                       <td>
                        <b>Club for Talent, Interest and Innovation</b> <br>
                         <?php 
                           $tmp = \DB::table('temp_container')->where('id',$creativity->container_id_2)->first();
                          $proj= \DB::table('project_tipe')->where('id', $tmp->master_project_tipe)->first();
                          echo "(". $proj->nama.")";
                       
                       ?></td>
                       <td>
                         @php 
                             echo $tmp->nama_project;
                         @endphp
                       </td>
                       <td>
                         @php 
                           if($tmp->level == 2) echo "Emerging"; else if($tmp->level == 1) echo "Novice";
                       @endphp
                       </td>
                       <td>
                         @php 
                             echo $tmp->description;
                         @endphp
                       </td>
                     @endif
                     </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>

    <div class="row">
      <h3>WEEKLY EXERCISE REPORT</h3>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="">
              <ul>
              @foreach($exercise as $c)
                <li>Week {{ $loop->iteration }} - ({{ date('d-m-Y',strtotime($c->start_date)) }} - {{ date('d-m-Y',strtotime($c->end_date)) }} )</li>
              @endforeach
            </ul>
            </div>
            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed">
                  <thead>

                  </thead>
                  <tbody>
                    @foreach($exercise as $c)
                    <tr>
                      <td><b>Week {{ $loop->iteration }}</b></td>
                      @foreach($c->detail as $d)
                      <td>{{ date('d-m-Y',strtotime($d->tgl)) }}</td>
                      @endforeach
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div style="float:right">
                <h5>Sincerly</h5>

                <img src="../../img/{{$tt_kepsek[0]['tt_kepala_sekolah']}}" alt="" height="90">
                <h5>{{$tt_kepsek[0]['nama_kepala_sekolah']}}</h5>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')

@endsection

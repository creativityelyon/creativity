@extends('layouts.app')
@section('title')
Report Jajak Pendapat
@endsection
@section('css')
<style>
#sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
.clearfix {
  clear: both;
}
.stick {
  position:relative;
}
</style>
@endsection
@section('content')
<section class="section">
  <div class="section-header">
    <h3 class="page__heading">Report Jajak Pendapat</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div style="width: 100%;">
              <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-condensed dtt">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Keterangan</th>
                      <th>Total</th>
                      <th>Total PJJ</th>
                      <th>Total PTM</th>
                      <th>Total Skip</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Total User (except Sutorejo)</td>
                      <td> {{ $count_total }} </td>
                      <td> {{ $count_app }}</td>
                      <td> {{ $count_rej }}</td>
                      <td> {{ $count_skip }}</td>

                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Total PGKG Sukomanunggal </td>
                      <td> {{ $count_pgkg_suko }} </td>
                      <td> {{ $count_pgkg_suko_app }} </td>
                      <td> {{ $count_pgkg_suko_rej }} </td>
                      <td> {{ $count_pgkg_suko_skip }}</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Total PGKG KIT </td>
                      <td> {{ $count_pgkg_kit }} </td>
                      <td> {{ $count_pgkg_kit_app }} </td>
                      <td> {{ $count_pgkg_kit_rej }} </td>
                      <td> {{ $count_pgkg_kit_skip }}</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Total Primary Sukomanunggal </td>
                      <td> {{ $count_prim_suko }} </td>
                      <td> {{ $count_prim_suko_app }} </td>
                      <td> {{ $count_prim_suko_rej }} </td>
                      <td> {{ $count_prim_suko_skip }}</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Total Secondary Darmo </td>
                      <td> {{ $count_sec_darmo }} </td>
                      <td> {{ $count_sec_darmo_app }} </td>
                      <td> {{ $count_sec_darmo_rej }} </td>
                      <td> {{ $count_sec_darmo_skip }}</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Total Highschool Darmo </td>
                      <td> {{ $count_hs_darmo }} </td>
                      <td> {{ $count_hs_darmo_app }} </td>
                      <td> {{ $count_hs_darmo_rej }} </td>
                      <td> {{ $count_hs_darmo_skip }}</td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

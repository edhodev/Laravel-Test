<div class="card">
  <div class="card-header">
    <div style="float: right">
      @isset($form)
        <a href="{{ $form }}" class="btn btn-primary">Tambah Data</a>
      @endisset
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped dataTable">
        <thead>
          {{ $thead }}
        </sthead>
        <tbody>
          {{ $tbody }}
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $title }}</h3>

        <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" id="tableSearch" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover" id="{{ $tableId }}">
            <thead>
              {{ $thead }}
            </thead>
            <tbody>
              {{ $slot }}
            </tbody>
          </table>
    </div>
    <!-- /.box-body -->
</div>
